<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scann extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    public function masteroperator()
    {
        return $this->hasOne(MasterOperator::class, 'kode', 'kode');
    }
}
