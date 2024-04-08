<?php

namespace App\Http\Controllers\General\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAddressRequest;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddressBookController extends Controller
{
    public function index() 
    {
        $addresses = Address::select(['addresses.id', 'addresses.name', 'addresses.street_address as street', 'addresses.city', 'provinces.name as province', 'addresses.postal_code as code', 'addresses.is_primary'])
            ->join('provinces', 'addresses.province_id', '=', 'provinces.id')
            ->where(['user_id' => auth()->user()->id])
            ->get();
        // dd($addresses);

        return view('general.profile.addresses.index', [
            'addresses' => $addresses,
        ]);
    }

    public function create()
    {
        $provinces = DB::table('provinces')->get();

        return view('general.profile.addresses.create', [
            'provinces' => $provinces,
        ]);
    }

    public function edit(Address $address)
    {
        $provinces = DB::table('provinces')->get();

        return view('general.profile.addresses.edit', [
            'provinces' => $provinces,
            'address' => $address,
        ]);
    }


    public function store(StoreAddressRequest $request)
    {

        // Check if any address is set to primary and unset if true
        $this->validatePrimary($request);

        Address::create([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'street_address' => $request->street_address,
            'city' => $request->city,
            'province_id' => $request->province_id,
            'postal_code' => $request->postal_code,
            'is_primary' => ($request->is_primary) ? true : false,
        ]);

        return redirect()->back()->with('status', 'Address was saved successfully');
    }

    public function update(StoreAddressRequest $request, Address $address)
    {

        $this->validatePrimary($request);

        $address->update([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'street_address' => $request->street_address,
            'city' => $request->city,
            'province_id' => $request->province_id,
            'postal_code' => $request->postal_code,
            'is_primary' => ($request->is_primary) ? true : false,
        ]);

        return redirect()->back()->with('status', 'Address was updated successfully');
    }

    public function destroy(Address $address)
    {
        $address->delete();

        return redirect()->back()->with('status', 'Address was deleted successfully');
    }

    private function validatePrimary($request) {
        if($request->is_primary) {
            $addresses = Address::where('user_id', '=', auth()->user()->id)->get();
            foreach($addresses as $address) {
                if($address->is_primary) {
                    $address->update(['is_primary' => false]);
                }
            }
        }
    }
}
