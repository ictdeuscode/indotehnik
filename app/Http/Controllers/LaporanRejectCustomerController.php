<?php

namespace App\Http\Controllers;

use App\Exports\LaporanRejectCustomerExport;
use App\Models\HistoryPoin;
use App\Models\HistoryRejectCustomer;
use App\Models\HistorySurat;
use App\Models\MasterMesin;
use App\Models\MasterOperator;
use App\Models\MasterPreorder;
use Aws\History;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class LaporanRejectCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_unless(Gate::allows('hasPermission', 'laporan_reject_customer'), 403);

       $tanggalStartFilter = $request->tanggal_start_filter;
       $tanggalEndFilter = $request->tanggal_end_filter;
       $nomorOrderFilter = $request->nomor_order_filter;
       $namaCustomerFilter = $request->nama_customer_filter;
       $namaBarangFilter = $request->nama_barang_filter;
       $keteranganRejectFilter = $request->keterangan_reject_filter;

        $laporanrejectcustomer = HistoryRejectCustomer::when(!empty($tanggalStartFilter), function ($query) use ($tanggalStartFilter) {
            $query->whereDate("history_reject_customers.created_at", ">=", $tanggalStartFilter);
        })->when(!empty($tanggalEndFilter), function ($query) use ($tanggalEndFilter) {
            $query->whereDate("history_reject_customers.created_at", "<=", $tanggalEndFilter);
        })->when(!empty($keteranganRejectFilter), function ($query) use ($keteranganRejectFilter) {
            $query->where("history_reject_customers.keterangan_reject", "<=", $keteranganRejectFilter);
        });

        if(!empty($nomorOrderFilter || !empty($namaCustomerFilter) || !empty($namaBarangFilter)))
        {
            $laporanrejectcustomer->join('master_preorders', 'master_preorders.id', 'history_reject_customers.id_surat')
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

        $laporanrejectcustomer = $laporanrejectcustomer->paginate(5);

        return view('laporanrejectcustomer.index', compact('laporanrejectcustomer', 'tanggalStartFilter', 'tanggalEndFilter', 'nomorOrderFilter', 'namaCustomerFilter', 'namaBarangFilter', 'keteranganRejectFilter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Gate::allows('hasPermission', 'laporan_reject_customer'), 403);

        $mesin_finish_ids = MasterMesin::where('is_gudang_finish', 1)->pluck('id');
        $surat_finish_ids = HistorySurat::whereIn('id_mesin', $mesin_finish_ids)
            ->where('is_approve', 1)
            ->pluck('id_surat');

        $rejected = HistoryRejectCustomer::pluck('id_surat');

        $surat_orders = MasterPreorder::whereIn('id', $surat_finish_ids)
            ->whereNotIn('id', $rejected)
            ->get();

        return view('laporanrejectcustomer.create', compact('surat_orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_unless(Gate::allows('hasPermission', 'laporan_reject_customer'), 403);

        $validator = Validator::make(
            $request->all(),
            [
                'id_surat' => 'required',
                'keternagan_reject' => 'required',
            ],
        );

        try {
            $laporanrejectcustomer = HistoryRejectCustomer::create([
                'id_surat' => $request->id_surat,
                'keterangan_reject' => $request->keterangan_reject
            ]);

            $surat_order = MasterPreorder::find($request->id_surat);
            $surat_order->nomor = $surat_order->nomor . " - VOID";
            $surat_order->save();

            $history_surats = HistorySurat::where('id_surat', $request->id_surat)->get();
            foreach($history_surats as $history)
            {
                $mesin = MasterMesin::find($history->id_mesin);
                $operator = MasterOperator::find($history->id_operator);

                $history_poin = new HistoryPoin();
                $history_poin->id_operator = $operator->id;
                $history_poin->id_history_surat = $history->id;
                $history_poin->posisi = "K";
                $history_poin->poin = $mesin->poin;
                $history_poin->keterangan = $mesin->poin . " poin dipotong karena pengerjaan nomor order " .$history->preorder->nomor . " direject oleh customer";
                $history_poin->tanggal = Carbon::now();
                $history_poin->save();
            }

            Alert::success('Input Data', 'Input Data Berhasil');
            return redirect()->route('laporanrejectcustomer.index');
        } catch (\Throwable $th) {
            Alert::error('Input Data', 'Ada Bagian yang Masih Kosong');
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
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
    public function edit(HistoryRejectCustomer $laporanrejectcustomer)
    {
        abort_unless(Gate::allows('hasPermission', 'laporan_reject_customer'), 403);

        return view('laporanrejectcustomer.edit', compact('laporanrejectcustomer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HistoryRejectCustomer $laporanrejectcustomer)
    {
        abort_unless(Gate::allows('hasPermission', 'laporan_reject_customer'), 403);

        $validator = Validator::make(
            $request->all(),
            [
                'keternagan_reject' => 'required',
            ],
        );

        try {
            $laporanrejectcustomer->update([
                'keterangan_reject' => $request->keterangan_reject
            ]);
            Alert::success('Edit Data', 'Edit Data Berhasil');
            return redirect()->route('laporanrejectcustomer.index');
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

    public function exportlaporanreject(Request $request) 
    {
        abort_unless(Gate::allows('hasPermission', 'laporan_reject_customer'), 403);
        
        return Excel::download(new LaporanRejectCustomerExport($request->tanggal_start_filter, $request->tanggal_end_filter, $request->nomor_order_filter, $request->nama_customer_filter, $request->nama_barang_filter, $request->keterangan_reject_filter), 'LaporanRejectCustomer.xlsx');
    }
}
