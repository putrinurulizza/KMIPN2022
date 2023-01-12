<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardLaporanAdministrasiController extends Controller
{
    public function index()
    {
        $surat = DB::table('surats')
                    ->select(DB::raw('COUNT(surats.id_jenis_surat) AS total'), DB::raw('jenis_surats.nama AS nama_surat'))
                    ->leftJoin('jenis_surats', 'jenis_surats.id', '=', 'surats.id_jenis_surat')
                    ->where('surats.created_at', '<>', now()->year)
                    ->groupBy('id_jenis_surat')
                    ->pluck('total', 'nama_surat');

        $solusi = DB::table('solusis')
                    ->select(DB::raw('COUNT(*) AS total'), DB::raw('YEAR(created_at) AS year'))
                    ->groupBy('year')
                    ->pluck('total','year');
        
        $perizinan = DB::table('perizinans')
                    ->select(DB::raw('COUNT(*) AS total'), DB::raw('YEAR(created_at) AS year'))
                    ->groupBy('year')
                    ->pluck('total','year');

        return view('dashboard.laporan.administrasi.index', [
            'title' => 'Laporan Administrasi',
        ])->with(compact('surat', 'solusi', 'perizinan'));
    }
}
