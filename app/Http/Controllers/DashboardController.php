<?php

namespace App\Http\Controllers;

use App\Models\HistorySurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    public function index() {
        $data=[];
        date_default_timezone_set('Asia/Jakarta');

        $tglsekarang=strtotime(date("Y-m-d H:i:s"));
        $ss=DB::table("history_surats")->where("tanggal_keluar",NULL)->get();

        $notif=[];
        for ($i=0;$i<count($ss);$i++)
        {
            $waktu=($tglsekarang-strtotime($ss[$i]->tanggal))/(3600*24);
            if ($waktu>=4){
                $notif[]=$ss[$i];
            }
        }
        $data["notif"]=$notif;

        $historykirim = HistorySurat::join('master_mesins', 'master_mesins.id', 'history_surats.id_mesin')
            ->where('master_mesins.is_gudang_kirim', 1)
            ->pluck('id_surat');

        $historysurat_ids = HistorySurat::select('history_surats.id_surat', DB::raw('MAX(history_surats.id) as max_id'))
            ->whereNotIn('history_surats.id_surat', $historykirim)
            ->groupBy('history_surats.id_surat')
            ->pluck('max_id');

        $historysurat = HistorySurat::whereIn('id', $historysurat_ids)->orderBy('updated_at', 'desc')->get();

        $data['belumkirim'] = $historysurat;

        return view('dashboard.index',$data);
    }
}
