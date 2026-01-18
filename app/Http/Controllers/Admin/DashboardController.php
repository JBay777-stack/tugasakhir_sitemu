<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Claim;
use App\Models\LostItem;
use App\Models\FoundItem;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'lostCount' => LostItem::count(),
            'foundCount' => FoundItem::count(),
            'lostItems' => LostItem::latest()->get(),
            'foundItems' => FoundItem::latest()->get(),
        ]);
    }

    public function lost()
    {
        return view('admin.laporan-kehilangan', [
            'items' => LostItem::latest()->get()
        ]);
    }

    public function found()
    {
        return view('admin.laporan-temuan', [
            'items' => FoundItem::latest()->get()
        ]);
    }

    public function verifyLost($id)
    {
        $item = \App\Models\LostItem::findOrFail($id);
        $item->update(['status' => 'terverifikasi']);

        return redirect()->back()
            ->with('success', 'Laporan kehilangan berhasil diverifikasi');
    }

    public function verifyFound($id)
    {
        $item = \App\Models\FoundItem::findOrFail($id);
        $item->update(['status' => 'terverifikasi']);

        return redirect()->back()
            ->with('success', 'Laporan temuan berhasil diverifikasi');
    }

    public function klaim()
    {
        return view('admin.klaim', [
            'claims' => Claim::latest()->get()
        ]);
    }

    public function terimaKlaim($id)
    {
        $claim = Claim::findOrFail($id);

        if ($claim->item_type === 'lost') {
            LostItem::where('id', $claim->item_id)->update(['status' => 'selesai']);
        } else {
            FoundItem::where('id', $claim->item_id)->update(['status' => 'selesai']);
        }

        $claim->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'Klaim diterima, barang diselesaikan');
    }

    public function tolakKlaim($id)
    {
        Claim::where('id', $id)
            ->update(['status' => 'rejected']);

        return redirect()->back()
            ->with('success', 'Klaim ditolak');
    }

    public function exportKlaimPdf($id)
    {
        $claim = Claim::findOrFail($id);

        $item = $claim->item_type === 'lost'
            ? LostItem::find($claim->item_id)
            : FoundItem::find($claim->item_id);

        $pdf = Pdf::loadView('admin.klaim.surat-pernyataan', [
            'claim' => $claim,
            'item'  => $item
        ])->setPaper('A4', 'portrait');

        return $pdf->download('Surat-Pernyataan-Pengembalian-Barang.pdf');
    }
}
