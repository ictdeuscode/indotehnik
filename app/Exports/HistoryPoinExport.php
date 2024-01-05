<?php

namespace App\Exports;

use App\Models\HistoryPoin;
use App\Models\MasterOperator;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class HistoryPoinExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStrictNullComparison
{
    /**
     * @return \Illuminate\Support\Collection
     */

     protected $startDate = NULL;
     protected $endDate = NULL;
     protected $namaOperatorFilter = NULL;
     protected $rowNumber = 0;

    public function __construct($startDate, $endDate, $namaOperatorFilter)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->namaOperatorFilter = $namaOperatorFilter;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $datas = MasterOperator::when(!empty($this->namaOperatorFilter), function($query){
            $query->where('nama', 'LIKE', '%'.$this->namaOperatorFilter.'%');
        })->get();

        foreach($datas as $data)
        {
            $historypoin = HistoryPoin::where('id_operator', $data->id)->get();

            $data->total_poin = $historypoin->where('posisi', 'D')->sum('poin') - $historypoin->where('posisi', 'K')->sum('poin');

            $data->poin_didapat = HistoryPoin::when(!empty($this->startDate), function ($query) {
                $query->whereDate("tanggal", ">=", $this->startDate);
            })->when(!empty($this->endDate), function ($query) {
                $query->whereDate("tanggal", "<=", $this->endDate);
            })->where('posisi', 'D')
            -> where('id_operator', $data->id)
            ->sum('poin');

            $data->poin_ditukar = HistoryPoin::when(!empty($this->startDate), function ($query) {
                $query->whereDate("tanggal", ">=", $this->startDate);
            })->when(!empty($this->endDate), function ($query) {
                $query->whereDate("tanggal", "<=", $this->endDate);
            })->where('posisi', 'K')
            ->where('id_operator', $data->id)
            ->sum('poin');
        }

        return $datas;
    }
 
    public function headings(): array
    {
        $filter = '( Semua )';

        if (!empty($this->startDate) && empty($this->endDate)) {
            $filter = '( ' . date('d M Y', strtotime($this->startDate)) . ' - Sekarang ' . ' )';
        } elseif (empty($this->startDate) && !empty($this->endDate)) {
            $filter = '( Sampai ' . date('d M Y', strtotime($this->endDate)) . ' )';
        } elseif (!empty($this->startDate) && !empty($this->endDate)) {
            $filter = '( ' . date('d M Y', strtotime($this->startDate)) . ' - ' . date('d M Y', strtotime($this->endDate)) . ' )';
        }

        return [
            'No',
            'Nama Operator',
            'Total Poin',
            'Poin Didapat ' . $filter,
            'Poin Ditukar ' . $filter,
        ];
    }

    public function map($row): array
    {
        return [
            ++$this->rowNumber,
            $row->nama,
            $row->total_poin,
            $row->poin_didapat,
            $row->poin_ditukar,
        ];
    }
}
