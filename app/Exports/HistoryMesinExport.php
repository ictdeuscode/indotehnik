<?php

namespace App\Exports;

use App\Models\HistoryMesin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HistoryMesinExport implements FromQuery, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function query()
    {
        return HistoryMesin::query();
    }

    public function headings(): array
    {
        return [
            'No',
            'No. Surat',
            'Tanggal Scan',
            'Nama Mesin',
            'Nama Operator',
            'Keterangan',
        ];
    }
}
