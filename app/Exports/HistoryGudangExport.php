<?php

namespace App\Exports;

use App\Models\HistoryGudang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HistoryGudangExport implements FromQuery, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function query()
    {
        return HistoryGudang::query();
    }

    public function headings(): array
    {
        return [
            'No',
            'No. Pre-Order',
            'Tanggal Masuk',
            'Tanggal Selesai',
            'Keterangan',
        ];
    }
}
