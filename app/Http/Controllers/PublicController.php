<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LostItem;
use App\Models\FoundItem;
use App\Models\Claim;

class PublicController extends Controller
{
    public function storeLost(Request $request)
    {
        $data = $request->validate([
            'nama_pelapor' => 'required',
            'kontak' => 'required',
            'nama_barang' => 'required',
            'deskripsi' => 'required',
            'foto' => 'nullable|image',
            'imbalan' => 'nullable'
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')
                ->store('lost_items', 'public');
        }

        $data['status'] = 'menunggu';

        LostItem::create($data);

        return redirect()->back()
            ->with('success', 'Laporan kehilangan berhasil dikirim');
    }

    public function storeFound(Request $request)
    {
        $data = $request->validate([
            'nama_pelapor' => 'required',
            'kontak' => 'required',
            'lokasi' => 'required',
            'deskripsi' => 'required',
            'foto' => 'nullable|image'
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')
                ->store('found_items', 'public');
        }

        $data['status'] = 'menunggu';

        FoundItem::create($data);

        return redirect()->back()
            ->with('success', 'Laporan temuan berhasil dikirim');
    }

    public function daftarBarang()
    {
        return view('public.daftar-barang', [
            'lostItems' => \App\Models\LostItem::whereIn('status', ['terverifikasi', 'selesai'])->latest()->get(),
            'foundItems' => \App\Models\FoundItem::whereIn('status', ['terverifikasi', 'selesai'])->latest()->get(),
        ]);
    }

    public function showClaimForm($type, $id)
    {
        return view('public.klaim', [
            'itemType' => $type,
            'itemId' => $id
        ]);
    }

    public function storeClaim(Request $request)
    {
        $data = $request->validate([
            'item_type' => 'required',
            'item_id' => 'required',
            'nama_pengklaim' => 'required',
            'kontak' => 'required',
            'foto_bukti' => 'required|image'
        ]);

        $data['foto_bukti'] = $request->file('foto_bukti')
            ->store('klaim', 'public');

        Claim::create($data);

        return redirect('/daftar-barang')
            ->with('success', 'Pengajuan berhasil dikirim');
    }
}
