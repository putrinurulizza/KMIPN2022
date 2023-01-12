<?php

namespace App\Http\Controllers;

use App\Mail\EmailPengambilanSurat;
use App\Models\Surat;
use App\Models\JenisSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class DashboardDataSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.data_surat.index', [
            'title' => 'Data Surat',
            'surats' => Surat::with('jenis_surat')->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.data_surat.create', [
            'title' => "Buat Permohonan Surat",
            'jenis_surats' => JenisSurat::all()
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
            'email' => 'required|email:dns',
            'nama' => 'required|max:255',
            'telp' => 'required|max:13',
            'kk' => 'image|file|max:2048',
            'ktp' => 'image|file|max:2048',
            'id_jenis_surat' => 'required'
        ]);

        if ($validatedData['telp'][0] == 0) {
            $validatedData['telp'] = substr($validatedData['telp'], 1);
        }

        if ($request->file('kk')) {
            $validatedData['kk'] = $request->file('kk')->store('dokumen-data-surat/kk');
        }

        if ($request->file('ktp')) {
            $validatedData['ktp'] = $request->file('ktp')->store('dokumen-data-surat/ktp');
        }

        Surat::create($validatedData);

        return redirect('/dashboard/administrasi/data-surat')->with('success', 'Permohonan surat berhasil dibuat!');
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
    public function edit(Surat $data_surat)
    {
        return view('dashboard.data_surat.edit', [
            'title' => 'Edit Permohonan Surat',
            'surat' => $data_surat,
            'jenis_surats' => JenisSurat::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Surat $data_surat)
    {
        $rules = [
            'email' => 'required|email:dns',
            'nama' => 'required|max:255',
            'telp' => 'required|max:13',
            'kk' => 'image|file|max:2048',
            'ktp' => 'image|file|max:2048',
            'id_jenis_surat' => 'required'
        ];

        $validatedData = $request->validate($rules);

        if ($request->file('kk')) {
            if ($request->oldKK) {
                Storage::delete($request->oldKK);
            }
            $validatedData['kk'] = $request->file('kk')->store('dokumen-data-surat/kk');
        }

        if ($request->file('ktp')) {
            if ($request->oldKTP) {
                Storage::delete($request->oldKTP);
            }
            $validatedData['ktp'] = $request->file('ktp')->store('dokumen-data-surat/ktp');
        }

        dd($validatedData);

        Surat::where('id', $data_surat->id)->update($validatedData);

        return redirect('/dashboard/berita/data-berita')->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function buatSurat(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email:dns',
            'nama' => 'required|max:255',
            'telp' => 'required|max:13',
            'kk' => 'image|file|max:2048',
            'ktp' => 'image|file|max:2048',
            'id_jenis_surat' => 'required'
        ]);

        if ($validatedData['telp'][0] == 0) {
            $validatedData['telp'] = substr($validatedData['telp'], 1);
        }

        if ($request->file('ktp')) {
            $validatedData['ktp'] = $request->file('ktp')->store('dokumen-data-surat/ktp');
        }

        if ($request->file('kk')) {
            $validatedData['kk'] = $request->file('kk')->store('dokumen-data-surat/kk');
        }

        Surat::create($validatedData);

        return redirect('/administrasi/form-adm')->with('success', 'Permohonan Surat anda berhasil diajukan!');
    }

    public function updateStatus(Request $request)
    { 
        $request['status'] = intval($request['status']);
        
        $rules = [
            'status' => 'integer'
        ];
        
        $validatedData = $request->validate($rules);
        
        Surat::where('id', $request['id'])->update($validatedData);
        
        if ($request->status == 2) {
            Mail::to($request->email)->send(new EmailPengambilanSurat);
        }

        return redirect('/dashboard/administrasi/data-surat')->with('success', 'Status permohonan surat berhasil diperbarui!');
    }
}
