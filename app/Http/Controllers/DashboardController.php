<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Surat;
use App\Models\Berita;
use App\Models\Solusi;
use App\Models\Perizinan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
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
        // dd($perizinan->toArray());
        
        if (auth()->guest() || auth()->user()->role == 0) {
            abort(403);
        }
        return view('dashboard.index', [
            'title' => 'Dashboard',
            'total_users' => User::whereYear('created_at', now()->year)->count(),
            'total_berita' => Berita::whereYear('created_at', now()->year)->count(),
            'total_pengaduan' => Solusi::whereYear('created_at', now()->year)->count(),
            'total_perizinan' => Perizinan::whereYear('created_at', now()->year)->count(),
            'total_surat' => Surat::whereYear('created_at', now()->year)->count(),
        ])->with(compact('surat', 'solusi', 'perizinan'));
    }
}
