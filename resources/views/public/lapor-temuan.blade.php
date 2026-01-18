@extends('layouts.app')

@section('title', 'Lapor Barang Ditemukan - SiTemu')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-12">
    <div class="text-center mb-10 animate-in fade-in slide-in-from-top-4 duration-700">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-emerald-50 rounded-2xl text-emerald-600 mb-4 shadow-sm border border-emerald-100">
            <i data-lucide="check-circle" class="w-8 h-8"></i>
        </div>
        <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Lapor Barang Ditemukan</h2>
        <p class="text-slate-500 mt-2">Terima kasih telah menjadi orang jujur! Detail Anda sangat membantu pemilik barang.</p>
    </div>

    <div class="bg-white rounded-[32px] shadow-xl shadow-slate-200/60 border border-slate-100 overflow-hidden animate-in fade-in slide-in-from-bottom-6 duration-700 delay-150">
        <form method="POST" action="/lapor-temuan" enctype="multipart/form-data" class="p-8 md:p-10 space-y-8">
            @csrf

            <div class="space-y-5">
                <div class="flex items-center gap-2 pb-2 border-b border-slate-100">
                    <i data-lucide="user-check" class="w-5 h-5 text-emerald-500"></i>
                    <h3 class="font-bold text-slate-800">Identitas Penemu</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-slate-700 ml-1">Nama Penemu</label>
                        <input type="text" name="nama_pelapor" required
                            class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all placeholder:text-slate-400"
                            placeholder="Nama lengkap Anda">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-slate-700 ml-1">WhatsApp / Kontak</label>
                        <input type="text" name="kontak" required
                            class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all placeholder:text-slate-400"
                            placeholder="Contoh: 0812xxxx">
                    </div>
                </div>
            </div>

            <div class="space-y-5 pt-4">
                <div class="flex items-center gap-2 pb-2 border-b border-slate-100">
                    <i data-lucide="map-pin" class="w-5 h-5 text-emerald-500"></i>
                    <h3 class="font-bold text-slate-800">Detail Temuan</h3>
                </div>

                <div class="space-y-5">
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-slate-700 ml-1">Lokasi Penemuan</label>
                        <input type="text" name="lokasi" required
                            class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all placeholder:text-slate-400"
                            placeholder="Misal: Kantin, Lapangan Basket, dsb.">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-slate-700 ml-1">Deskripsi Barang</label>
                        <textarea name="deskripsi" rows="3" required
                            class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all placeholder:text-slate-400"
                            placeholder="Sebutkan ciri-ciri barang (Warna, Merk, Kondisi)..."></textarea>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-slate-700 ml-1">Foto Bukti Barang</label>
                        <label class="flex items-center justify-between w-full px-4 py-3.5 bg-white border border-slate-200 rounded-2xl cursor-pointer hover:bg-slate-50 transition-all group">
                            <span id="file-name" class="text-sm text-slate-400 truncate tracking-tight">Unggah foto barang temuan...</span>
                            <div class="px-3 py-1 bg-emerald-100 text-emerald-600 rounded-lg text-[10px] font-bold uppercase tracking-wider group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                                Pilih File
                            </div>
                            <input type="file" name="foto" class="hidden" required onchange="updateFileName(this)">
                        </label>
                    </div>
                </div>
            </div>

            <div class="pt-6 text-center">
                <button type="submit"
                    class="w-full bg-emerald-600 text-white py-4 rounded-2xl font-bold text-sm hover:bg-emerald-700 hover:-translate-y-1 active:translate-y-0 transition-all shadow-xl shadow-emerald-100 flex items-center justify-center gap-2 group">
                    <i data-lucide="send" class="w-5 h-5 transition-transform group-hover:translate-x-1 group-hover:-translate-y-1"></i>
                    Kirim Laporan Temuan
                </button>
                <div class="mt-4 flex items-center justify-center gap-2 text-amber-600 animate-pulse">
                    <i data-lucide="info" class="w-4 h-4"></i>
                    <p class="text-[11px] font-bold uppercase tracking-tighter">Mohon serahkan barang ke Ruang BK segera</p>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function updateFileName(input) {
        const label = document.getElementById('file-name');
        if (input.files && input.files.length > 0) {
            label.textContent = input.files[0].name;
            label.classList.remove('text-slate-400');
            label.classList.add('text-slate-700', 'font-medium');
        }
    }

    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
</script>

@if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Laporan Berhasil!',
            text: 'Terima kasih orang baik! Segera bawa barang tersebut ke Ruang BK ya.',
            confirmButtonColor: '#10b981',
            confirmButtonText: 'Siap, Segera!',
            customClass: {
                popup: 'rounded-[32px]',
                confirmButton: 'rounded-xl px-8 py-3 font-bold'
            }
        });
    });
</script>
@endif
@endsection
