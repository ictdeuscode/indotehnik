<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryRejectCustomer extends Model
{
    use HasFactory;

    protected $table = "history_reject_customers";

    protected $fillable = [
        'id_surat',
        'keterangan_reject',
    ];

    public function preorder()
    {
        return $this->belongsTo(MasterPreorder::class, 'id_surat', 'id');
    }
}
