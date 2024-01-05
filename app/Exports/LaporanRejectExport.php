<?php

namespace App\Exports;

use App\Models\HistorySurat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class LaporanRejectExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStrictNullComparison
{
    protected $nomorOrderFilter = NULL;
    protected $namaCustomerFilter = NULL;
    protected $namaBarangFilter = NULL;
    protected $tanggalStartFilter = NULL;
    protected $tanggalEndFilter = NULL;
    protected $namaOperatorFilter = NULL;
    protected $namaMesinFilter = NULL;
    protected $tipeRejectFilter = NULL;
    protected $keteranganRejectFilter = NULL;
    protected $rowNumber = 0;

    public function __construct($nomorOrderFilter, $namaCustomerFilter, $namaBarangFilter, $tanggalStartFilter, $tanggalEndFilter, $namaOperatorFilter, $namaMesinFilter, $tipeRejectFilter, $keteranganRejectFilter)
    {
        $this->nomorOrderFilter = $nomorOrderFilter;
        $this->namaCustomerFilter = $namaCustomerFilter;
        $this->namaBarangFilter = $namaBarangFilter;
        $this->tanggalStartFilter = $tanggalStartFilter;
        $this->tanggalEndFilter = $tanggalEndFilter;
        $this->namaOperatorFilter = $namaOperatorFilter;
        $this->namaMesinFilter = $namaMesinFilter;
        $this->tipeRejectFilter = $tipeRejectFilter;
        $this->keteranganRejectFilter = $keteranganRejectFilter;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $datas = HistorySurat::when(!empty($this->tanggalStartFilter), function($query){
            $query->whereDate("history_surats.tanggal", ">=", $this->tanggalStartFilter);
        })
        ->when(!empty($this->tanggalEndFilter), function($query){
            $query->whereDate("history_surats.tanggal", "<=", $this->tanggalEndFilter);
        })
        ->when(!empty($this->namaOperatorFilter), function($query){
            $query->join('master_operators', 'master_operators.id', 'history_surats.id_operator')
            ->where('master_operators.nama', 'LIKE', '%'.$this->namaOperatorFilter.'%');
        })
        ->when(!empty($this->namaMesinFilter), function($query){
            $query->join('master_mesins', 'master_mesins.id', 'history_surats.id_mesin')
            ->where('master_mesins.nama', 'LIKE', '%'.$this->namaMesinFilter.'%');
        })
        ->when(!empty($this->tipeRejectFilter), function($query){
            $query->where('tipe_reject', 'LIKE', '%'.$this->tipeRejectFilter.'%');
        })
        ->when(!empty($this->keteranganRejectFilter), function($query){
            $query->where('keterangan_reject', 'LIKE', '%'.$this->keteranganRejectFilter.'%');
        });

        if(!empty($this->nomorOrderFilter || !empty($this->namaCustomerFilter) || !empty($this->namaBarangFilter)))
        {
            $datas->join('master_preorders', 'master_preorders.id', 'history_surats.id_surat')
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

        $datas = $datas->where('is_reject', 1)->get();

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
            'Nama Operator',
            'Nama Mesin',
            'Tipe Reject',
            'Keterangan Reject'
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
            $row->operator?->nama,
            $row->mesin?->nama,
            $row->tipe_reject == 1 ? 'Dapat diperbaiki ( Operator dapat poin )' : 'Tidak dapat diperbaiki ( Operator tidak dapat poin )',
            $row->keterangan_reject,
        ];
    }
}
