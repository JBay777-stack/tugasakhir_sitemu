@extends('layouts.app')

@section('is_admin', true)
@section('title', 'Laporan Barang Temuan - Admin SiTemu')
@section('page_title', 'Laporan Temuan')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 animate-slide-up">
        <div>
            <h3 class="text-xl font-bold text-slate-800">Manajemen Barang Temuan</h3>
            <p class="text-slate-500 text-sm mt-1">
                Kelola laporan barang yang ditemukan oleh masyarakat agar segera bertemu pemiliknya.
            </p>
        </div>

        <div class="flex items-center gap-2">
            <div class="flex items-center gap-2 bg-white px-4 py-2 rounded-xl border border-slate-200 text-sm font-medium text-slate-600 shadow-sm">
                <i data-lucide="check-circle" class="w-4 h-4 text-emerald-500"></i>
                Total {{ $items->count() }} Laporan
            </div>

            <a href="{{ route('admin.rekap.temuan') }}"
               class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 text-white text-sm font-bold rounded-xl hover:bg-emerald-700 transition shadow-sm">
               <i data-lucide="file-text" class="w-4 h-4"></i>
               Rekapan
            </a>

        </div>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden animate-slide-up" style="animation-delay: 0.1s">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b">
                            Deskripsi & Lokasi
                        </th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b">
                            Pelapor
                        </th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b">
                            Kontak
                        </th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b text-center">
                            Foto Bukti
                        </th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b">
                            Status
                        </th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b text-center">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse ($items as $item)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex flex-col max-w-xs">
                                <span class="font-bold text-slate-700 truncate italic">
                                    "{{ $item->deskripsi }}"
                                </span>
                                <span class="text-xs text-slate-500 flex items-center gap-1 mt-1">
                                    <i data-lucide="map-pin" class="w-3 h-3 text-emerald-500"></i>
                                    {{ $item->lokasi }}
                                </span>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <span class="text-sm font-semibold text-slate-600 uppercase">
                                {{ $item->nama_pelapor }}
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            <span class="text-sm text-slate-600 flex items-center gap-1.5">
                                <i data-lucide="phone-call" class="w-3.5 h-3.5 text-slate-400"></i>
                                {{ $item->kontak }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-center">
                            <div class="inline-block w-16 h-12 overflow-hidden rounded-xl border border-slate-200 bg-slate-100">
                                <img src="{{ asset('storage/' . $item->foto) }}"
                                     class="w-full h-full object-cover"
                                     alt="Foto Temuan">
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            @if($item->status === 'menunggu' || $item->status === 'pending')
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-[10px] font-bold bg-amber-50 text-amber-600 border border-amber-100">
                                    Menunggu
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-600 border border-emerald-100">
                                    Terverifikasi
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-center">
                            @if ($item->status === 'menunggu' || $item->status === 'pending')
                                <form method="POST" action="{{ route('admin.laporan-temuan.verifikasi', $item->id) }}">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 text-white text-xs font-bold rounded-xl hover:bg-emerald-700 transition">
                                        Verifikasi
                                    </button>
                                </form>
                            @else
                                <span class="text-slate-400 text-[10px] font-bold uppercase">
                                    Selesai
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-20 text-center text-slate-400">
                            Belum ada laporan barang ditemukan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
