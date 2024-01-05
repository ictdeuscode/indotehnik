<?php

namespace App\Http\Controllers;

use App\Models\ScannMesin;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class ScannMesinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ScannMesin  $scannMesin
     * @return \Illuminate\Http\Response
     */
    public function show(ScannMesin $scannMesin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ScannMesin  $scannMesin
     * @return \Illuminate\Http\Response
     */
    public function edit(ScannMesin $scannMesin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ScannMesin  $scannMesin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ScannMesin $scannMesin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ScannMesin  $scannMesin
     * @return \Illuminate\Http\Response
     */
    public function destroy(ScannMesin $scannMesin)
    {
        //
    }

    public function storemesin(Request $request)
    {
        // $cek = ScannMesin::where([
        //     'kode' => $request->kode,
        //     'tanggal' => date('y-m-d')

        // ])->first();

        // // if ($cek) {
        // //     return redirect('/dashboard/scanmesin')->with('gagal', 'Sudah Scann');
        // // }

        // ScannMesin::create([
        //     'kode' => $request->kode,
        //     'tanggal' => date('y-m-d')
        // ]);

        // return redirect('/dashboard/masterQR')->with('success', 'berhasil');
        $namamesin = $request->input('namamesin');
        $kode=$request->input("kode");
        $mesin=DB::table("master_mesins")->get();
        $result1=DB::table("master_mesins")->where("kode",$kode)->first();

        return view('masterQR.index', compact('mesin','namamesin','result1'));
    }
}
