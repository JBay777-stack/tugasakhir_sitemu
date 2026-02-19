<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoundItem extends Model
{
    protected $fillable = [
    'nama_pelapor', 'status_pelapor', 'kelas', 'jurusan', // Tambahan
    'kontak', 'lokasi', 'deskripsi', 'tanggal_penemuan', // Tambahan
    'foto', 'status'
];
}
