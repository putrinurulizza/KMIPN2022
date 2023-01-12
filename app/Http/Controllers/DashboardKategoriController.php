<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.kategori.index', [
            'title' => 'Kategori Berita',
            'kategoris' => Kategori::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.kategori.create', [
            'title' => 'Tambah Kategori Baru'
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
            'nama' => 'required|max:255',
            'slug' => 'required|unique:kategoris'
        ]);

        Kategori::create($validatedData);

        return redirect('/dashboard/berita/kategori-berita')->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kategori $kategori_beritum)
    {
        $rules = [
            'nama' => 'required|max:255'
        ];

        if ($request->slug != $kategori_beritum->slug) {
            $rules['slug'] = 'required|unique:kategoris';
        }

        $validatedData = $request->validate($rules);

        Kategori::where('id', $kategori_beritum->id)->update($validatedData);

        return redirect('/dashboard/berita/kategori-berita')->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori_beritum)
    {
        try {
            Kategori::destroy($kategori_beritum->id);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                //SQLSTATE[23000]: Integrity constraint violation
                return redirect('/dashboard/berita/kategori-berita')->with('failed', 'Kategori tidak dapat dihapus, karena sedang digunakan pada tabel lain!');
            }
        }

        return redirect('/dashboard/berita/kategori-berita')->with('success', 'Kategori berhasil dihapus!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Kategori::class, 'slug', $request->nama);
        return response()->json(['slug' => $slug]);
    }
}
