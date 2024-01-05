<?php

namespace App\Http\Controllers;

use App\Models\MasterMesin;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Database\Seeders\masterMesinTableSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use MasterMesinTable;
use PhpParser\Node\Stmt\TryCatch;

class MasterMesinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_unless(Gate::allows('hasPermission', 'master_mesin'), 403);

        $masterMesin = MasterMesin::paginate(5);
        return view('mastermesin.index', compact('masterMesin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Gate::allows('hasPermission', 'master_mesin'), 403);

        return view('mastermesin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_unless(Gate::allows('hasPermission', 'master_mesin'), 403);

        $dt = Carbon::now();
        $todayDate = $dt->format('Y-m-d');
        $validator = Validator::make(
            $request->all(),
            [
                'kode' => 'required',
                'nama' => 'required',
                'keterangan' => 'required',
                'poin' => 'required',
                'is_gudang_finish' => 'required',
                'is_gudang_kirim' => 'required',
            ],
        );

        // dd("Proses Insert data", $request->all());
        try {
            MasterMesin::create([
                'kode' => $request->kode,
                'nama' => $request->nama,
                'keterangan' => $request->keterangan,
                'poin' => $request->poin,
                'is_gudang_finish' => $request->is_gudang_finish ?? 0,
                'is_gudang_kirim' => $request->is_gudang_kirim ?? 0,
            ]);
            // $historymesin = [
            //     'tanggal' => $todayDate,
            //     'nama_mesin' => $request->nama,
            //     'nama_operator' => $request->jenis_operator,
            //     'poin' => $request->poin,
            //     'keterangan' => 'Tambah',
            // ];
            // DB::table('history_mesins')->insert($historymesin);
            Alert::success('Input Data', 'Input Data Berhasil');
            return redirect()->route('mastermesin.index');
        } catch (\Throwable $th) {
            Alert::error('Input Data', 'Ada Bagian yang Masih Kosong' . $th);
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
    }

    public function generate($id)
    {
        abort_unless(Gate::allows('hasPermission', 'master_mesin'), 403);

        $mesin = MasterMesin::find($id);
        if (!$mesin) {
            abort(404);
        }
        // Generate the QR code
        $qrCode = QrCode::format('png')->size(200)->generate($mesin->kode);
        return view('mastermesin.MesinQR', compact('qrCode', 'mesin'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterMesin  $masterMesin
     * @return \Illuminate\Http\Response
     */
    public function show(MasterMesin $mastermesin)
    {
        abort_unless(Gate::allows('hasPermission', 'master_mesin'), 403);

        return view('mastermesin.show', compact('mastermesin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterMesin  $masterMesin
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterMesin $mastermesin)
    {
        abort_unless(Gate::allows('hasPermission', 'master_mesin'), 403);

        return view('mastermesin.edit', compact('mastermesin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterMesin  $masterMesin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterMesin $mastermesin)
    {
        abort_unless(Gate::allows('hasPermission', 'master_mesin'), 403);

        $dt = Carbon::now();
        $todayDate = $dt->format('Y-m-d');
        $validator = Validator::make(
            $request->all(),
            [
                'kode' => 'required',
                'nama' => 'required',
                'keterangan' => 'required',
                'poin' => 'required',
                'is_gudang_finish' => 'required',
                'is_gudang_kirim' => 'required'
            ],
        );

        // dd("Proses Insert data", $request->all());
        try {
            $mastermesin->update([
                'kode' => $request->kode,
                'nama' => $request->nama,
                'keterangan' => $request->keterangan,
                'poin' => $request->poin,
                'is_gudang_finish' => $request->is_gudang_finish ?? 0,
                'is_gudang_kirim' => $request->is_gudang_kirim ?? 0,
            ]);
            // $historymesin = [
            //     'tanggal' => $todayDate,
            //     'nama_mesin' => $request->nama,
            //     'nama_operator' => $request->jenis_operator,
            //     'poin' => $request->poin,
            //     'keterangan' => 'Update',
            // ];
            // return dd($mastermesin);
            // DB::table('history_mesins')->insert($historymesin);
            Alert::success('Edit Data', 'Edit Data Berhasil');
            return redirect()->route('mastermesin.index');
        } catch (\Throwable $th) {
            Alert::error('Edit Data', 'Ada Bagian yang Masih Kosong' . $th);
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterMesin  $masterMesin
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterMesin $mastermesin)
    {
        abort_unless(Gate::allows('hasPermission', 'master_mesin'), 403);
        
        try {
            $mesinName = $mastermesin->nama;
            // $namaoperator = $mastermesin->jenis_operator;
            $lastPoin = $mastermesin->poin;
            $mastermesin->delete();
            $dt = Carbon::now();
            $todayDate = $dt->format('Y-m-d');

            // $historymesin = [
            //     'tanggal' => $todayDate,
            //     'nama_mesin' => $mesinName,
            //     // 'nama_operator' => $namaoperator,
            //     'poin' => $lastPoin,
            //     'keterangan' => 'Delete',
            // ];
            // DB::table('history_mesins')->insert($historymesin);
            Alert::success('Hapus Data', 'Hapus Data Berhasil');
        } catch (\Throwable $th) {
            Alert::error('Hapus Data', 'Hapus Data Gagal' .$th);
        }
        return redirect()->back();
    }
}
