<?php

namespace App\Exports;

use App\Models\HistorySurat;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class HistorySuratExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStrictNullComparison
{
    protected $nomorOrderFilter = NULL;
    protected $namaCustomerFilter = NULL;
    protected $namaBarangFilter = NULL;
    protected $tanggalMasukStartFilter = NULL;
    protected $tanggalMasukEndFilter = NULL;
    protected $tanggalKeluarStartFilter = NULL;
    protected $tanggalKeluarEndFilter = NULL;
    protected $namaOperatorFilter = NULL;
    protected $namaMesinFilter = NULL;
    protected $keteranganFilter = NULL;
    protected $keteranganProsesFilter = NULL;
    protected $rowNumber = 0;

    public function __construct($nomorOrderFilter, $namaCustomerFilter, $namaBarangFilter, $tanggalMasukStartFilter, $tanggalMasukEndFilter, $tanggalKeluarStartFilter, $tanggalKeluarEndFilter, $namaOperatorFilter, $namaMesinFilter, $keteranganFilter, $keteranganProsesFilter)
    {
        $this->nomorOrderFilter = $nomorOrderFilter;
        $this->namaCustomerFilter = $namaCustomerFilter;
        $this->namaBarangFilter = $namaBarangFilter;
        $this->tanggalMasukStartFilter = $tanggalMasukStartFilter;
        $this->tanggalMasukEndFilter = $tanggalMasukEndFilter;
        $this->tanggalKeluarStartFilter = $tanggalKeluarStartFilter;
        $this->tanggalKeluarEndFilter = $tanggalKeluarEndFilter;
        $this->namaOperatorFilter = $namaOperatorFilter;
        $this->namaMesinFilter = $namaMesinFilter;
        $this->keteranganFilter = $keteranganFilter;
        $this->keteranganProsesFilter = $keteranganProsesFilter;
    }

    /**
     * @return \Illuminate\Support\Collection
     */

    public function collection()
    {
        $historysurat_ids = HistorySurat::select('history_surats.id_surat', DB::raw('MAX(history_surats.id) as max_id'));
        if(!empty($this->nomorOrderFilter || !empty($this->namaCustomerFilter) || !empty($this->namaBarangFilter)))
        {
            $historysurat_ids->join('master_preorders', 'master_preorders.id', 'history_surats.id_surat')
            ->when(!empty($this->nomorOrderFilter), function($query){
                $query->where("master_preorders.nomor", "LIKE", '%' . $this->nomorOrderFilter . '%');
            })
            ->when(!empty($this->namaCustomerFilter), function($query){
                $query->where("master_preorders.customer", "LIKE", '%' . $this->namaCustomerFilter . '%');
            })
            ->when(!empty($this->namaBarangFilter), function($query){
                $query->where("master_preorders.nama_barang", "LIKE", '%' . $this->namaBarangFilter . '%');
            });
        }
        $historysurat_ids->when(!empty($this->tanggalMasukStartFilter), function($query){
            $query->whereDate("history_surats.tanggal", ">=", $this->tanggalMasukStartFilter);
        })
        ->when(!empty($this->tanggalMasukEndFilter), function($query){
            $query->whereDate("history_surats.tanggal", "<=", $this->tanggalMasukEndFilter);
        })
        ->when(!empty($this->tanggalKeluarStartFilter), function($query){
            $query->whereDate("history_surats.tanggal_keluar", ">=", $this->tanggalKeluarStartFilter);
        })
        ->when(!empty($this->tanggalKeluarEndFilter), function($query){
            $query->whereDate("history_surats.tanggal_keluar", "<=", $this->tanggalKeluarEndFilter);
        })
        ->when(!empty($this->namaOperatorFilter), function($query){
            $query->join('master_operators', 'master_operators.id', 'history_surats.id_operator')
            ->where('master_operators.nama', 'LIKE', '%'.$this->namaOperatorFilter.'%');
        })
        ->when(!empty($this->namaMesinFilter), function($query){
            $query->join('master_mesins', 'master_mesins.id', 'history_surats.id_mesin')
            ->where('master_mesins.nama', 'LIKE', '%'.$this->namaMesinFilter.'%');
        })
        ->when(!empty($this->keteranganFilter), function($query){
            $query->where('keterangan', 'LIKE', '%'.$this->keteranganFilter.'%');
        })
        ->when(!empty($this->keteranganProsesFilter), function($query){
            $query->where('keterangan_proses', 'LIKE', '%'.$this->keteranganProsesFilter.'%');
        });
        $historysurat_ids = $historysurat_ids->groupBy('history_surats.id_surat')->pluck('max_id');

        $datas = HistorySurat::whereIn('id', $historysurat_ids)->get();

        return $datas;
    }

    public function headings(): array
    {
        return [
            'No',
            'No. Order',
            'Nama Customer',
            'Nama Barang',
            'Tanggal Masuk',
            'Tanggal Keluar',
            'Nama Operator',
            'Nama Mesin',
            'Keterangan',
            'Keterangan Proses'
        ];
    }

    public function map($row): array
    {
        return [
            ++$this->rowNumber,
            $row->preorder?->nomor,
            $row->preorder?->customer,
            $row->preorder?->nama_barang,
            date('d/m/Y', strtotime($row->tanggal)),
            date('d/m/Y', strtotime($row->tanggal_keluar)),
            $row->operator?->nama,
            $row->mesin?->nama,
            $row->keterangan,
            $row->keterangan_proses,
        ];
    }
}
