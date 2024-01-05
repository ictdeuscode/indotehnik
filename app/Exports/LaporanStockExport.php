<?php

namespace App\Exports;

use App\Models\LaporanStock;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class LaporanStockExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStrictNullComparison
{
    protected $tanggalStartFilter = NULL;
    protected $tanggalEndFilter = NULL;
    protected $nomorOrderFilter = NULL;
    protected $namaBarangFilter = NULL;
    protected $qtyFilter = NULL;
    protected $keteranganFilter = NULL;
    protected $rowNumber = 0;

    public function __construct($tanggalStartFilter, $tanggalEndFilter, $nomorOrderFilter, $namaBarangFilter, $qtyFilter, $keteranganFilter)
    {
        $this->tanggalStartFilter = $tanggalStartFilter;
        $this->tanggalEndFilter = $tanggalEndFilter;
        $this->nomorOrderFilter = $nomorOrderFilter;
        $this->namaBarangFilter = $namaBarangFilter;
        $this->qtyFilter = $qtyFilter;
        $this->keteranganFilter = $keteranganFilter;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $datas = LaporanStock::when(!empty($this->tanggalStartFilter), function ($query) {
            $query->whereDate("laporan_stock.created_at", ">=", $this->tanggalStartFilter);
        })->when(!empty($this->tanggalEndFilter), function ($query) {
            $query->whereDate("laporan_stock.created_at", "<=", $this->tanggalEndFilter);
        })->when(!empty($this->qtyFilter), function ($query) {
            $query->where("laporan_stock.qty", $this->qtyFilter);
        })->when(!empty($this->keteranganFilter), function ($query) {
            $query->where("laporan_stock.keterangan", "LIKE", '%'. $this->keteranganFilter . '%');
        });

        if(!empty($this->nomorOrderFilter) || !empty($this->namaBarangFilter))
        {
            $datas->join('master_preorders', 'master_preorders.id', 'laporan_stock.id_master_preorder')
            ->when(!empty($this->nomorOrderFilter), function($query){
                $query->where("master_preorders.nomor", "LIKE", '%' . $this->nomorOrderFilter . '%');
            })
            ->when(!empty($this->namaBarangFilter), function($query){
                $query->where("master_preorders.nama_barang", "LIKE", '%' . $this->namaBarangFilter . '%');
            });
        }

        $datas = $datas->get();

        return $datas;
    }

    public function headings(): array
    {
        return [
            'No',
            'Tanggal',
            'No. Order',
            'Nama Barang',
            'Qty',
            'Keterangan'
        ];
    }

    public function map($row): array
    {
        return [
            ++$this->rowNumber,
            date('d/m/Y', strtotime($row->created_at)),
            $row->preorder?->nomor,
            $row->preorder?->nama_barang,
            $row->qty,
            $row->keterangan,
        ];
    }
}
