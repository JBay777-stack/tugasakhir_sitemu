@extends('layouts.app')

@section('is_admin', true)
@section('title', 'Laporan Barang Temuan - Admin SiTemu')
@section('page_title', 'Laporan Temuan')

@section('content')
<div class="space-y-6">
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

            <button onclick="openRekapModal()"
                class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 text-white text-sm font-bold rounded-xl hover:bg-emerald-700 transition shadow-sm">
                <i data-lucide="file-text" class="w-4 h-4"></i>
                Rekapan
            </button>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden animate-slide-up" style="animation-delay: 0.1s">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b border-slate-100">
                            Deskripsi & Lokasi
                        </th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b border-slate-100">
                            Pelapor
                        </th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b border-slate-100">
                            Kontak
                        </th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b border-slate-100 text-center">
                            Foto Bukti
                        </th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b border-slate-100">
                            Status
                        </th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b border-slate-100 text-center">
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
                            <span class="text-sm font-semibold text-slate-600 uppercase tracking-tight">
                                {{ $item->nama_pelapor }}
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            <span class="text-sm text-slate-600 flex items-center gap-1.5 font-medium">
                                <i data-lucide="phone-call" class="w-3.5 h-3.5 text-slate-400"></i>
                                {{ $item->kontak }}
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex justify-center">
                                <div class="relative w-16 h-12 overflow-hidden rounded-xl border border-slate-200 shadow-sm bg-slate-100">
                                    <img src="{{ asset('storage/' . $item->foto) }}"
                                         class="w-full h-full object-cover"
                                         alt="Foto Temuan">
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            @if($item->status === 'menunggu' || $item->status === 'pending')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold uppercase bg-amber-50 text-amber-600 border border-amber-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                    Menunggu
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold uppercase bg-emerald-50 text-emerald-600 border border-emerald-100">
                                    <i data-lucide="verified" class="w-3.5 h-3.5"></i>
                                    Terverifikasi
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-center">
                            @if ($item->status === 'menunggu' || $item->status === 'pending')
                                <form method="POST" action="/admin/laporan-temuan/{{ $item->id }}/verifikasi">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 text-white text-xs font-bold rounded-xl hover:bg-emerald-700 transition shadow-md">
                                        <i data-lucide="check-square" class="w-3.5 h-3.5"></i>
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

<div id="rekapModal" class="fixed inset-0 bg-black/40 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-3xl w-full max-w-xl p-6 animate-slide-up">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-slate-800">
                Rekapan Barang Temuan
            </h3>
            <button onclick="closeRekapModal()" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x"></i>
            </button>
        </div>

        <div class="grid grid-cols-3 gap-3 mb-4">
            <input type="number" id="filterTanggal" placeholder="Tanggal" class="border rounded-xl px-3 py-2 text-sm">
            <input type="number" id="filterBulan" placeholder="Bulan" class="border rounded-xl px-3 py-2 text-sm">
            <input type="number" id="filterTahun" placeholder="Tahun" class="border rounded-xl px-3 py-2 text-sm">
        </div>

        <div class="border rounded-xl max-h-72 overflow-y-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-4 py-2 text-left">Deskripsi</th>
                        <th class="px-4 py-2 text-left">Tanggal Lapor</th>
                    </tr>
                </thead>
                <tbody id="rekapBody">
                    @foreach($items as $item)
                    <tr data-date="{{ $item->created_at->format('d-m-Y') }}">
                        <td class="px-4 py-2 truncate italic">"{{ $item->deskripsi }}"</td>
                        <td class="px-4 py-2 text-slate-500">
                            {{ $item->created_at->format('d-m-Y') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4 text-right">
            <button onclick="closeRekapModal()"
                class="px-4 py-2 bg-slate-200 rounded-xl text-sm font-bold">
                Tutup
            </button>
        </div>
    </div>
</div>

@if (session('success'))
<script>
document.addEventListener('DOMContentLoaded', function() {
    const message = @json(session('success'));
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: message,
        confirmButtonColor: '#10b981',
        confirmButtonText: 'Mantap!',
        customClass: {
            popup: 'rounded-3xl',
            confirmButton: 'rounded-xl px-6'
        }
    });
});
</script>
@endif

<script>
function openRekapModal() {
    rekapModal.classList.remove('hidden')
    rekapModal.classList.add('flex')
}

function closeRekapModal() {
    rekapModal.classList.add('hidden')
    rekapModal.classList.remove('flex')
}

document.querySelectorAll('#filterTanggal, #filterBulan, #filterTahun')
.forEach(el => {
    el.addEventListener('input', () => {
        const t = filterTanggal.value
        const b = filterBulan.value
        const y = filterTahun.value

        document.querySelectorAll('#rekapBody tr').forEach(row => {
            const [dt, bl, th] = row.dataset.date.split('-')
            row.style.display =
                (!t || dt == t) &&
                (!b || bl == b) &&
                (!y || th == y)
                ? '' : 'none'
        })
    })
})
</script>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 2000
    })
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: '{{ session('error') }}',
        confirmButtonText: 'OK'
    })
</script>
@endif
