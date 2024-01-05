<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistorySurat extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id_surat',
        'no_surat',
        'tanggal',
        'tanggal_keluar',
        'nama_mesin',
        'id_mesin',
        'keterangan',
        'keterangan_proses',
        'image',
        'id_operator',
        'nama_operator',
        'nama_operator_keluar',
        'is_approve',
        'is_reject',
        'tanggal_reject',
        'keterangan_reject',
        'tipe_reject'
    ];


    public function mesin()
    {
        return $this->belongsTo(MasterMesin::class, 'id_mesin', 'id');
    }

    public function operator()
    {
        return $this->belongsTo(MasterOperator::class, 'id_operator', 'id');
    }

    public function preorder()
    {
        return $this->belongsTo(MasterPreorder::class, 'id_surat', 'id');
    }

    public function photos()
    {
        return $this->hasMany(HistorySuratPhoto::class, 'id_history_surat', 'id');
    }
}
