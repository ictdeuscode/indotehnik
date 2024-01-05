<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterRole extends Model
{
    use HasFactory;

    protected $table = "master_roles";

    protected $fillable = [
        'nama',
    ];

    public function permissions()
    {
        return $this->belongsToMany(MasterPermission::class, 'permission_role','id_role', 'id_permission');
    }
}
