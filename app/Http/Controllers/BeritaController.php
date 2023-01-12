<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $title = '';
        if (request('kategori')) {
            $kategori = Kategori::firstWhere('slug', request('kategori'));
            $title = ' in ' . $kategori->nama;
        }

        return view('berita', [
            "title" => "Berita $title",
            'beritas' => Berita::latest()->filter(request(['search', 'kategori']))->paginate(9)->withQueryString(),
            'kategoris' => Kategori::all()
        ]);
    }

    public function show(Berita $berita)
    {
        return view('single_berita', [
            "title" => "Single Berita",
            "berita" => $berita
        ]);
    }
}
