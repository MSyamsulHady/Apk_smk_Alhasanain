<?php

namespace App\Http\Controllers;

use App\Models\Rombel;
use App\Models\Siswa;
use Illuminate\Http\Request;

class trxRombelController extends Controller
{
    public function index($id)
    {
        $siswa = Siswa::all();
        $rombel = Rombel::with('siswa')->find($id);
        return view('backend.bk.trxRombel', compact('siswa', 'rombel'));
    }
}
