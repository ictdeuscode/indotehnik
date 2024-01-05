<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterQR extends Model
{
    use HasFactory;
    static $Power;
    public function masteroperator()
    {
        return $this->hasOne(MasterOperator::class, 'nama', 'kode');
    }
}
