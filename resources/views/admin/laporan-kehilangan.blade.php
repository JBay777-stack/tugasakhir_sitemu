@extends('layouts.app')

@section('is_admin', true)
@section('title', 'Laporan Barang Hilang - Admin SiTemu')
@section('page_title', 'Laporan Kehilangan')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 animate-slide-up">
        <div>
            <h3 class="text-xl font-bold text-slate-800">Manajemen Barang Hilang</h3>
            <p class="text-slate-500 text-sm mt-1">
                Verifikasi laporan kehilangan dari pengguna sebelum dipublikasikan.
            </p>
        </div>

        <div class="flex items-center gap-2">
            <div class="flex items-center gap-2 bg-white px-4 py-2 rounded-xl border border-slate-200 text-sm font-medium text-slate-600 shadow-sm">
                <i data-lucide="list" class="w-4 h-4 text-orange-500"></i>
                Total {{ $items->count() }} Laporan
            </div>

            <a href="{{ route('admin.rekap.kehilangan') }}"
               class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 text-white text-sm font-bold rounded-xl hover:bg-emerald-700 transition shadow-sm">
                <i data-lucide="file-text" class="w-4 h-4"></i>
                Rekapan
            </a>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-4 text-xs">Barang & Pelapor</th>
                    <th class="px-6 py-4 text-xs">Kontak</th>
                    <th class="px-6 py-4 text-xs text-center">Foto</th>
                    <th class="px-6 py-4 text-xs">Status</th>
                    <th class="px-6 py-4 text-xs text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse ($items as $item)
                <tr>
                    <td class="px-6 py-4">
                        <div class="font-bold">{{ $item->nama_barang }}</div>
                        <div class="text-xs text-slate-400">{{ $item->nama_pelapor }}</div>
                    </td>

                    <td class="px-6 py-4">{{ $item->kontak }}</td>

                    <td class="px-6 py-4 text-center">
                        <img src="{{ asset('storage/' . $item->foto) }}"
                             class="w-16 h-12 object-cover rounded-xl mx-auto">
                    </td>

                    <td class="px-6 py-4">
                        {{ ucfirst($item->status) }}
                    </td>

                    <td class="px-6 py-4 text-center">
                        @if ($item->status === 'menunggu')
                        <form method="POST" action="/admin/laporan-kehilangan/{{ $item->id }}/verifikasi">
                            @csrf
                            <button class="px-4 py-2 bg-brand-600 text-white text-xs rounded-xl">
                                Verifikasi
                            </button>
                        </form>
                        @else
                        <span class="text-xs text-slate-400">Selesai</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-10 text-slate-400">
                        Belum ada laporan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
