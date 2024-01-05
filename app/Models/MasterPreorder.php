<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPreorder extends Model
{
    use HasFactory;
    protected $fillable = ['nomor', 'tanggal', 'nama_barang', 'customer', 'quantity', 'satuan', 'explanation', 'keterangan', 'is_stock'];

    public function photos()
    {
        return $this->hasMany(MasterPreorderPhoto::class, 'id_master_preorder', 'id');
    }
}
