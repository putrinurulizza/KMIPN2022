<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DashboardLaporanKeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total_pemasukan = DB::table('keuangans')
                            ->select(DB::raw('SUM(pemasukan) AS total_pemasukan'))
                            ->pluck('total_pemasukan')->toArray();

        $total_pengeluaran = DB::table('keuangans')
                            ->select(DB::raw('SUM(pengeluaran) AS total_pengeluaran'))
                            ->pluck('total_pengeluaran')->toArray();

        $saldo = $total_pemasukan[0] - $total_pengeluaran[0];

        return view('dashboard.laporan.keuangan.index',[
            'title' => 'Laporan Keuangan',
            'keuangans' => Keuangan::latest()->get(),
        ])->with(compact('saldo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.laporan.keuangan.create',[
            'title' => 'Tambah Laporan Keuangan'
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
            'sumber_dana' => 'required|max:255',
            'pemasukan' => 'integer',
            'pengeluaran' => 'integer',
            'bukti' => 'image|file|max:2048',
        ]);

        $total_pemasukan = DB::table('keuangans')
                            ->select(DB::raw('SUM(pemasukan) AS total_pemasukan'))
                            ->pluck('total_pemasukan')->toArray();

        $total_pengeluaran = DB::table('keuangans')
                            ->select(DB::raw('SUM(pengeluaran) AS total_pengeluaran'))
                            ->pluck('total_pengeluaran')->toArray();

        $validatedData['saldo'] = ($validatedData['pemasukan'] + $total_pemasukan[0]) - ($validatedData['pengeluaran'] + $total_pengeluaran[0]);

        if ($request->file('bukti')) {
            $validatedData['bukti'] = $request->file('bukti')->store('bukti-dana');
        }

        Keuangan::create($validatedData);

        return redirect('/dashboard/laporan/keuangan')->with('success', 'Laporan keuangan baru berhasil ditambahkan!');
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
    public function edit(Keuangan $keuangan)
    {
        // return view('dashboard.laporan.keuangan.edit',[
        //     'title' => 'Edit Laporan Keuangan',
        //     'keuangan' => $keuangan
        // ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Keuangan $keuangan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Keuangan $keuangan)
    {
        if ($keuangan->bukti) {
            Storage::delete($keuangan->bukti);
        }

        Keuangan::destroy($keuangan->id);
        return redirect('/dashboard/laporan/keuangan')->with('success', 'Laporan keuangan berhasil dihapus!');
    }
}
