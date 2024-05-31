<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SanksiController extends Controller
{
    public function index()
    {
        return view('backend.bk.sanksi');
    }
}
