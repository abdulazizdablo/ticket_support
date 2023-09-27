<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\EditUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(30);
        return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
       $user =  User::create($request->validated());
 

        return to_route('users.index')->withMessage('User has been created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditUserRequest $request, User $user)
    {
        $user->update($request->validated());
        $user->assignRole($request->role_id);

        return to_route('users.index')->withMessage('User has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
  
        return to_route('users.index')->withMessage('User has been deleted succesfully');
    }
}
