<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardBeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.berita.index', [
            'title' => 'Data Berita',
            'beritas' => Berita::with('kategori')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.berita.create', [
            'title' => 'Tambah Berita Baru',
            'kategoris' => Kategori::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|max:255',
            'slug' => 'required|unique:beritas',
            'id_kategori' => 'required',
            'thumbnail' => 'image|file|max:2048',
            'isi' => 'required'
        ]);

        if ($request->file('thumbnail')) {
            $validatedData['thumbnail'] = $request->file('thumbnail')->store('thumbnail-berita');
        }

        $validatedData['excerpt'] = Str::limit(strip_tags($request->isi), 200);

        Berita::create($validatedData);

        return redirect('/dashboard/berita/data-berita')->with('success', 'Berita baru berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Berita  $data_beritum
     * @return \Illuminate\Http\Response
     */
    public function show(Berita $data_beritum)
    {
        return view('dashboard.berita.show', [
            'title' => '',
            'berita' => $data_beritum
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Berita  $data_beritum
     * @return \Illuminate\Http\Response
     */
    public function edit(Berita $data_beritum)
    {
        return view('dashboard.berita.edit', [
            'title' => 'Edit Berita',
            'berita' => $data_beritum,
            'kategoris' => Kategori::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Berita  $data_beritum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Berita $data_beritum)
    {
        $rules = [
            'judul' => 'required|max:255',
            'id_kategori' => 'required',
            'thumbnail' => 'image|file|max:2048',
            'isi' => 'required'
        ];

        if ($request->slug != $data_beritum->slug) {
            $rules['slug'] = 'required|unique:beritas';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('thumbnail')) {
            if ($request->oldThumbnail) {
                Storage::delete($request->oldThumbnail);
            }
            $validatedData['thumbnail'] = $request->file('thumbnail')->store('thumbnail-berita');
        }

        $validatedData['excerpt'] = Str::limit(strip_tags($request->isi), 200);

        Berita::where('id', $data_beritum->id)->update($validatedData);

        return redirect('/dashboard/berita/data-berita')->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Berita  $data_beritum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Berita $data_beritum)
    {
        if ($data_beritum->thumbnail) {
            Storage::delete($data_beritum->thumbnail);
        }
        Berita::destroy($data_beritum->id);
        return redirect('/dashboard/berita/data-berita')->with('success', 'Berita berhasil dihapus!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Berita::class, 'slug', $request->judul);
        return response()->json(['slug' => $slug]);
    }
}
