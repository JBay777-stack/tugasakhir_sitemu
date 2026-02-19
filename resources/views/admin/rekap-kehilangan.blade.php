@extends('layouts.app')

@section('is_admin', true)
@section('title', 'Rekapan Barang Hilang')
@section('page_title', 'Rekapan Barang Hilang')

@section('content')
<div class="space-y-6">

    {{-- FORM FILTER TANGGAL --}}
    <form method="GET" action="{{ route('admin.rekap.kehilangan') }}" class="bg-white p-6 rounded-3xl border shadow-sm">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="text-xs font-bold text-slate-600 mb-1 block">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai"
                       value="{{ request('tanggal_mulai') }}"
                       class="w-full border border-slate-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all">
            </div>

            <div>
                <label class="text-xs font-bold text-slate-600 mb-1 block">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai"
                       value="{{ request('tanggal_selesai') }}"
                       class="w-full border border-slate-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all">
            </div>

            <div class="flex items-end">
                <button class="w-full px-4 py-2.5 bg-orange-600 text-white rounded-xl font-bold hover:bg-orange-700 transition-all shadow-lg shadow-orange-200">
                    <i data-lucide="filter" class="w-4 h-4 inline-block mr-1"></i> Filter Data
                </button>
            </div>
        </div>
        <p class="mt-3 text-[11px] text-slate-400">
            • Isi <b>1 tanggal</b> untuk melihat laporan di tanggal tersebut. <br>
            • Isi <b>2 tanggal</b> untuk melihat laporan dalam rentang tanggal.
        </p>
    </form>

    {{-- TABLE --}}
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-slate-50 text-slate-700 font-bold border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4">Detail Barang</th>
                        <th class="px-6 py-4">Identitas Pelapor</th>
                        <th class="px-6 py-4">Waktu Kejadian</th>
                        <th class="px-6 py-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($items as $item)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        {{-- Kolom 1: Detail Barang --}}
                        <td class="px-6 py-4 align-top">
                            <div class="font-bold text-slate-800 text-base">{{ $item->nama_barang }}</div>
                            @if($item->imbalan)
                                <div class="mt-1 inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-green-50 text-green-700 border border-green-200">
                                    Imbalan: Rp {{ number_format((float)$item->imbalan, 0, ',', '.') }}
                                </div>
                            @else
                                <span class="text-xs text-slate-400 italic mt-1 block">Tidak ada imbalan</span>
                            @endif
                        </td>

                        {{-- Kolom 2: Identitas Pelapor (Update Status) --}}
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
                            <div class="text-xs text-slate-400 mt-1 flex items-center gap-1">
                                <i data-lucide="phone" class="w-3 h-3"></i> {{ $item->kontak }}
                            </div>
                        </td>

                        {{-- Kolom 3: Waktu --}}
                        <td class="px-6 py-4 align-top space-y-1">
                            <div class="flex items-center gap-2">
                                <span class="text-[10px] font-bold text-slate-400 w-16">Hilang:</span>
                                <span class="text-slate-700 font-medium">
                                    {{ $item->tanggal_kehilangan ? \Carbon\Carbon::parse($item->tanggal_kehilangan)->format('d M Y') : '-' }}
                                </span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-[10px] font-bold text-slate-400 w-16">Lapor:</span>
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
                                    'terverifikasi' => 'bg-orange-50 text-orange-600 border-orange-200',
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
                        <td colspan="4" class="px-6 py-14 text-center">
                            <div class="flex flex-col items-center justify-center text-slate-400">
                                <i data-lucide="search-x" class="w-12 h-12 mb-3 text-slate-300"></i>
                                <p class="font-medium">Tidak ada data laporan kehilangan.</p>
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
