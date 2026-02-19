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
            'nama_pelapor'   => 'required',
            'status_pelapor' => 'required',
            'kelas'          => 'nullable|required_if:status_pelapor,Siswa',
            'jurusan'        => 'nullable|required_if:status_pelapor,Siswa',
            'kontak'         => 'required',
            'nama_barang'    => 'required',
            'deskripsi'      => 'required',
            'tanggal_kehilangan' => 'required|date',
            'foto'           => 'nullable|image',
            'imbalan'        => 'nullable'
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('lost_items', 'public');
        }

        $data['status'] = 'menunggu';

        LostItem::create($data);

        return redirect()->back()->with('success', 'Laporan kehilangan berhasil dikirim');
    }

    public function storeFound(Request $request)
    {
        $data = $request->validate([
            'nama_pelapor'   => 'required',
            'status_pelapor' => 'required', 
            'kelas'          => 'nullable|required_if:status_pelapor,Siswa',
            'jurusan'        => 'nullable|required_if:status_pelapor,Siswa',
            'kontak'         => 'required',
            'lokasi'         => 'required',
            'deskripsi'      => 'required',
            'tanggal_penemuan' => 'required|date',
            'foto'           => 'nullable|image'
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('found_items', 'public');
        }

        $data['status'] = 'menunggu';

        FoundItem::create($data);

        return redirect()->back()->with('success', 'Laporan temuan berhasil dikirim');
    }


    public function daftarLost()
    {
        return view('public.barang-hilang', [
            'lostItems' => \App\Models\LostItem::where('status', 'terverifikasi')
                ->where('created_at', '>=', now()->subMonths(2))
                ->latest()
                ->get(),
        ]);
    }


    public function daftarFound()
    {
        return view('public.barang-temuan', [
            'foundItems' => \App\Models\FoundItem::where('status', 'terverifikasi')
                ->where('created_at', '>=', now()->subMonths(2))
                ->latest()
                ->get(),
        ]);
    }

    public function daftarSelesai()
    {
        return view('public.barang-selesai', [
            'lostItems'  => \App\Models\LostItem::where('status', 'selesai')->latest()->get(),
            'foundItems' => \App\Models\FoundItem::where('status', 'selesai')->latest()->get(),
        ]);
    }

    public function showClaimForm($type, $id)
    {
        return view('public.klaim', [
            'itemType' => $type,
            'itemId'   => $id
        ]);
    }

    public function storeClaim(Request $request)
    {
        $data = $request->validate([
            'item_type'      => 'required',
            'item_id'        => 'required',
            'nama_pengklaim' => 'required',
            'status_pengklaim' => 'required',
            'kelas'          => 'nullable|required_if:status_pengklaim,Siswa',
            'jurusan'        => 'nullable|required_if:status_pengklaim,Siswa',
            'kontak'         => 'required',
            'foto_bukti'     => 'required|image'
        ]);

        $data['foto_bukti'] = $request->file('foto_bukti')->store('klaim', 'public');
        $data['status'] = 'pending';

        Claim::create($data);

        $redirectPath = $request->item_type === 'lost' ? '/barang-hilang' : '/barang-temuan';

        return redirect($redirectPath)->with('success', 'Pengajuan berhasil dikirim');
    }
}
