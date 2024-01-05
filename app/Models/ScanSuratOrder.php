<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScanSuratOrder extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function mastersurat()
    {
        return $this->hasOne(MasterPreorder::class, 'nomor', 'nomor');
    }
}
