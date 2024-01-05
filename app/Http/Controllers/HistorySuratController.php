<?php

namespace App\Http\Controllers;

use App\Exports\HistorySuratExport;
use App\Models\HistoryPoin;
use App\Models\HistorySurat;
use App\Models\HistorySuratPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;

class HistorySuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_unless(Gate::allows('hasPermission', 'laporan_detail_pengerjaan'), 403);

        $nomorOrderFilter = $request->input('nomor_order_filter');
        $namaCustomerFilter = $request->input('nama_customer_filter');
        $namaBarangFilter = $request->input('nama_barang_filter');
        $tanggalMasukStartFilter = $request->input('tanggal_masuk_start_filter');
        $tanggalMasukEndFilter = $request->input('tanggal_masuk_end_filter');
        $tanggalKeluarStartFilter = $request->input('tanggal_keluar_start_filter');
        $tanggalKeluarEndFilter = $request->input('tanggal_keluar_end_filter');
        $namaOperatorFilter = $request->input('nama_operator_filter');
        $namaMesinFilter = $request->input('nama_mesin_filter');
        $keteranganFilter = $request->input('keterangan_filter');
        $keteranganProsesFilter = $request->input('keterangan_proses_filter');

        $historysurat_ids = HistorySurat::select('history_surats.id_surat', DB::raw('MAX(history_surats.id) as max_id'));
        if(!empty($nomorOrderFilter || !empty($namaCustomerFilter) || !empty($namaBarangFilter)))
        {
            $historysurat_ids->join('master_preorders', 'master_preorders.id', 'history_surats.id_surat')
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
        $historysurat_ids->when(!empty($tanggalMasukStartFilter), function($query) use ($tanggalMasukStartFilter){
            $query->whereDate("history_surats.tanggal", ">=", $tanggalMasukStartFilter);
        })
        ->when(!empty($tanggalMasukEndFilter), function($query) use ($tanggalMasukEndFilter){
            $query->whereDate("history_surats.tanggal", "<=", $tanggalMasukEndFilter);
        })
        ->when(!empty($tanggalKeluarStartFilter), function($query) use ($tanggalKeluarStartFilter){
            $query->whereDate("history_surats.tanggal_keluar", ">=", $tanggalKeluarStartFilter);
        })
        ->when(!empty($tanggalKeluarEndFilter), function($query) use ($tanggalKeluarEndFilter){
            $query->whereDate("history_surats.tanggal_keluar", "<=", $tanggalKeluarEndFilter);
        })
        ->when(!empty($namaOperatorFilter), function($query) use ($namaOperatorFilter){
            $query->join('master_operators', 'master_operators.id', 'history_surats.id_operator')
            ->where('master_operators.nama', 'LIKE', '%'.$namaOperatorFilter.'%');
        })
        ->when(!empty($namaMesinFilter), function($query) use ($namaMesinFilter){
            $query->join('master_mesins', 'master_mesins.id', 'history_surats.id_mesin')
            ->where('master_mesins.nama', 'LIKE', '%'.$namaMesinFilter.'%');
        })
        ->when(!empty($keteranganFilter), function($query) use ($keteranganFilter){
            $query->where('keterangan', 'LIKE', '%'.$keteranganFilter.'%');
        })
        ->when(!empty($keteranganProsesFilter), function($query) use ($keteranganProsesFilter){
            $query->where('keterangan_proses', 'LIKE', '%'.$keteranganProsesFilter.'%');
        });
        $historysurat_ids = $historysurat_ids->groupBy('history_surats.id_surat')->pluck('max_id');

        $historysurat = HistorySurat::whereIn('id', $historysurat_ids)->orderBy('updated_at', 'desc')->paginate(5);

        return view('historysurat.index', compact('historysurat', 'nomorOrderFilter', 'namaCustomerFilter', 'namaBarangFilter', 'tanggalMasukStartFilter', 'tanggalMasukEndFilter', 'tanggalKeluarStartFilter', 'tanggalKeluarEndFilter', 'namaOperatorFilter', 'namaMesinFilter', 'keteranganFilter', 'keteranganProsesFilter'));
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
    public function show(HistorySurat $laporandetailpengerjaan)
    {
        abort_unless(Gate::allows('hasPermission', 'laporan_detail_pengerjaan'), 403);

        $progress = HistorySurat::where('id_surat', $laporandetailpengerjaan->id_surat)->get();
        return view('historysurat.show', compact('laporandetailpengerjaan', 'progress'));
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_unless(Gate::allows('hasPermission', 'laporan_detail_pengerjaan'), 403);

        $historySurat = HistorySurat::find($id);

        $historySuratPhotos = HistorySuratPhoto::where('id_history_surat', $historySurat->id)->get();
        foreach ($historySuratPhotos as $photo) {
            $url = $photo->url;

            $pathInfo = pathinfo($url);
            $s3Path = 'foto-proses/';
            $filename = $pathInfo['basename'];

            Storage::disk('s3')->delete($s3Path . $filename);
        }
        HistorySuratPhoto::where('id_history_surat', $historySurat->id)->delete();

        $historySurat->delete();

        $historyBefore = HistorySurat::where('no_surat', $historySurat->no_surat)
        ->orderBy('id', 'desc')
        ->first();

        if($historyBefore != NULL)
        {
            $historyBefore->update(['tanggal_keluar' => NULL]);
            return redirect()->route('laporandetailpengerjaan.show', ['laporandetailpengerjaan' => $historyBefore->id]);
        }else{
            return redirect()->route('laporandetailpengerjaan.index');
        }

    }

    public function exporthistorysurat(Request $request) 
    {
        abort_unless(Gate::allows('hasPermission', 'laporan_detail_pengerjaan'), 403);
        
        return Excel::download(new HistorySuratExport($request->nomor_order_filter, $request->nama_customer_filter, $request->nama_barang_filter, $request->tanggal_masuk_start_filter, $request->tanggal_masuk_end_filter, $request->tanggal_keluar_start_filter, $request->tanggal_keluar_end_filter, $request->nama_operator_filter, $request->nama_mesin_filter, $request->keterangan_filter, $request->keterangan_proses_filter), 'LaporanDetailPengerjaan.xlsx');
    }

    public function approveAdmin(Request $request)
    {
        abort_unless(Gate::allows('hasPermission', 'laporan_detail_pengerjaan'), 403);

        $id_history_surat = $request->id_history_surat;


        $historySurat = HistorySurat::find($id_history_surat);

        $historySuratPoins = HistorySurat::where('id_surat', $historySurat->id_surat)
            ->whereNull('tipe_reject')
            ->where('is_exclude_point', 0)
            ->orWhere('tipe_reject', 1)
            ->get();

        foreach($historySuratPoins as $historySuratPoin)
        {
            $historypoin = new HistoryPoin();
            $historypoin->id_operator = $historySuratPoin->id_operator;
            $historypoin->id_history_surat = $historySuratPoin->id;
            $historypoin->posisi = "D";
            $historypoin->poin = $historySuratPoin->mesin->poin;
            $historypoin->keterangan = "Mendapat " . $historySuratPoin->mesin->poin . " dari pengerjaan nomor order " . $historySuratPoin->preorder->nomor . " tanggal " . $historySuratPoin->tanggal;
            $historypoin->tanggal = Carbon::now();
            $historypoin->save();
        }

        $updateHistorySurat = HistorySurat::where('id_surat', $historySurat->id_surat)->update(['is_approve' => 1]);

        Alert::success('Approve Admin', 'Approve admin berhasil !');
        return redirect()->route('laporandetailpengerjaan.show', ['laporandetailpengerjaan' => $id_history_surat]);
    }

    public function rejectAdmin(Request $request)
    {
        abort_unless(Gate::allows('hasPermission', 'laporan_detail_pengerjaan'), 403);

        $id_history_surat = $request->id_history_surat;

        $historysurat = HistorySurat::find($id_history_surat);
        $historysurat->is_reject = 1;
        $historysurat->tipe_reject = $request->tipe_reject;
        $historysurat->keterangan_reject = $request->keterangan;
        $historysurat->tanggal_reject = Carbon::now();
        $historysurat->save();

        if($request->tipe_reject == 2)
        {
            $historysuratbefore = HistorySurat::where('id_surat', $historysurat->id_surat)
                ->where('id', '<', $historysurat->id)
                ->get();

            $proses = count($historysuratbefore) + 1;

            $historysuratbefore->each(function($query) use ($proses){
                $query->is_reject = 1;
                $query->tipe_reject = 2;
                $query->keterangan_reject = 'Terkena reject dari proses ' . $proses;
                $query->tanggal_reject = Carbon::now();
                $query->save();
            });
        }

        Alert::success('Reject', 'Reject berhasil !');
        return redirect()->route('laporandetailpengerjaan.show', ['laporandetailpengerjaan' => $id_history_surat]);
    }

    public function togglePoint(Request $request, $id)
    {
        abort_unless(Gate::allows('hasPermission', 'laporan_detail_pengerjaan'), 403);
        
        $historySurat = HistorySurat::find($id);

        if($request->type == 'EXCLUDE')
        {
            $historySurat->is_exclude_point = 1;
            $historySurat->save();
        }else{
            $historySurat->is_exclude_point = 0;
            $historySurat->save();
        }

        return redirect()->route('laporandetailpengerjaan.show', ['laporandetailpengerjaan' => $id]);
    }
}
