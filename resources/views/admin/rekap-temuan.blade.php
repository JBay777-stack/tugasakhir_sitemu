@extends('layouts.app')

@section('is_admin', true)
@section('title', 'Rekapan Barang Temuan')
@section('page_title', 'Rekapan Barang Temuan')

@section('content')
<div class="space-y-6">

    <form method="GET" class="bg-white p-6 rounded-3xl border shadow-sm">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="text-xs font-bold text-slate-600 mb-1 block">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai"
                       value="{{ request('tanggal_mulai') }}"
                       class="w-full border border-slate-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all">
            </div>

            <div>
                <label class="text-xs font-bold text-slate-600 mb-1 block">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai"
                       value="{{ request('tanggal_selesai') }}"
                       class="w-full border border-slate-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all">
            </div>

            <div class="flex items-end">
                <button class="w-full px-4 py-2.5 bg-emerald-600 text-white rounded-xl font-bold hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-200">
                    <i data-lucide="filter" class="w-4 h-4 inline-block mr-1"></i> Filter Data
                </button>
            </div>
        </div>
    </form>

    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-slate-50 text-slate-700 font-bold border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4">Detail Barang</th>
                        <th class="px-6 py-4">Identitas Penemu</th>
                        <th class="px-6 py-4">Waktu</th>
                        <th class="px-6 py-4">Status Laporan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($items as $item)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        {{-- Kolom 1: Detail Barang --}}
                        <td class="px-6 py-4 align-top max-w-xs">
                            <div class="font-bold text-slate-800 mb-1">{{ Str::limit($item->deskripsi, 50) }}</div>
                            <div class="flex items-center gap-1.5 text-xs text-slate-500">
                                <i data-lucide="map-pin" class="w-3 h-3 text-emerald-500"></i>
                                {{ $item->lokasi }}
                            </div>
                        </td>

                        {{-- Kolom 2: Identitas Penemu (Update Status Pelapor) --}}
                        <td class="px-6 py-4 align-top">
                            <div class="font-bold text-slate-800">{{ $item->nama_pelapor }}</div>

                            <div class="flex flex-wrap gap-2 mt-1.5">
                                {{-- Badge Status Pelapor --}}
                                <span class="px-2 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wider {{ $item->status_pelapor === 'Guru' ? 'bg-indigo-50 text-indigo-600 border border-indigo-100' : 'bg-orange-50 text-orange-600 border border-orange-100' }}">
                                    {{ $item->status_pelapor }}
                                </span>

                                {{-- Detail Siswa (Jika ada) --}}
                                @if($item->status_pelapor === 'Siswa')
                                    <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-slate-100 text-slate-600 border border-slate-200">
                                        {{ $item->kelas }} - {{ $item->jurusan }}
                                    </span>
                                @endif
                            </div>
                            <div class="text-xs text-slate-400 mt-1">{{ $item->kontak }}</div>
                        </td>

                        {{-- Kolom 3: Waktu (Ditemukan vs Lapor) --}}
                        <td class="px-6 py-4 align-top space-y-1">
                            <div class="flex items-center gap-2">
                                <span class="text-[10px] font-bold text-slate-400 w-14">Ditemukan:</span>
                                <span class="text-slate-700 font-medium">
                                    {{ $item->tanggal_penemuan ? \Carbon\Carbon::parse($item->tanggal_penemuan)->format('d M Y') : '-' }}
                                </span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-[10px] font-bold text-slate-400 w-14">Dilapor:</span>
                                <span class="text-slate-700 font-medium">
                                    {{ $item->created_at->format('d M Y') }}
                                </span>
                            </div>
                        </td>

                        {{-- Kolom 4: Status Laporan --}}
                        <td class="px-6 py-4 align-top">
                            @php
                                $statusClass = match($item->status) {
                                    'selesai' => 'bg-slate-100 text-slate-600 border-slate-200',
                                    'terverifikasi' => 'bg-emerald-50 text-emerald-600 border-emerald-200',
                                    default => 'bg-amber-50 text-amber-600 border-amber-200'
                                };
                            @endphp
                            <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $statusClass }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center text-slate-400">
                                <i data-lucide="clipboard-x" class="w-12 h-12 mb-3 text-slate-300"></i>
                                <p class="font-medium">Tidak ada data rekapitulasi.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
