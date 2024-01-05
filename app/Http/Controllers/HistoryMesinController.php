<?php

namespace App\Http\Controllers;

use App\Exports\HistoryMesinExport;
use App\Models\HistoryMesin;
use App\Models\HistorySurat;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class HistoryMesinController extends Controller
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
        // $historymesin = HistoryMesin::where("tanggal", ">=", $startTanggal)->where("tanggal", "<=", $endTanggal)->paginate(5);
        // return view('historymesin.index', compact('historymesin', 'tanggal', 'tanggal2'));

        // $historymesin = HistoryMesin::paginate(5);
        // return view('historymesin.index', compact('historymesin'));
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
        return view('historymesin.index', compact('historysurat', 'tanggal', 'tanggal2'));
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
    public function show(HistoryMesin $historyMesin)
    {
        return view('historymesin.show', compact('historymesin'));
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

    public function exporthistorymesin()
    {
        return Excel::download(new HistoryMesinExport, 'HistoryMesin.xlsx');
    }
}
