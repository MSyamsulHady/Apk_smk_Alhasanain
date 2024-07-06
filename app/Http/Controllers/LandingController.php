<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function home()
    {
        $berita = Berita::latest()->limit(3)->get();
        return view('frontend.home', compact('berita'));
    }
    public function detailBerita($id)
    {
        $data = Berita::findOrFail($id);
        return view('frontend.detail_berita', compact('data'));
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
