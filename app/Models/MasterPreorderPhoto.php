<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPreorderPhoto extends Model
{
    use HasFactory;

    protected $table = "master_preorder_photos";
    public $timestamps = false;
    
    protected $fillable = [
        'id_master_preorder',
        'url'
    ];

    public function master_preorder()
    {
        return $this->belongsTo(MasterPreorder::class, 'id_master_preorder', 'id');
    }
}
