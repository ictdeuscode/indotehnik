<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryGudang extends Model
{
    use HasFactory;
    protected $fillable = ['nomor_preorder', 'tgl_masuk', 'tgl_selesai', 'keterangan'];
}
