<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_Barang extends Model
{
    use HasFactory;
    protected $table = 'barang';
    public $timestamps = false;
}
