<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class AllDataSiswaController extends Controller
{
    public function index()
    {
        $allSiswa = Siswa::all();
        return view('backend.bk.all_data_siswa', compact('allSiswa'));
    }
}
