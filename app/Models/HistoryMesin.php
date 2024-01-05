<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryMesin extends Model
{
    use HasFactory;
    protected $fillable = ['tanggal', 'no_surat', 'nama_mesin', 'nama_operator', 'keterangan', 'poin'];

    public function mesin()
    {
        return $this->belongsTo(MasterMesin::class);
    }

    public function operator()
    {
        return $this->belongsTo(MasterOperator::class);
    }
}
