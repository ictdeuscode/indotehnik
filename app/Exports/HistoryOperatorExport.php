<?php

namespace App\Exports;

use App\Models\HistoryOperator;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HistoryOperatorExport implements FromQuery, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    
    public function query()
    {
        return HistoryOperator::query();
    }

    public function headings(): array
    {
        return [
            'No',
            'Tanggal Scan',
            'Nama Mesin',
            'Nama Barang',
            'Waktu/Jam',
            'Keterangan',
        ];
    }
}
