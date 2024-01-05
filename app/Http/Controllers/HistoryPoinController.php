<?php

namespace App\Http\Controllers;

use App\Exports\HistoryPoinExport;
use App\Models\HistoryPoin;
use App\Models\HistorySurat;
use App\Models\MasterOperator;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;

class HistoryPoinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_unless(Gate::allows('hasPermission', 'laporan_poin_karyawan'), 403);

        $tanggal = $request->input("startDateInput");
        $tanggal2 = $request->input("endDateInput");
        $namaOperatorFilter = $request->input("nama_operator_filter");
        $startTanggal = "1990-05-05 00:00:00";
        if ($tanggal != null) {
            $startTanggal = $tanggal . " 00:00:00";
        }
        $endTanggal = "2050-05-05 00:00:00";
        if ($tanggal2 != null) {
            $endTanggal = $tanggal2 . " 23:59:59";
        }

        // $historypoin = HistoryPoin::where("tanggal", ">=", $startTanggal)->where("tanggal", "<=", $endTanggal)->paginate(5);

        $historypoin = HistoryPoin::where("tanggal", ">=", $startTanggal)
            ->where("tanggal", "<=", $endTanggal)
            ->get();

        $operators = MasterOperator::when(!empty($namaOperatorFilter), function($query) use ($namaOperatorFilter){
            $query->where('nama', 'LIKE', '%'.$namaOperatorFilter.'%');
        })->get();

        foreach($operators as $operator)
        {
            $historypoin = HistoryPoin::where('id_operator', $operator->id)->get();

            $operator->total_poin = $historypoin->where('posisi', 'D')->sum('poin') - $historypoin->where('posisi', 'K')->sum('poin');
            $operator->poin_didapat = HistoryPoin::whereDate("tanggal", ">=", $startTanggal)->whereDate("tanggal", "<=", $endTanggal)->where('posisi', 'D')->where('id_operator', $operator->id)->sum('poin');
            $operator->poin_ditukar = HistoryPoin::whereDate("tanggal", ">=", $startTanggal)->whereDate("tanggal", "<=", $endTanggal)->where('posisi', 'K')->where('id_operator', $operator->id)->sum('poin');
        }

        return view('historypoin.index', compact('operators', 'tanggal', 'tanggal2', 'namaOperatorFilter'));
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
     * @param  \App\Models\MasterOperator  $masteroperator
     * @return \Illuminate\Http\Response
     */
    public function show(MasterOperator $laporanpoinkaryawan)
    {
        abort_unless(Gate::allows('hasPermission', 'laporan_poin_karyawan'), 403);

        $progress = HistorySurat::where('id_operator', $laporanpoinkaryawan->id)->orderBy('id', 'desc')->get();
        $exchanges = HistoryPoin::where('id_operator', $laporanpoinkaryawan->id)->where('posisi', 'K')->orderBy('id', 'desc')->get();
        
        foreach($progress as $p)
        {
            $p->poin_didapat = HistoryPoin::where('id_operator', $laporanpoinkaryawan->id)
                ->where('posisi', 'D')
                ->where('id_history_surat', $p->id)
                ->sum('poin');
        }

        return view('historypoin.show', compact('laporanpoinkaryawan', 'progress', 'exchanges'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HistoryPoin  $historyPoin
     * @return \Illuminate\Http\Response
     */
    public function edit(HistoryPoin $historyPoin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HistoryPoin  $historyPoin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HistoryPoin $historyPoin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HistoryPoin  $historyPoin
     * @return \Illuminate\Http\Response
     */
    public function destroy(HistoryPoin $historyPoin)
    {
        //
    }

    public function editpoin(Request $request)
    {
        abort_unless(Gate::allows('hasPermission', 'laporan_poin_karyawan'), 403);

        $id_operator = $request->id_operator;
        $poin = $request->poin;

        if($request->action_type == "TAMBAH")
        {
            $historysurat = HistorySurat::find($request->id_history_surat);
        }

        $historypoin = new HistoryPoin();
        $historypoin->id_operator = $id_operator;
        $historypoin->id_history_surat = $request->action_type == "TAMBAH" ? $request->id_history_surat : NULL;
        $historypoin->posisi = $request->action_type == "TAMBAH" ? "D" : "K";
        $historypoin->poin = $poin;
        $historypoin->keterangan = $request->action_type == "TAMBAH" ? "Mendapatkan bonus " . $poin . " poin dari pengerjaan nomor order " . $historysurat->preorder->nomor : $request->keterangan;
        $historypoin->tanggal = Carbon::now();
        $historypoin->save();

        if($request->action_type == "TAMBAH")
        {
            Alert::success('Tambah poin', 'Tambah poin Berhasil');
            return redirect()->route('laporanpoinkaryawan.show', ['laporanpoinkaryawan' => $id_operator]);
        }else{
            Alert::success('Tukar poin', 'Tukar poin Berhasil');
            return redirect()->route('laporanpoinkaryawan.index');
        }
    }

    public function exporthistorypoin(Request $request)
    {
        abort_unless(Gate::allows('hasPermission', 'laporan_poin_karyawan'), 403);
        
        return Excel::download(new HistoryPoinExport($request->startDateInput, $request->endDateInput, $request->nama_operator_filter), 'HistoryPoin.xlsx');
    }
}
