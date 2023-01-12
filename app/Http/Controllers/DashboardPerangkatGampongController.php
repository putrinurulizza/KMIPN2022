<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use App\Models\PerangkatGampong;
use Illuminate\Support\Facades\Storage;

class DashboardPerangkatGampongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.perangkat.index', [
            'title' => 'Perangkat Gampong',
            'perangkats' => PerangkatGampong::with('jabatan')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.perangkat.create', [
            'title' => 'Tambah Perangkat Gampong',
            'jabatans' => Jabatan::all()
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
            'id_jabatan' => 'required|unique:perangkat_gampongs',
            'foto' => 'image|file|max:2048',
        ]);

        if ($request->file('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('perangkat-gampong');
        }

        PerangkatGampong::create($validatedData);

        return redirect('/dashboard/struktur/perangkat-gampong')->with('success', 'Perangkat gampong berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PerangkatGampong $perangkatGampong)
    {
        return view('dashboard.perangkat.edit', [
            'title' => 'Edit Perangkat Gampong',
            'perangkat' => $perangkatGampong,
            'jabatans' => Jabatan::all( )
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PerangkatGampong $perangkatGampong)
    {
        $rules = [
            'nama' => 'required|max:255',
            'foto' => 'image|file|max:2048',
        ];

        if ($request->id_jabatan != $perangkatGampong->id_jabatan) {
            $rules['id_jabatan'] = ['required', 'unique:perangkat_gampongs'];
        }

        $validatedData = $request->validate($rules);

        if ($request->file('foto')) {
            if ($request->oldFoto) {
                Storage::delete($request->oldFoto);
            }
            $validatedData['foto'] = $request->file('foto')->store('perangkat-gampong');
        }

        PerangkatGampong::where('id', $perangkatGampong->id)->update($validatedData);

        return redirect('/dashboard/struktur/perangkat-gampong')->with('success', 'Perangkat gampong berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PerangkatGampong $perangkatGampong)
    {
        if ($perangkatGampong->foto) {
            Storage::delete($perangkatGampong->foto);
        }

        PerangkatGampong::destroy($perangkatGampong->id);
        return redirect('/dashboard/struktur/perangkat-gampong')->with('success', "User $perangkatGampong->nama berhasil dihapus!");
    }
}
