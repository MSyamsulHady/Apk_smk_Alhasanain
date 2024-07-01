<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Exception;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

use function Ramsey\Uuid\v1;

class BeritaController extends Controller
{
    public function index()
    {
        $data = Berita::all();
        return view('backend.berita', compact('data'));
    }
    public function insertBerita(Request $req)
    {
        // dd($req->all());

        $this->validate($req, [
            'judul_berita' => 'required',
            'isi_berita' => 'required',
            'gambar' => 'required'
        ]);

        try {
            $data = new Berita();
            if ($req->hasFile('gambar')) {
                $ext = $req->file('gambar')->getClientOriginalExtension();
                $name = Uuid::uuid4() . "." . $ext;
                $req->file('gambar')->move("gambarBerita/", $name);

                $data->judul_berita = $req->judul_berita;
                $data->isi_berita = $req->isi_berita;
                $data->gambar = $name;
                $data->save();
                return redirect('berita')->with(['msg' => 'Data Berhasil Ditambah', 'type' => 'success']);
            }
            return redirect('berita')->with(['msg' => 'Foto Tidak Boleh Kosong', 'type' => 'error']);
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function updateBerita(Request $req, $id)
    {
        $this->validate($req, [
            'judul_berita' => 'required',
            'isi_berita' => 'required'
        ]);
        try {
            $data = Berita::find($id);
            if ($req->file('gambar')) {
                $file = public_path('gambarBerita/' . $data->gambar);
                if (file_exists($file)) {
                    unlink($file);
                }
                $ext = $req->file('gambar')->getClientOriginalExtension();
                $name = Uuid::uuid4() . "." . $ext;
                $req->file('gambar')->move("gambarBerita/", $name);
                $data->gambar = $name;
            }
            $data->judul_berita = $req->judul_berita;
            $data->judul_berita = $req->isi_berita;
            $data->save();
            return redirect('berita')->with(['msg' => 'Data Berhasil DiEdit', 'type' => 'success']);
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function deleteBerita($id)
    {
        $id_data = Berita::findOrFail($id);
        $file = public_path('gambarBerita/' . $id_data->gambar);
        if (file_exists($file)) {
            unlink($file);
        }
        $id_data->delete();
        return redirect('berita')->with(['msg' => 'Data Berhasil DiHapus', 'type' => 'success']);
    }
}
