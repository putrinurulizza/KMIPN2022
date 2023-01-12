<?php

namespace App\Http\Controllers;

use App\Models\Perizinan;
use App\Mail\EmailPerizinan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DashboardPerizinanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.perizinan.index', [
            'title' => 'Perizinan Tamu',
            'perizinans' => Perizinan::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'alamat' => 'required|max:255',
            'ktp' => 'image|file|max:2048',
            'izin' => 'required'
        ]);

        if ($validatedData['telp'][0] == 0) {
            $validatedData['telp'] = substr($validatedData['telp'], 1);
        }

        if ($request->file('ktp')) {
            $validatedData['ktp'] = $request->file('ktp')->store('dokumen-perizinan');
        }

        Perizinan::create($validatedData);

        return redirect('/administrasi/form-izin')->with('success', 'Perizinan anda berhasil diajukan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perizinan  $perizinan
     * @return \Illuminate\Http\Response
     */
    public function show(Perizinan $perizinan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perizinan  $perizinan
     * @return \Illuminate\Http\Response
     */
    public function edit(Perizinan $perizinan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perizinan  $perizinan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perizinan $perizinan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perizinan  $perizinan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perizinan $perizinan)
    {
        //
    }

    public function konfirmasiPerizinan(Request $request)
    {
        $request['status'] = intval($request['status']);

        $rules = [
            'email' => 'required|email:dns',
            'status' => 'integer'
        ];

        $validatedData = $request->validate($rules);

        Perizinan::where('id', $request['id'])->update($validatedData);

        if ($request['status'] == 2) {
            $msg = "Bapak/Ibu $request->nama, izin anda kami terima.";
        } elseif ($request['status'] == 3) {
            $msg = "Mohon maaf, Bapak/Ibu $request->nama, izin anda kami tolak.";
        }

        $data = [
            'msg' => $msg,
            'ket' => $request->keterangan
        ];

        Mail::to($request->email)->send(new EmailPerizinan($data));

        return redirect('/dashboard/administrasi/perizinan')->with('success', 'Perizinan berhasil dikonfirmasi!');
    }
}
