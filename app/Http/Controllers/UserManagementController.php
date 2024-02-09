<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('dashboard.userManagement', compact('users'));
    }

    public function create()
    {
        return view('dashboard.createUser');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'utype' => 'required',
        ]);

        // Create a new user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'utype' => $request->utype,
        ]);

        // Redirect to the users index page with a success message
        return redirect()->route('dashboard.user.index');
    }

    public function edit(User $user)
    {
        return view('dashboard.editUser', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'utype' => 'required',
        ]);

        // Update the user
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'utype' => $request->utype,
        ]);

        // Redirect back to the users index page with a success message
        return redirect()->route('dashboard.user.index');
    }

    public function destroy(User $user)
    {
        // Delete the user
        $user->delete();

        // Redirect back to the users index page with a success message
        return redirect()->route('dashboard.user.index');
    }
}