<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LostItem extends Model
{
    use HasFactory;

    protected $fillable = [
    'nama_pelapor', 'status_pelapor', 'kelas', 'jurusan', // Tambahan
    'kontak', 'nama_barang', 'deskripsi', 'tanggal_kehilangan', // Tambahan
    'foto', 'imbalan', 'status'
];
}
