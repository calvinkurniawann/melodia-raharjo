<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class UserController extends Controller
{
    // app/Http/Controllers/UserController.php

    public function show()
    {
        return View('profile.show');
    }

    public function edit()
    {
        return view('profile.update');
    }

    public function update(Request $request)
    {
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'no_telepon' => 'numeric|nullable',
    ]);

    $user->update([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'no_telepon' => $request->input('no_telepon'),
    ]);

    return Redirect::route('profile.show')->with('success', 'Profile updated successfully!');
}

}
