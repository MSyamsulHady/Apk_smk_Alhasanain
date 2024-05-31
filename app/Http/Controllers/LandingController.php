<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function home()
    {
        return view('frontend.home');
    }
    public function bk()
    {
        return view('frontend.bk');
    }
    public function pendaftaran()
    {
        return view('frontend.pendaftaran');
    }
    public function prestasi()
    {
        return view('frontend.prestasi');
    }
    public function kegiatan()
    {
        return view('frontend.kegiatan');
    }
}
