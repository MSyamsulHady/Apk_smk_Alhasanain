<?php

namespace App\Http\Controllers;

use App\Models\Pertemuan;
use Illuminate\Http\Request;

class PertemuanController extends Controller
{
    function index()
    {
        $pertemuan = Pertemuan::all();
        return view('backend.bk.kelolaAbsen', compact('pertemuan'));
    }
}
