<?php

namespace App\Exports;

use App\Models\HistoryRejectCustomer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class LaporanRejectCustomerExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStrictNullComparison
{
    protected $tanggalStartFilter = NULL;
    protected $tanggalEndFilter = NULL;
    protected $nomorOrderFilter = NULL;
    protected $namaCustomerFilter = NULL;
    protected $namaBarangFilter = NULL;
    protected $keteranganRejectFilter = NULL;
    protected $rowNumber = 0;

    public function __construct($tanggalStartFilter, $tanggalEndFilter, $nomorOrderFilter, $namaCustomerFilter, $namaBarangFilter, $keteranganRejectFilter)
    {
        $this->tanggalStartFilter = $tanggalStartFilter;
        $this->tanggalEndFilter = $tanggalEndFilter;
        $this->nomorOrderFilter = $nomorOrderFilter;
        $this->namaCustomerFilter = $namaCustomerFilter;
        $this->namaBarangFilter = $namaBarangFilter;
        $this->keteranganRejectFilter = $keteranganRejectFilter;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $datas = HistoryRejectCustomer::when(!empty($this->tanggalStartFilter), function ($query) {
            $query->whereDate("history_reject_customers.created_at", ">=", $this->tanggalStartFilter);
        })->when(!empty($this->tanggalEndFilter), function ($query) {
            $query->whereDate("history_reject_customers.created_at", "<=", $this->tanggalEndFilter);
        })->when(!empty($this->keteranganRejectFilter), function ($query) {
            $query->where("history_reject_customers.keterangan_reject", "<=", $this->keteranganRejectFilter);
        });

        if(!empty($this->nomorOrderFilter || !empty($this->namaCustomerFilter) || !empty($this->namaBarangFilter)))
        {
            $datas->join('master_preorders', 'master_preorders.id', 'history_reject_customers.id_surat')
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

        $datas = $datas->get();

        return $datas;
    }

    public function headings(): array
    {
        return [
            'No',
            'Tanggal',
            'No. Order',
            'Nama Customer',
            'Nama Barang',
            'Keterangan Reject'
        ];
    }

    public function map($row): array
    {
        return [
            ++$this->rowNumber,
            date('d/m/Y', strtotime($row->created_at)),
            $row->preorder?->nomor,
            $row->preorder?->customer,
            $row->preorder?->nama_barang,
            $row->keterangan_reject,
        ];
    }
}
