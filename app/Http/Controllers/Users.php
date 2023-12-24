<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Users extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // search user
        $users = DB::table('users')
            ->where('name', 'like', '%' . $request->search . '%')
            ->orWhere('email', 'like', '%' . $request->search . '%')
            ->orWhere('phone', 'like', '%' . $request->search . '%')
            ->orWhere('role', 'like', '%' . $request->search . '%')
            ->orderBy('role', 'asc')
            ->paginate(10);

        // $users = User::all();
        // $users = User::paginate(10);
        // return view
        return view('pages.users.index', compact('users'), ['type_menu' => 'users']);
    }

    public function create()
    {
        // return view
        return view('pages.users.create', ['type_menu' => 'users']);
    }

    // edit user
    public function edit(User $user)
    {
        // return view
        return view('pages.users.edit', compact('user'), ['type_menu' => 'users']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate request input
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'role' => 'required|in:admin,staff',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ]);
        // store data
        User::create($request->all());
        // return to users page
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required',
            'role' => 'required|in:admin,staff',
            'password' => 'nullable|min:8',
            'password_confirmation' => 'nullable|same:password',
        ]);
        // update data
        $user->update($request->all());
        // return to users page
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // delete user 1 data
        $user->delete();
        // return to users page
        return redirect('/users')->with('success', 'User deleted successfully.');
    }
}
