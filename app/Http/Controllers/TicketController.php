<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ticket\CreateTicketRequest;
use App\Http\Requests\Ticket\EditTicketRequest;
use App\Models\Ticket;
use App\Services\CategoryService;
use App\Services\LabelService;
use App\Enums\Roles;
use App\Http\Requests\Ticket\FilterTicketsRequest;
use App\Jobs\EmailAdminProcess;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Models\Comment;


class TicketController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::allows('agent_permission')) {

            $tickets = Ticket::with('labels:name', 'categories:name')->whereNotNull('agent_id')->orderBy('created_at', 'DESC')->paginate(30);
            return view('index')->with('tickets', $tickets);
        } else

            $tickets = Ticket::with('labels:name', 'categories:name')->orderBy('created_at', 'DESC')->paginate(30);
        return view('tickets.index')->with('tickets', $tickets);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(LabelService $label_service, CategoryService $category_service)
    {

        $labels = $label_service->getLabels();
        $categories = $category_service->getCategories();

        $statuses = DB::table('statuses')->get(['id', 'name']);


        return view('tickets.create')->with('statuses', $statuses)->with('labels', $labels)->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTicketRequest $request)
    {

        $file_names = [];
        if ($request->file('files')) {
            foreach ($request->file('files') as  $file) {


                $file_name = time() . rand(1, 99) . '.' . $file->extension();
                $file->move(public_path('uploads'), $file_name);
                $file_names[] = $file_name;
            }
        }


        $ticket =  Ticket::create(

            $request->except('category', 'label', 'files') +
                ['files' =>   $file_names]

        );


        $ticket->labels()->attach(array_keys($request->label));
        $ticket->categories()->attach(array_keys($request->category));

        $admin = User::where('role_id', Roles::ADMINSTRATOR)->first();

        EmailAdminProcess::dispatch($ticket, $admin);

        return to_route('tickets.index')->withMessage('Ticket and its Label and Category has been created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {

        $comments = Comment::with('user')->get();

        $logs = $ticket->logs;

        return view('tickets.show')->with('ticket', $ticket)->with('logs', $logs)->with('comments', $comments);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoryService $category_service, LabelService $label_service, Ticket $ticket)
    {


        if (Gate::allows('agent_permission') || Gate::allows('manage-dashboard')) {


            $agents = User::where('role_id', Roles::AGENT)->pluck('name', 'id');

            $labels = $label_service->getLabels();
            $categories = $category_service->getCategories();
            $statuses = DB::table('statuses')->get(['id', 'name']);
        } else {
            abort(403);
        }
        return view('tickets.edit')->with('ticket', $ticket)->with('agents', $agents)->with('statuses', $statuses)->with('labels', $labels)->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditTicketRequest $request, Ticket $ticket)
    {

        if (Gate::allows('agent_permission') || Gate::allows('manage-dashboard')) {

            $file_names = [];
            if ($request->file('files')) {
                foreach ($request->file('files') as  $file) {


                    $file_name = time() . rand(1, 99) . '.' . $file->extension();
                    $file->move(public_path('uploads'), $file_name);
                    $file_names[] = $file_name;
                }
            }

            $ticket->update($request->except('label', 'category', 'files') + ['files' => $file_names]);

            // Check if Labels and Categories are the same as current model to avoid
            // unneccesary querying to Database

            $labels_array = array_map('intval', $request->label);
            $categories_array = array_map('intval', $request->category);

            if ($ticket->labels->pluck('id') !==    $labels_array) {
                $ticket->labels()->sync($labels_array);
            } else if ($ticket->categories->pluck('id') !==   $categories_array) {

                $ticket->categories()->sync($categories_array);
            } else {
                $agent = User::find($request->agent_id);


                $agent->tickets()->save($ticket);
            }
        } else {
            abort(403);
        }

        return to_route('tickets.index')->withMessage('Ticket has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        Gate::authorize('manage-dashboard');

        $ticket->delete();
        return to_route('tickets.index')->withMessage('Ticket has been deleted successfully');
    }



    public function filterTickets(FilterTicketsRequest $request)
    {

        // filter Tickets based on categories related using joins
        $filtered_tickets = Ticket::filter($request->filter);

        return  view('tickets.index')->with('tickets', $filtered_tickets);
    }
}
