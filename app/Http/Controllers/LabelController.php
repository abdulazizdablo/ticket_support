<?php

namespace App\Http\Controllers;

use App\Http\Requests\Label\CreateLabelRequest;
use App\Http\Requests\Label\EditLabelRequest;
use App\Models\Label;
use Illuminate\Support\Facades\Gate;

class LabelController extends Controller
{

   


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('manage-dashboard');
        $labels = Label::select(['name','id'])->paginate(30);;

        return view('labels.index')->with('labels', $labels);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('manage-dashboard');
        return view('labels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateLabelRequest $request)
    {
        Gate::authorize('manage-dashboard');
        Label::create($request->validated());

        return to_route('labels.index')->withMessage('Label has been created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Label $label)
    {
        Gate::authorize('manage-dashboard');
        return view('labels.show')->with('label', $label);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Label $label)
    {
        Gate::authorize('manage-dashboard');
        return view('labels.edit')->with('label', $label);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditLabelRequest $request, Label $label)
    {
        Gate::authorize('manage-dashboard');

        $label->update($request->validated());
        return to_route('labels.index')->withMessage('Label has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Label $label)
    {
        Gate::authorize('manage-dashboard');
        $label->delete();
        return to_route('labels.index')->withMessage(' Label has been deleted successfully');
    }
}
