<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    
    public function index()
    {
        return view('general.profile.index');
    } 

    
}
