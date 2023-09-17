<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTicketRequest;
use App\Http\Requests\EditTicketRequest;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Services\CreateCategoryService;
use App\Services\CreateLabelService;
use App\Enums\Roles;
use App\Events\TicketCreated as EventsTicketCreated;
use App\Http\Requests\FilterTicketsRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Services\FilterTicketsService;
use App\Http\Requests\CreateCommentRequest;
use App\Models\Log;

class TicketController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'signed'])->only('edit');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {


      // $tickets = auth()->user()->load('tickets.labels:name', 'tickets.categories:name')->tickets;
        $tickets = Ticket::with('labels:name', 'categories:name')->get();

        return view('index')->with('tickets', $tickets);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CreateLabelService $label_service, CreateCategoryService $category_service)
    {


        $file_names = [];
        if ($request->file('files')) {
            foreach ($request->file('files') as  $file) {


                $file_name = time() . rand(1, 99) . '.' . $file->extension();
                $file->move(public_path('uploads'), $file_name);
                $file_names[] = $file_name;
            }
        }
        // $ticket_arr = array_merge(,   ['files' =>   $file_names]);

        /*auth()->user()->tickets()-create([

    'title' => $request->title,
    'description' => $request->description,
    'priority' => $request->priority,
    'files' => $file_names

]);*/

        $ticket =  Ticket::create([


            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'files' => $file_names
        ]);
        /*  $request->except('files', 'label', 'category')+
            ['files' =>   $file_names]

       */

        $admin = User::where('role_id', Roles::ADMINSTRATOR)->first();
        event(new EventsTicketCreated($ticket, $admin));

        $label_service->createLabel($request->label, $ticket);
        $category_service->createCategory($request->category, $ticket);



        return to_route('tickets.index')->withMessage('Ticket and its Label and Category has been created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        $logs = $ticket->logs;
        $comments = $ticket->comments;

        return view('show')->with('ticket', $ticket)->with('logs', $logs)->with('comments', $comments);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {

        Gate::authorize('manage-dashboard');

        $agents = User::where('role_id', Roles::AGENT)->pluck('name', 'id');
        $statuses = DB::table('statuses')->get('name');

        return view('edit')->with('ticket', $ticket)->with('agents', $agents)->with('statuses', $statuses);
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

        return  view('index')->with('tickets', $filtered_tickets);
    }
}
