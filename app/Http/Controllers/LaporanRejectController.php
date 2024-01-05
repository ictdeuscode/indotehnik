<?php

namespace App\Http\Controllers;

use App\Exports\LaporanRejectExport;
use App\Models\HistorySurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;

class LaporanRejectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_unless(Gate::allows('hasPermission', 'laporan_reject'), 403);

        $nomorOrderFilter = $request->nomor_order_filter;
        $namaCustomerFilter = $request->nama_customer_filter;
        $namaBarangFilter = $request->nama_barang_filter;
        $tanggalStartFilter = $request->tanggal_start_filter;
        $tanggalEndFilter = $request->tanggal_end_filter;
        $namaOperatorFilter = $request->nama_operator_filter;
        $namaMesinFilter = $request->nama_mesin_filter;
        $tipeRejectFilter = $request->tipe_reject_filter;
        $keteranganRejectFilter = $request->keterangan_reject_filter;

        $laporanreject = HistorySurat::when(!empty($tanggalStartFilter), function($query) use ($tanggalStartFilter){
            $query->whereDate("history_surats.tanggal", ">=", $tanggalStartFilter);
        })
        ->when(!empty($tanggalEndFilter), function($query) use ($tanggalEndFilter){
            $query->whereDate("history_surats.tanggal", "<=", $tanggalEndFilter);
        })
        ->when(!empty($namaOperatorFilter), function($query) use ($namaOperatorFilter){
            $query->join('master_operators', 'master_operators.id', 'history_surats.id_operator')
            ->where('master_operators.nama', 'LIKE', '%'.$namaOperatorFilter.'%');
        })
        ->when(!empty($namaMesinFilter), function($query) use ($namaMesinFilter){
            $query->join('master_mesins', 'master_mesins.id', 'history_surats.id_mesin')
            ->where('master_mesins.nama', 'LIKE', '%'.$namaMesinFilter.'%');
        })
        ->when(!empty($tipeRejectFilter), function($query) use ($tipeRejectFilter){
            $query->where('tipe_reject', 'LIKE', '%'.$tipeRejectFilter.'%');
        })
        ->when(!empty($keteranganRejectFilter), function($query) use ($keteranganRejectFilter){
            $query->where('keterangan_reject', 'LIKE', '%'.$keteranganRejectFilter.'%');
        });

        if(!empty($nomorOrderFilter || !empty($namaCustomerFilter) || !empty($namaBarangFilter)))
        {
            $laporanreject->join('master_preorders', 'master_preorders.id', 'history_surats.id_surat')
            ->when(!empty($nomorOrderFilter), function($query) use ($nomorOrderFilter){
                $query->where("master_preorders.nomor", "LIKE", '%' . $nomorOrderFilter . '%');
            })
            ->when(!empty($namaCustomerFilter), function($query) use ($namaCustomerFilter){
                $query->where("master_preorders.customer", "LIKE", '%' . $namaCustomerFilter . '%');
            })
            ->when(!empty($namaBarangFilter), function($query) use ($namaBarangFilter){
                $query->where("master_preorders.nama_barang", "LIKE", '%' . $namaBarangFilter . '%');
            });
        }

        $laporanreject = $laporanreject->where('is_reject', 1)->paginate(5);

        return view('laporanreject.index', compact('laporanreject', 'nomorOrderFilter', 'namaCustomerFilter', 'namaBarangFilter', 'tanggalStartFilter', 'tanggalEndFilter', 'namaOperatorFilter', 'namaMesinFilter', 'tipeRejectFilter', 'keteranganRejectFilter'));
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
     * @param  \App\Models\HistorySurat  $historySurat
     * @return \Illuminate\Http\Response
     */
    public function show(HistorySurat $historySurat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HistorySurat  $historySurat
     * @return \Illuminate\Http\Response
     */
    public function edit(HistorySurat $historySurat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HistorySurat  $historySurat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HistorySurat $historySurat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HistorySurat  $historySurat
     * @return \Illuminate\Http\Response
     */
    public function destroy(HistorySurat $historySurat)
    {
        //
    }

    public function exportlaporanreject(Request $request) 
    {
        abort_unless(Gate::allows('hasPermission', 'laporan_reject'), 403);
        
        return Excel::download(new LaporanRejectExport($request->nomor_order_filter, $request->nama_customer_filter, $request->nama_barang_filter, $request->tanggal_start_filter, $request->tanggal_end_filter, $request->nama_operator_filter, $request->nama_mesin_filter, $request->tipe_reject_filter, $request->keterangan_reject_filter), 'LaporanReject.xlsx');
    }
}
