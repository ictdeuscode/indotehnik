<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryOperator extends Model
{
    use HasFactory;
    protected $fillable = ['tanggal', 'nama_mesin', 'nama_barang', 'waktu', 'keterangan'];

    public function operator()
    {
        return $this->belongsTo(MasterOperator::class);
    }

    public function mesin()
    {
        return $this->belongsTo(MasterMesin::class);
    }
}
