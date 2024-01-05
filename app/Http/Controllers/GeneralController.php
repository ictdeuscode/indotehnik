<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeneralController extends Controller
{
    public function autocomplete(Request $request)
    {
        $table = $request->table;
        $column = $request->column;
        $filter = $request->filter;

        $datas = DB::table($table)->where($column, 'LIKE', '%'. $filter .'%')->distinct($column)->pluck($column);

        return $datas;
    }
}
