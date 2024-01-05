<?php

namespace App\Http\Controllers;

use App\Models\Scann;
use Illuminate\Http\Request;

class ScannController extends Controller
{
    public function store(Request $request)
    {
        // $cek = Scann::where([
        //     'kode' => $request->kode,
        //     'tanggal' => date('y-m-d')
        
        // ])->first();
    

        // // if ($cek) {
        // //     return redirect('/dashboard/scanQR')->with('gagal','Sudah Scann');
        // // }

        $namaopera = $request->input('namaopera');

         Scann::create([
        'kode' => $request->kode,
        'tanggal' => date('y-m-d')
    ]);

        return view('masterQR.index', compact('namaopera'));
    }
    public function show(Scann $scann)
    {
        return view('scann.show', compact('scann'));
       
    } 
    public function handle(Request $request)
    {
        $data = $request->input('data');
        $name = $this->extractNameFromQrData($data);    

        return view('masterQR.index', ['name' => $name]);
    }

    private function extractNameFromQrData($data)
    {
        // Implement logic to extract name from QR code data
    }
    
}
