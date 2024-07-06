<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HalamanSiswaController extends Controller
{
    public function index()
    {


        $user = Auth::user();
        return view('backend.bk.dashboard_sg', compact('user'));
    }
}
