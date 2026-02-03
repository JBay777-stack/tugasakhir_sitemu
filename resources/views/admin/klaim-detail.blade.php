@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-bold text-slate-800">Verifikasi Perbandingan Klaim</h2>
        <a href="{{ route('admin.klaim.index') }}" class="text-sm font-bold text-indigo-600">← Kembali ke Daftar</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-white p-6 rounded-3xl border-2 border-amber-100 shadow-sm">
            <h3 class="text-amber-600 font-bold mb-4 flex items-center gap-2">👤 Bukti Pengklaim</h3>
            <img src="{{ asset('storage/'.$claim->foto_bukti) }}" class="w-full h-64 object-cover rounded-2xl mb-4 border shadow-inner">
            <div class="space-y-3">
                <div class="p-3 bg-slate-50 rounded-xl">
                    <label class="text-[10px] uppercase font-bold text-slate-400">Nama Pengklaim</label>
                    <p class="text-slate-800 font-bold">{{ $claim->nama_pengklaim }}</p>
                </div>
                <div class="p-3 bg-slate-50 rounded-xl">
                    <label class="text-[10px] uppercase font-bold text-slate-400">Kontak</label>
                    <p class="text-slate-800 font-bold">{{ $claim->kontak }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl border-2 border-indigo-100 shadow-sm">
            <h3 class="text-indigo-600 font-bold mb-4 flex items-center gap-2">📦 Data Barang di Sistem</h3>
            <img src="{{ asset('storage/'.$item->foto) }}" class="w-full h-64 object-cover rounded-2xl mb-4 border shadow-inner">
            <div class="space-y-3">
                <div class="p-3 bg-slate-50 rounded-xl">
                    <label class="text-[10px] uppercase font-bold text-slate-400">Barang / Pelapor</label>
                    <p class="text-slate-800 font-bold">{{ $item->nama_barang ?? $item->nama_pelapor }}</p>
                </div>
                <div class="p-3 bg-slate-50 rounded-xl">
                    <label class="text-[10px] uppercase font-bold text-slate-400">Deskripsi Barang</label>
                    <p class="text-slate-600 text-sm italic">"{{ $item->deskripsi }}"</p>
                </div>
            </div>
        </div>
    </div>

    @if($claim->status === 'pending')
    <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-xl flex flex-col md:flex-row items-center justify-between gap-4">
        <p class="text-slate-600 font-medium italic">Silahkan teliti bukti foto dan deskripsi di atas sebelum mengambil keputusan.</p>
        <div class="flex gap-4">
            <form method="POST" action="/admin/klaim/{{ $claim->id }}/terima">
                @csrf
                <button class="px-8 py-3 bg-emerald-500 text-white rounded-2xl font-bold hover:bg-emerald-600 transition shadow-lg shadow-emerald-100">
                    Sesuai, Terima Klaim
                </button>
            </form>
            <form method="POST" action="/admin/klaim/{{ $claim->id }}/tolak">
                @csrf
                <button class="px-8 py-3 bg-red-500 text-white rounded-2xl font-bold hover:bg-red-600 transition shadow-lg shadow-red-100">
                    Tidak Sesuai, Tolak
                </button>
            </form>
        </div>
    </div>
    @endif
</div>
@endsection
