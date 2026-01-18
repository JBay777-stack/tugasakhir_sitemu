<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LostItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pelapor',
        'kontak',
        'nama_barang',
        'deskripsi',
        'foto',
        'imbalan',
        'status'
    ];
}
