<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class MasterPegawai extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'kode',
        'nama',
        'NPWP',
        'alamat',
        'provinsi',
        'kota',
        'kecamatan',
        'kelurahan',
        'kode_pos',
        'no_telp',
        'fax',
        'email',
        'kontak',
        'password',
        'id_role'
    ];

    public function role()
    {
        return $this->belongsTo(MasterRole::class, 'id_role');
    }
}
