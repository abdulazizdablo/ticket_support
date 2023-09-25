<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTicketRequest;
use App\Http\Requests\EditTicketRequest;
use App\Models\Ticket;
use App\Services\CreateCategoryService;
use App\Services\CreateLabelService;
use App\Enums\Roles;
use App\Http\Requests\FilterTicketsRequest;
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
        if (auth()->user()->hasRole(Roles::AGENT)) {


            $tickets = Ticket::with('labels:name', 'categories:name')->whereNotNull('agent_id')->paginate(30);
            return view('index')->with('tickets', $tickets);
        } else

            $tickets = Ticket::with('labels:name', 'categories:name')->paginate(30);
        return view('tickets.index')->with('tickets', $tickets);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuses = DB::table('statuses')->get(['id', 'name']);


        return view('tickets.create')->with('statuses', $statuses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTicketRequest $request, CreateLabelService $label_service, CreateCategoryService $category_service)
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

        $ticket->labels()->attach($request->label);
        $ticket->categories()->attach($request->category);

        $admin = User::where('role_id', Roles::ADMINSTRATOR)->first();

        EmailAdminProcess::dispatch($ticket, $admin);
        //  $label_service->createLabel($request->label, $ticket);


        //$category_service->createCategory($request->category, $ticket);

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
    public function edit(Ticket $ticket)
    {

        Gate::authorize('manage-dashboard');

        $agents = User::where('role_id', Roles::AGENT)->pluck('name', 'id');
        $statuses = DB::table('statuses')->get(['id', 'name']);

        return view('tickets.edit')->with('ticket', $ticket)->with('agents', $agents)->with('statuses', $statuses);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditTicketRequest $request, Ticket $ticket)
    {

        Gate::authorize('manage-dashboard');

        $agent = User::find($request->agent_id);

        $agent->tickets()->save($ticket);

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
