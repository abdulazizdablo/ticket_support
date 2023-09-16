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
use App\Services\FilterTicketsService;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCommentRequest;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $tickets = auth()->user()->load('tickets.labels:name', 'tickets.categories:name')->tickets;


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

            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'files' => $file_names
        ]);
        /*  $request->except('files', 'label', 'category')+
            ['files' =>   $file_names]

       */
        event(new EventsTicketCreated($ticket));

        $label_service->createLabel($request->label, $ticket);
        $category_service->createCategory($request->category, $ticket);



        return to_route('tickets.index')->withMessage('Ticket and its Label and Category has been created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        return view('show')->with('ticket', $ticket);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {

        $agents = User::where('role_id', Roles::AGENT)->pluck('name', 'id');

        return view('edit')->with('ticket', $ticket)->with('agents', $agents);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditTicketRequest $request, Ticket $ticket)
    {

        $agent = User::find($request->agent_id);

        $agent->tickets()->create($request->validated());

        return to_route('tickets.index')->withMessage('Ticket has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return to_route('tickets.index')->withMessage('Ticket has been deleted successfully');
    }

    public function addComment(Ticket $ticket, CreateCommentRequest $request)
    {

        $ticket->comments()->create(

            $request->validated()

        );
    }
    public function filterTickets(Request $request, FilterTicketsService $tickets_filter)
    {





        // filter Tickets based on categories related using joins
        $filtered_tickets = Ticket::filter($request->filter);

        //$filtered_tickets =  Ticket::selectRaw('group_concat(categories.name order by categories.name asc) as categories_names, tickets.*')->join('category_ticket', 'tickets.id', '=', 'category_ticket.ticket_id')->join('categories', 'categories.id', '=', 'category_ticket.category_id')->groupBy('ticket_id')->orderBy('categories_names')->get();

        return  view('index')->with('tickets', $filtered_tickets);
    }
}
