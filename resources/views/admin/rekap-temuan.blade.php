@extends('layouts.app')

@section('is_admin', true)
@section('title', 'Rekapan Barang Temuan')
@section('page_title', 'Rekapan Barang Temuan')

@section('content')
<div class="space-y-6">

    <form method="GET" class="bg-white p-6 rounded-3xl border shadow-sm">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="text-xs font-bold">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai"
                       value="{{ request('tanggal_mulai') }}"
                       class="w-full border rounded-xl px-3 py-2 text-sm">
            </div>

            <div>
                <label class="text-xs font-bold">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai"
                       value="{{ request('tanggal_selesai') }}"
                       class="w-full border rounded-xl px-3 py-2 text-sm">
            </div>

            <div class="flex items-end">
                <button class="w-full px-4 py-2 bg-emerald-600 text-white rounded-xl font-bold">
                    Tampilkan
                </button>
            </div>
        </div>
    </form>

    <div class="bg-white rounded-3xl border shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-3">Deskripsi</th>
                    <th class="px-6 py-3">Pelapor</th>
                    <th class="px-6 py-3">Tanggal</th>
                    <th class="px-6 py-3">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($items as $item)
                <tr>
                    <td class="px-6 py-3 italic">"{{ $item->deskripsi }}"</td>
                    <td class="px-6 py-3">{{ $item->nama_pelapor }}</td>
                    <td class="px-6 py-3 text-slate-500">
                        {{ $item->created_at->format('d M Y') }}
                    </td>
                    <td class="px-6 py-3">{{ ucfirst($item->status) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-10 text-center text-slate-400">
                        Tidak ada data
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
