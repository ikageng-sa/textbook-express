<?php

namespace App\Http\Controllers\Auth\General\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AddressBookController extends Controller
{
    public function index() {

        return view('auth.general.profile.addresses');
    }

    public function store(Request $request)
    {

    }

    public function update(Request $request, User $user)
    {

    }

    public function destroy($id)
    {

    }
}
