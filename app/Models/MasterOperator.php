<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterOperator extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode', 
        'nama',
        'NPWP',
        'alamat',
        'jenis_operator',
        'scan_count',
    ];
}
