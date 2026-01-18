<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoundItem extends Model
{
    protected $fillable = [
        'nama_pelapor',
        'kontak',
        'lokasi',
        'deskripsi',
        'foto',
        'status'
    ];
}
