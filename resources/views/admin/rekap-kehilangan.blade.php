@extends('layouts.app')

@section('is_admin', true)
@section('title', 'Rekapan Barang Hilang')
@section('page_title', 'Rekapan Barang Hilang')

@section('content')
<div class="space-y-6">

    {{-- FORM FILTER TANGGAL --}}
    <form method="GET"
          action="{{ route('admin.rekap.kehilangan') }}"
          class="bg-white p-6 rounded-3xl border shadow-sm">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="text-xs font-bold text-slate-600">
                    Tanggal Mulai
                </label>
                <input type="date"
                       name="tanggal"
                       value="{{ request('tanggal') }}"
                       class="w-full border rounded-xl px-4 py-2 text-sm">
            </div>

            <div>
                <label class="text-xs font-bold text-slate-600">
                    Tanggal Sampai
                </label>
                <input type="date"
                       name="tanggal_sampai"
                       value="{{ request('tanggal_sampai') }}"
                       class="w-full border rounded-xl px-4 py-2 text-sm">
            </div>

            <div class="flex items-end">
                <button
                    class="w-full px-6 py-2 bg-brand-600 text-white rounded-xl font-bold text-sm">
                    Tampilkan
                </button>
            </div>
        </div>

        <p class="mt-3 text-xs text-slate-400">
            • Isi <b>1 tanggal</b> untuk melihat laporan di tanggal tersebut
            • Isi <b>2 tanggal</b> untuk melihat laporan dalam rentang tanggal
        </p>
    </form>

    {{-- TABLE --}}
    <div class="bg-white rounded-3xl border shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-4 text-left font-bold text-slate-500">
                        Nama Barang
                    </th>
                    <th class="px-6 py-4 text-left font-bold text-slate-500">
                        Pelapor
                    </th>
                    <th class="px-6 py-4 text-left font-bold text-slate-500">
                        Tanggal Lapor
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse($items as $item)
                <tr>
                    <td class="px-6 py-4 font-semibold text-slate-700">
                        {{ $item->nama_barang }}
                    </td>
                    <td class="px-6 py-4 text-slate-600">
                        {{ $item->nama_pelapor }}
                    </td>
                    <td class="px-6 py-4 text-slate-500">
                        {{ $item->created_at->format('d M Y') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3"
                        class="px-6 py-14 text-center text-slate-400">
                        Tidak ada data laporan kehilangan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
