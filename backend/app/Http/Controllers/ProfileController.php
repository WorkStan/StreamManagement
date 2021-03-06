<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $userProfile = $request->user();
        return view('profile.index', compact('userProfile'));
    }
}
