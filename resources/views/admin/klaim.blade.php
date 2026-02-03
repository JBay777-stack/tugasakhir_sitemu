@extends('layouts.app')

@section('is_admin', true)
@section('title', 'Data Klaim Barang - SiTemu')
@section('page_title', 'Manajemen Klaim')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 animate-slide-up">
        <div>
            <h3 class="text-xl font-bold text-slate-800">Daftar Pengajuan Klaim</h3>
            <p class="text-slate-500 text-sm mt-1">Verifikasi bukti kepemilikan dan dokumentasi pengembalian barang.</p>
        </div>
        <div class="flex items-center gap-2 bg-white px-4 py-2 rounded-xl border border-slate-200 text-sm font-medium text-slate-600 shadow-sm">
            <i data-lucide="info" class="w-4 h-4 text-indigo-500"></i>
            Total {{ $claims->count() }} Klaim
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden animate-slide-up">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50">
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase">Pengklaim</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase">Barang</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase text-center">Perbandingan</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase">Status</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase text-center">Aksi Cepat</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                @forelse ($claims as $claim)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4">
                            <div class="font-semibold text-slate-700">{{ $claim->nama_pengklaim }}</div>
                            <div class="text-xs text-slate-500 mb-2">{{ $claim->kontak }}</div>

                            @php
                                $wa = preg_replace('/[^0-9]/', '', $claim->kontak);
                                if (str_starts_with($wa, '0')) { $wa = '62' . substr($wa, 1); }
                            @endphp

                            <a href="https://wa.me/{{ $wa }}?text=Halo%20{{ urlencode($claim->nama_pengklaim) }},%20kami%20admin%20SiTemu%20ingin%20konfirmasi%20klaim%20barang."
                               target="_blank" class="inline-flex items-center gap-1 px-2 py-1 rounded-lg bg-emerald-100 text-emerald-700 hover:bg-emerald-600 hover:text-white text-[11px] font-bold transition">
                                WhatsApp
                            </a>
                        </td>

                        <td class="px-6 py-4">
                            <div class="text-xs font-bold text-indigo-600 uppercase">{{ $claim->item_type }}</div>
                            <div class="text-xs text-slate-400">ID: #{{ $claim->item_id }}</div>
                        </td>

                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('admin.klaim.detail', $claim->id) }}" class="inline-flex items-center gap-2 px-3 py-1.5 bg-slate-100 text-slate-700 rounded-xl hover:bg-indigo-600 hover:text-white transition text-xs font-bold">
                                🔍 Cek Detail
                            </a>
                        </td>

                        <td class="px-6 py-4">
                            @if($claim->status === 'pending')
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700">Pending</span>
                            @elseif($claim->status === 'approved' || $claim->status === 'terima')
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">Disetujui</span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700">Ditolak</span>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-center">
                            @if($claim->status === 'pending')
                                <div class="flex justify-center gap-2">
                                    <form method="POST" action="/admin/klaim/{{ $claim->id }}/terima">
                                        @csrf
                                        <button class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-600 hover:bg-emerald-600 hover:text-white transition">✔</button>
                                    </form>
                                    <form method="POST" action="/admin/klaim/{{ $claim->id }}/tolak">
                                        @csrf
                                        <button class="w-9 h-9 rounded-xl bg-red-100 text-red-600 hover:bg-red-600 hover:text-white transition">✖</button>
                                    </form>
                                </div>
                            @else
                                <a href="{{ route('admin.klaim.export-pdf', $claim->id) }}" target="_blank" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-indigo-100 text-indigo-700 hover:bg-indigo-600 hover:text-white text-xs font-bold transition">
                                    📄 Export PDF
                                </a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="py-20 text-center text-slate-400">Tidak ada pengajuan klaim.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@if(session('success'))
<script>
    Swal.fire({ icon: 'success', title: 'Berhasil', text: @json(session('success')), timer: 2000, showConfirmButton: false });
</script>
@endif
@endpush
