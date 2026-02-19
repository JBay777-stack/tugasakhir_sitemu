<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Claim;
use App\Models\LostItem;
use App\Models\FoundItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'lostCount'  => LostItem::count(),
            'foundCount' => FoundItem::count(),
            'lostItems'  => LostItem::latest()->get(),
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
        LostItem::findOrFail($id)->update(['status' => 'terverifikasi']);
        return back()->with('success', 'Laporan kehilangan diverifikasi');
    }

    public function verifyFound($id)
    {
        FoundItem::findOrFail($id)->update(['status' => 'terverifikasi']);
        return back()->with('success', 'Laporan temuan diverifikasi');
    }

    public function klaim()
    {
        return view('admin.klaim', [
            'claims' => Claim::latest()->get()
        ]);
    }

    public function detailKlaim($id)
    {
        $claim = Claim::findOrFail($id);
        $item  = $claim->item_type === 'lost'
            ? LostItem::find($claim->item_id)
            : FoundItem::find($claim->item_id);

        return view('admin.klaim-detail', compact('claim', 'item'));
    }

    public function terimaKlaim($id)
    {
        $claim = Claim::findOrFail($id);

        DB::transaction(function () use ($claim) {
            if ($claim->item_type === 'lost') {
                LostItem::where('id', $claim->item_id)->update(['status' => 'selesai']);
            } else {
                FoundItem::where('id', $claim->item_id)->update(['status' => 'selesai']);
            }
            $claim->update(['status' => 'approved']);
        });

        return redirect('/admin/klaim')->with('success', 'Klaim diterima dan status barang diperbarui');
    }

    public function tolakKlaim($id)
    {
        Claim::where('id', $id)->update(['status' => 'rejected']);
        return redirect('/admin/klaim')->with('success', 'Klaim ditolak');
    }

    public function exportKlaimPdf($id)
    {
        $claim = Claim::findOrFail($id);
        $item  = $claim->item_type === 'lost'
            ? LostItem::find($claim->item_id)
            : FoundItem::find($claim->item_id);

        $pdf = Pdf::loadView('admin.klaim.surat-pernyataan', compact('claim', 'item'));
        return $pdf->download('Surat-Pernyataan.pdf');
    }


    public function rekapKehilangan(Request $request)
    {
        $query = LostItem::query();
        if ($request->filled('tanggal_mulai') && !$request->filled('tanggal_selesai')) {
            $query->whereDate('created_at', $request->tanggal_mulai);
        }
        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $query->whereBetween('created_at', [
                Carbon::parse($request->tanggal_mulai)->startOfDay(),
                Carbon::parse($request->tanggal_selesai)->endOfDay(),
            ]);
        }
        return view('admin.rekap-kehilangan', ['items' => $query->latest()->get()]);
    }


    public function rekapTemuan(Request $request)
    {
        $query = FoundItem::query();
        if ($request->filled('tanggal_mulai') && !$request->filled('tanggal_selesai')) {
            $query->whereDate('created_at', $request->tanggal_mulai);
        }
        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $query->whereBetween('created_at', [
                Carbon::parse($request->tanggal_mulai)->startOfDay(),
                Carbon::parse($request->tanggal_selesai)->endOfDay(),
            ]);
        }
        return view('admin.rekap-temuan', ['items' => $query->latest()->get()]);
    }
}
