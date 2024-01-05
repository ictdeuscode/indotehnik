<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryPoin extends Model
{
    use HasFactory;
    protected $fillable = ['id_operator', 'posisi', 'poin', 'tanggal', 'keterangan'];

    public function operator()
    {
        return $this->belongsTo(MasterOperator::class, 'id_operator', 'id');
    }

}
