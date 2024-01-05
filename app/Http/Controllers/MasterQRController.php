<?php

namespace App\Http\Controllers;

use App\Models\HistorySurat;
use App\Models\HistorySuratPhoto;
use App\Models\LaporanStock;
use App\Models\MasterMesin;
use App\Models\MasterOperator;
use App\Models\MasterPreorder;
use App\Models\MasterQR;
use App\Models\Scann;
use Carbon\Carbon;
use HistoryPoin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class MasterQRController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_unless(Gate::allows('hasPermission', 'qr'), 403);

        $operator = DB::table("master_operators")->get();
        $mesin = DB::table("master_mesins")->get();
        $surat = DB::table("master_preorders")->get();

        for ($i = 0; $i < count($surat); $i++) {
            $history = DB::table("history_surats")->where("no_surat", $surat[$i]->nomor)->first();
            if ($history != null) {
                $surat[$i]->history = $history;
            } else {
                $surat[$i]->history = null;
            }
        }

        for ($i = 0; $i < count($operator); $i++) {
            $history = DB::table("history_surats")->where("nama_operator", $operator[$i]->nama)->orWhere("nama_operator_keluar", $operator[$i]->nama)->get();
            $suratA = "";
            for ($j = 0; $j < count($history); $j++) {
                if ($suratA != "") {
                    $suratA .= ",";
                }
                $suratA .= $history[$j]->no_surat;
            }
            $operator[$i]->surat = $suratA;
        }
        $data["surat"] = $surat;
        $data["operator"] = $operator;
        $data["mesin"] = $mesin;

        $selectedOperator = null;
        if ($request->session()->get("operator") != null) {
            $selectedOperator = $request->session()->get("operator");
        }
        $selectedsurat = null;
        if ($request->session()->get("surat") != null) {
            $selectedsurat = $request->session()->get("surat");
        }
        $selectedMesin = null;
        if ($request->session()->get("mesin") != null) {
            $selectedMesin = $request->session()->get("mesin");
        }
        $data["selectedMesin"] = $selectedMesin;
        $data["selectedOperator"] = $selectedOperator;
        $data["selectedsurat"] = $selectedsurat;

        //print_r($selectedsurat);
        return view('masterQR.index', $data);
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

    public function storesurat(Request $request)
    {
        abort_unless(Gate::allows('hasPermission', 'qr'), 403);

        $kode = $request->input("nomor");
        $result = DB::table("master_preorders")->where("nomor", $kode)->first();

        if ($result != null) {
            $request->session()->put("surat", $result);
        }

        echo $kode . "<br/>";
        print_r($result);
        return redirect('/dashboard/masterQR')->with('success', 'berhasil');
    }


    public function storemesin(Request $request)
    {
        abort_unless(Gate::allows('hasPermission', 'qr'), 403);

        // return redirect('/dashboard/masterQR')->with('success', 'berhasil');
        $kode = $request->input("kode");
        $result = DB::table("master_mesins")->where("kode", $kode)->first();

        if ($result != null) {
            $request->session()->put("mesin", $result);
        }
        return redirect('/dashboard/masterQR')->with('success', 'berhasil');
    }

    public function storeoperator(Request $request)
    {
        abort_unless(Gate::allows('hasPermission', 'qr'), 403);
        
        $namaopera = $request->input('namaopera');
        $kode = $request->input("kode");
        $result = DB::table("master_operators")->where("kode", $kode)->first();

        if ($result != null) {
            $request->session()->put("operator", $result);
        }
        return redirect('/dashboard/masterQR')->with('success', 'berhasil');
    }
    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function store(Request $request)
    {
        abort_unless(Gate::allows('hasPermission', 'qr'), 403);

        $photos = json_decode($request->photos, true);
        $photos = array_values($photos);

        $operator = $request->input("operator");

        $overwrite = false;
        for ($i = 0; $i < count($request->N_OP); $i++) {

            $tbl_mesin = MasterMesin::where('nama', $request->N_MSN[$i])->first();
            $tbl_surat = MasterPreorder::where('nomor', $request->N_ORD[$i])->first();
            $tbl_operator = MasterOperator::where('nama', $operator)->first();

            if(in_array(NULL, [$tbl_mesin, $tbl_surat, $tbl_operator]))
            {
                continue;
            }

            $history_surat_last = HistorySurat::where("id_surat", $tbl_surat->id)
            ->whereNull('tanggal_keluar')
            ->latest()
            ->first();

            if(!empty($history_surat_last) && ($history_surat_last->id_mesin !== $tbl_mesin->id || $history_surat_last->id_operator !== $tbl_operator->id || $history_surat_last->is_reject == 1))
            {
                $history_surat_last->update(['tanggal_keluar' => Carbon::now()]);
            }

            $history_surat_db = HistorySurat::where('id_surat', $tbl_surat->id)
            ->where('id_mesin', $tbl_mesin->id)
            ->where('id_operator', $tbl_operator->id)
            ->latest()->first();

            if($history_surat_db != NULL && $history_surat_db->id == $history_surat_last?->id && $history_surat_db->is_reject == 0)
            {
                $history_surat_db->tanggal = Carbon::now();
                $history_surat_db->keterangan_proses = $request->Ket_P[$i];
                $history_surat_db->qty = $request->Act_Q[$i];
                $history_surat_db->is_exclude_point = $request->Get_P[$i] ? 1 : 0;
                $history_surat_db->save();
                $history_surat = $history_surat_db;
                $overwrite = true;
            }
            else
            {
                $history_surat = new HistorySurat();
                $history_surat->id_surat = $tbl_surat->id;
                $history_surat->no_surat = $tbl_surat->nomor;
                $history_surat->tanggal = Carbon::now();
                $history_surat->id_mesin = $tbl_mesin->id;
                $history_surat->nama_mesin = $tbl_mesin->nama;
                $history_surat->keterangan_proses = $request->Ket_P[$i];
                $history_surat->qty = $request->Act_Q[$i];
                $history_surat->id_operator = $tbl_operator->id;
                $history_surat->nama_operator = $tbl_operator->nama;
                $history_surat->is_exclude_point = $request->Get_P[$i] ? 1 : 0;
                $history_surat->save();

                if($tbl_mesin->is_gudang_kirim == 1 && $tbl_surat->is_stock == 1)
                {
                    $laporanstock = new LaporanStock();
                    $laporanstock->id_master_preorder = $tbl_surat->id;
                    $laporanstock->save();
                }
            }
            
            $history_surat_photo_old = HistorySuratPhoto::where('id_history_surat', $history_surat->id)->get();
            foreach ($history_surat_photo_old as $photo) {
                $url = $photo->url;
    
                $pathInfo = pathinfo($url);
                $s3Path = 'foto-proses/';
                $filename = $pathInfo['basename'];
    
                Storage::disk('s3')->delete($s3Path . $filename);
            }
            HistorySuratPhoto::where('id_history_surat', $history_surat->id)->delete();

            if(count($photos) > 0)
            {
                foreach($photos[$i] as $photo)
                {
                    $img = $photo;
                    $fileData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $img));
                    $filename = $this->generateRandomString(5) . ".jpg";
    
                    $s3Path = 'foto-proses/';
    
                    $result = Storage::disk('s3')->put($s3Path . $filename, $fileData, 'public');
    
                    $history_surat_photo = new HistorySuratPhoto();
                    $history_surat_photo->id_history_surat = $history_surat->id;
                    $history_surat_photo->url = Storage::disk('s3')->url($s3Path . $filename);
                    $history_surat_photo->save();
                }
            }
        }

        return $overwrite ? "Data berhasil diperbaharui !" : "Data berhasil ditambahkan !";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterQR  $masterQR
     * @return \Illuminate\Http\Response
     */
    public function show(MasterQR $masterQR)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterQR  $masterQR
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterQR $masterQR)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterQR  $masterQR
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterQR $masterQR)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterQR  $masterQR
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterQR $masterQR)
    {
        //
    }
}
