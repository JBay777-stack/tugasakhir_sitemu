<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    protected $fillable = [
    'item_type', 'item_id',
    'nama_pengklaim', 'status_pengklaim', 'kelas', 'jurusan', // Tambahan
    'kontak', 'status', 'foto_bukti'
];
}
