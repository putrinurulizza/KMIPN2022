<?php

namespace App\Http\Controllers;

use App\Models\Solusi;
use Illuminate\Http\Request;

class DashboardSolusiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.solusi.index',[
            'title' => 'Solusi',
            'solusis' => Solusi::latest()->get()
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
            'email' => 'required',
            'masukan' => 'required',
        ]);

        Solusi::create($validatedData);

        return redirect('/administrasi')->with('success', 'Masukan Terkirim! Terima kasih sudah memberikan masukan kepada gampong kami');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Solusi $solusi)
    {
        $rules = [
            'respon' => ''
        ];

        $validatedData = $request->validate($rules);
        
        Solusi::where('id', $solusi->id)->update($validatedData);
        
        return redirect('/dashboard/administrasi/solusi')->with('success', 'Respon berhasil diberikan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Solusi $solusi)
    {
        Solusi::destroy($solusi->id);
        return redirect('/dashboard/administrasi/solusi')->with('success', 'Data solusi berhasil dihapus!');
    }
}
