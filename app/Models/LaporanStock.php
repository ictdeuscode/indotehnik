<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanStock extends Model
{
    use HasFactory;

    protected $table = "laporan_stock";

    protected $fillable = [
        'id_master_preorder',
        'qty',
        'keterangan',
    ];

    public function preorder()
    {
        return $this->belongsTo(MasterPreorder::class, 'id_master_preorder', 'id');
    }
}
