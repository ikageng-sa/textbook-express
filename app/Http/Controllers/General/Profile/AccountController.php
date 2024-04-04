<?php

namespace App\Http\Controllers\General\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{

    public function index() 
    {
        $user = auth()->user();

        return view('general.profile.account', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'phone_number' => ['nullable', 'string', 'max:10', 'unique:users,phone_number,'.$user->id],
        ]);

        $user->update($request->all());

        return redirect()->back()->with('status', 'Account updated successfully');
    }

    public function showResetForm(Request $request)
    {
        $token = $request->route()->parameter('token');

        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email ?? auth()->user()->email ]
        );
    }
}
