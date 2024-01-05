<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorySuratPhoto extends Model
{
    use HasFactory;

    protected $table = "history_surat_photos";
    public $timestamps = false;
    
    protected $fillable = [
        'id_history_surat',
        'url'
    ];

    public function history_surat()
    {
        return $this->belongsTo(HistorySurat::class, 'id_history_surat', 'id');
    }
}
