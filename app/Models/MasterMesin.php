<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterMesin extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode', 
        'nama',
        'keterangan',
        'poin',
        'is_gudang_finish',
        'is_gudang_kirim'
    ];
}
