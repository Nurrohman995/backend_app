<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_HistoryTransaksi extends Model
{
    use HasFactory;
    protected $table = 'history_transaksi';
    public $timestamps = false;
}
