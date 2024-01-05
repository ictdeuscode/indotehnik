<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPermission extends Model
{
    use HasFactory;

    protected $table = "master_permissions";

    protected $fillable = [
        'nama',
    ];

    public function roles()
    {
        return $this->belongsToMany(MasterRole::class, 'permission_role','id_permission', 'id_role');
    }
}
