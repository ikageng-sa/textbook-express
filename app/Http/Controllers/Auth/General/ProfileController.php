<?php

namespace App\Http\Controllers\Auth\General;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    
    public function index()
    {
        return view('auth.general.profile.index');
    } 

    
}
