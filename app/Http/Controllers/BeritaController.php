<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class BeritaController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            $data = Berita::all();
            return view('backend.berita', compact('data'));
        } else {
            $data = Berita::latest()->get();
            return view('frontend.kegiatan', compact('data'));
        }
    }
    public function insertBerita(Request $req)
    {
        // dd($req->all());

        $this->validate($req, [
            'judul' => 'required',
            'isi_berita' => 'required',
            'gambar' => 'required'
        ]);
        try {
            $data = new Berita();
            if ($req->hasFile('gambar')) {
                $ext = $req->file('gambar')->getClientOriginalExtension();
                $name = Uuid::uuid4() . "." . $ext;
                $req->file('gambar')->move("Gambar_Berita/", $name);
                $data->judul = $req->judul;
                $data->isi_berita  = $req->isi_berita;
                $data->gambar = $name;
                $data->save();
                return redirect('berita')->with(['msg' => 'Data Berhasil Ditambah', 'type' => 'success']);
            } else {
                return redirect('berita')->with(['msg' => 'Gambar Tidak boleh kosong ', 'type' => 'error']);
            }
        } catch (\Exception $e) {
            return $e;
        }
    }
}
