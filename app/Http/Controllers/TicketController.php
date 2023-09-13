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
use App\Models\User;
use App\Notifications\TicketCreated;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        //$tickets = auth()->user()->with('labels','categories')->tickets->;



        
        $tickets = User::with('tickets')->whereHas('tickets', function ($query) {

            $query->with('labels', 'categories')->where('user_id', auth()->id());
        })->get();
        // $tickets = Ticket::paginate(30);

dd($tickets->tickets);

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        return view('tickets.edit')->with('ticket', $ticket);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditTicketRequest $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return to_route('tickets.index')->withMessage('Ticket has been deleted successfully');
    }

    public function addComment(Ticket $ticket)
    {
    }
}
