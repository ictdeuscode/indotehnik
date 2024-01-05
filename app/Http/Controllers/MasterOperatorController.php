<?php

namespace App\Http\Controllers;

use App\Models\MasterOperator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Database\Seeders\masterOperatorTableSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use MasterOperatorTable;
use PhpParser\Node\Stmt\TryCatch;


class MasterOperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_unless(Gate::allows('hasPermission', 'master_operator'), 403);

        $masterOperator = MasterOperator::paginate(10);
        return view('masteroperator.index', compact('masterOperator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Gate::allows('hasPermission', 'master_operator'), 403);

        return view('masteroperator.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // $dt = Carbon::now();
    // $dt->locale('id');
    // $todayDate = $dt->isoFormat('dddd, D MMMM YYYY');
    // $todayTime = $dt->format("H:i A");
    public function store(Request $request)
    {
        abort_unless(Gate::allows('hasPermission', 'master_operator'), 403);

        $dateValue = Carbon::now();
        $date = $dateValue->format('Y-m-d');
        $time = Carbon::now()->format('Y-m-d H:i:s');
        $validator = Validator::make(
            $request->all(),
            [
                'kode' => 'required',
                'nama' => 'required',
                'NPWP' => 'required',
                'alamat' => 'required',
                'jenis_operator' => 'required',
            ],
        );

        try {
            $masterOperator = MasterOperator::create([
                'kode' => $request->kode,
                'nama' => $request->nama,
                'NPWP' => $request->NPWP,
                'alamat' => $request->alamat,
                'jenis_operator' => $request->jenis_operator
            ]);
            // $historyoperator = [
            //     'tanggal' => $date,
            //     'nama_mesin' => $request->nama,
            //     'nama_barang' => $request->jenis_operator,
            //     'waktu' => $time,
            //     'keterangan' => 'Tambah',
            // ];
            // DB::table('history_operators')->insert($historyoperator);
            Alert::success('Input Data', 'Input Data Berhasil');
            return redirect()->route('masteroperator.index');
        } catch (\Throwable $th) {
            Alert::error('Input Data', 'Ada Bagian yang Masih Kosong');
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
    }

    public function generate($masteroperator)
    {
        abort_unless(Gate::allows('hasPermission', 'master_operator'), 403);

        $data = MasterOperator::findOrFail($masteroperator);
        // Increment the scan count
        $data->increment('scan_count');
        $masterOperatorQR = QrCode::format('png')->size(200)->generate($data->kode);
        return view('masteroperator.OperatorQR', compact('masterOperatorQR', 'data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterOperator  $masterOperator
     * @return \Illuminate\Http\Response
     */
    public function show(MasterOperator $masteroperator)
    {
        abort_unless(Gate::allows('hasPermission', 'master_operator'), 403);

        return view('masteroperator.show', compact('masteroperator'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterOperator  $masterOperator
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterOperator $masteroperator)
    {
        abort_unless(Gate::allows('hasPermission', 'master_operator'), 403);

        return view('masteroperator.edit', compact('masteroperator'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterOperator  $masterOperator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterOperator $masteroperator)
    {
        abort_unless(Gate::allows('hasPermission', 'master_operator'), 403);

        $dateValue = Carbon::now();
        $date = $dateValue->format('Y-m-d');

        $dt = Carbon::now();
        $dt->locale('id');
        $todayDate = $dt->isoFormat('dddd, D MMMM YYYY');
        $todayTime = $dt->format("H:i A");
        $validator = Validator::make(
            $request->all(),
            [
                'kode' => 'required',
                'nama' => 'required',
                'NPWP' => 'required',
                'alamat' => 'required',
                'jenis_operator' => 'required',
            ],
        );

        // dd("Proses Insert data", $request->all());
        try {
            $masteroperator->update([
                'kode' => $request->kode,
                'nama' => $request->nama,
                'NPWP' => $request->NPWP,
                'alamat' => $request->alamat,
                'jenis_operator' => $request->jenis_operator
            ]);

            // $historyoperator = [
            //     'tanggal' => $date,
            //     'nama_mesin' => $request->nama,
            //     'nama_barang' => $request->jenis_operator,
            //     'waktu' => $request->created_at,
            //     'keterangan' => 'Update',
            // ];
            // DB::table('history_operators')->insert($historyoperator);
            Alert::success('Edit Data', 'Edit Data Berhasil');
            return redirect()->route('masteroperator.index');
        } catch (\Throwable $th) {
            Alert::error('Edit Data', 'Ada Bagian yang Masih Kosong');
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterOperator  $masterOperator
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterOperator $masteroperator)
    {
        abort_unless(Gate::allows('hasPermission', 'master_operator'), 403);
        
        $dateValue = Carbon::now();
        $date = $dateValue->format('Y-m-d');

        try {
            $operatorName = $masteroperator->nama;
            $namaBarang = $masteroperator->jenis_operator;
            $masteroperator->delete();

            $dt = Carbon::now();
            $dt->locale('id');
            $todayDate = $dt->isoFormat('dddd, D MMMM YYYY');
            $todayTime = $dt->format("H:i A");

            // $historyoperator = [
            //     'tanggal' => $date,
            //     'nama_mesin' => $operatorName,
            //     'nama_barang' => $namaBarang,
            //     'waktu' => $date,
            //     'keterangan' => 'Delete',
            // ];
            // DB::table('history_operators')->insert($historyoperator);
            Alert::success('Hapus Data', 'Hapus Data Berhasil');
        } catch (\Throwable $th) {
            Alert::error('Hapus Data', 'Hapus Data Gagal');
        }

        return redirect()->back();
    }
}
