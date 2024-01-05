<?php

namespace App\Http\Controllers;

use App\Exports\LaporanStockExport;
use App\Models\LaporanStock;
use App\Models\MasterPreorder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class LaporanStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_unless(Gate::allows('hasPermission', 'laporan_stock'), 403);

        $tanggalStartFilter = $request->tanggal_start_filter;
        $tanggalEndFilter = $request->tanggal_end_filter;
        $nomorOrderFilter = $request->nomor_order_filter;
        $namaBarangFilter = $request->nama_barang_filter;
        $qtyFilter = $request->qty_filter;
        $keteranganFilter = $request->keterangan_filter;


        $laporanstock = LaporanStock::when(!empty($tanggalStartFilter), function ($query) use ($tanggalStartFilter) {
            $query->whereDate("laporan_stock.created_at", ">=", $tanggalStartFilter);
        })->when(!empty($tanggalEndFilter), function ($query) use ($tanggalEndFilter) {
            $query->whereDate("laporan_stock.created_at", "<=", $tanggalEndFilter);
        })->when(!empty($qtyFilter), function ($query) use ($qtyFilter) {
            $query->where("laporan_stock.qty", $qtyFilter);
        })->when(!empty($keteranganFilter), function ($query) use ($keteranganFilter) {
            $query->where("laporan_stock.keterangan", "LIKE", '%'. $keteranganFilter . '%');
        });

        if(!empty($nomorOrderFilter) || !empty($namaBarangFilter))
        {
            $laporanstock->join('master_preorders', 'master_preorders.id', 'laporan_stock.id_master_preorder')
            ->when(!empty($nomorOrderFilter), function($query) use ($nomorOrderFilter){
                $query->where("master_preorders.nomor", "LIKE", '%' . $nomorOrderFilter . '%');
            })
            ->when(!empty($namaBarangFilter), function($query) use ($namaBarangFilter){
                $query->where("master_preorders.nama_barang", "LIKE", '%' . $namaBarangFilter . '%');
            });
        }

        $laporanstock = $laporanstock->paginate(5);

        return view('laporanstock.index', compact('laporanstock', 'tanggalStartFilter', 'tanggalEndFilter', 'nomorOrderFilter', 'namaBarangFilter', 'qtyFilter', 'keteranganFilter'));
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
    public function edit(LaporanStock $laporanstock)
    {
        abort_unless(Gate::allows('hasPermission', 'laporan_stock'), 403);

        return view('laporanstock.edit', compact('laporanstock'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LaporanStock $laporanstock)
    {
        abort_unless(Gate::allows('hasPermission', 'laporan_stock'), 403);

        $validator = Validator::make(
            $request->all(),
            [
                'qty' => 'required',
                'keterangan' => 'required',
            ],
        );

        try {
            $stock = MasterPreorder::find($laporanstock->id_master_preorder);
            if($laporanstock->qty != NULL){
                $stock->quantity = $stock->quantity + ($laporanstock->qty - $request->qty);
            }else{
                $stock->quantity = $stock->quantity - $request->qty;
            }
            $stock->save();

            $laporanstock->update([
                'qty' => $request->qty,
                'keterangan' => $request->keterangan
            ]);

            Alert::success('Edit Data', 'Edit Data Berhasil');
            return redirect()->route('laporanstock.index');
        } catch (\Throwable $th) {
            Alert::error('Edit Data', 'Ada Bagian yang Masih Kosong');
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function exportlaporanstock(Request $request) 
    {
        abort_unless(Gate::allows('hasPermission', 'laporan_stock'), 403);
        
        return Excel::download(new LaporanStockExport($request->tanggal_start_filter, $request->tanggal_end_filter, $request->nomor_order_filter, $request->nama_barang_filter, $request->qty_filter, $request->keterangan_filter), 'LaporanStock.xlsx');
    }
}
