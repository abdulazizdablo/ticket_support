<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTicketRequest;
use App\Http\Requests\EditTicketRequest;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Services\CreateCategoryService;
use App\Services\CreateLabelService;
use Illuminate\Support\Facades\File;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::paginate(30);
        $tickes_count = Ticket::count();
        return view('index')->with('tickets', $tickets)->with('tickets_count', $tickets_count);
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


        $files = [];
        if ($request->file('files')) {
            foreach ($request->file('files') as $key => $file) {


                $file_name = time() . rand(1, 99) . '.' . $file->extension();
                $file->move(public_path('uploads'), $file_name);
                $files[]['name'] = $file_name;
            }
        }
        dd($files);
        foreach ($files as $key => $file) {
            File::create($file);
        }

        Ticket::create($request->all());
        $label_service->createLabel($request->label);
        $category_service->createCategory($request->category);
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
        //
    }

    public function addComment(Ticket $ticket)
    {
    }
}
