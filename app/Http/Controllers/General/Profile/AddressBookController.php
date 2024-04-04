<?php

namespace App\Http\Controllers\General\Profile;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddressBookController extends Controller
{
    public function index() 
    {

        return view('general.profile.addresses.index');
    }

    public function create()
    {
        $provinces = DB::table('provinces')->get();

        return view('general.profile.addresses.create', [
            'provinces' => $provinces,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            // 'name' => 'required|string',
            'street_address' => 'required|string',
            'city' => 'required|string',
            'province_id' => 'required|string',
            'is_primary' => 'nullable',
        ]);

        Address::create([
            // 'name' => $request->name,
            'user_id' => auth()->user()->id,
            'street_address' => $request->street_address,
            'city' => $request->city,
            'province_id' => $request->province_id,
            'is_primary' => ($request->is_primary) ? true : false,
        ]);
    }

    public function update(Request $request, User $user)
    {

    }

    public function destroy($id)
    {

    }
}
