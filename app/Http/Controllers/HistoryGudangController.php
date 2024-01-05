<?php

namespace App\Http\Controllers;

use App\Models\HistoryGudang;
use App\Exports\HistoryGudangExport;
use App\Models\HistorySurat;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;

class HistoryGudangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $tanggal = $request->input("startDateInput");
        // $tanggal2 = $request->input("endDateInput");
        // $startTanggal = "1990-05-05 00:00:00";
        // if ($tanggal != null) {
        //     $startTanggal = $tanggal . " 00:00:00";
        // }
        // $endTanggal = "2050-05-05 00:00:00";
        // if ($tanggal2 != null) {
        //     $endTanggal = $tanggal2 . " 23:59:59";
        // }
        // $historygudang = HistoryGudang::where("tanggal_masuk", ">=", $startTanggal)->where("tanggal_keluar", "<=", $endTanggal)->paginate(5);
        // return view('historygudang.index', compact('historygudang', 'tanggal', 'tanggal2'));

        // $historygudang = HistoryGudang::paginate(5);
        // return view('historygudang.index', compact('historygudang'));
        $tanggal = $request->input("startDateInput");
        $tanggal2 = $request->input("endDateInput");
        $startTanggal = "1990-05-05 00:00:00";
        if ($tanggal != null) {
            $startTanggal = $tanggal . " 00:00:00";
        }
        $endTanggal = "2050-05-05 00:00:00";
        if ($tanggal2 != null) {
            $endTanggal = $tanggal2 . " 23:59:59";
        }
        $historysurat = HistorySurat::where("tanggal", ">=", $startTanggal)->where("tanggal", "<=", $endTanggal)->paginate(5);
        return view('historygudang.index', compact('historysurat', 'tanggal', 'tanggal2'));
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
    public function show(HistoryGudang $historygudang)
    {
        return view('historygudang.show', compact('historygudang'));
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
        //
    }

    public function exporthistorygudang()
    {
        return Excel::download(new HistoryGudangExport, 'HistoryGudang.xlsx');
    }
}
