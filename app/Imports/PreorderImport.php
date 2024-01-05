<?php

namespace App\Imports;

use App\Imports\PreorderImport as ImportsPreorderImport;
use App\Models\MasterPreorder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class PreorderImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public static $imported = [];
    public function model(array $row)
    {
        //kalau ada baris kosong
        if (empty(array_filter($row))) {
            return null;
        }

        //kalau ada data yang sama (berdasarkan no.order)
        $existingData = DB::table('master_preorders')
            ->where('nomor', $row['nomor'])
            ->first();
        if ($existingData) {
            return null;
        }

        PreorderImport::$imported[] = $row["nomor"];

        // Convert Excel date value to Unix timestamp
        $dateValue = $row['tanggal'];
        $excelTimestamp = ($dateValue - 25569) * 86400;

        // Convert Unix timestamp to SQL date format
        $date = date('Y-m-d', $excelTimestamp);

        return new MasterPreorder([
            'nomor' => $row['nomor'],
            'nama_barang' => $row['nama_barang'],
            'tanggal' => $date,
            'customer' => $row['customer'],
            'quantity' => $row['quantity'],
            'satuan' => $row['satuan'],
            'explanation' => $row['explanation'],
            'keterangan' => $row['keterangan'],
        ]);
    }
}
