@extends('layouts.app')

@section('title', 'Ajukan Klaim Barang - SiTemu')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-12">
    <div class="text-center mb-10 animate-in fade-in slide-in-from-top-4 duration-700">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-brand-50 rounded-2xl text-brand-600 mb-4 shadow-sm border border-brand-100">
            <i data-lucide="shield-check" class="w-8 h-8"></i>
        </div>
        <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Verifikasi Kepemilikan</h2>
        <p class="text-slate-500 mt-2">Lengkapi formulir di bawah untuk memproses pengembalian barang.</p>
    </div>

    <div class="bg-white rounded-[32px] shadow-xl shadow-slate-200/60 border border-slate-100 overflow-hidden animate-in fade-in slide-in-from-bottom-6 duration-700 delay-150">
        <form method="POST" action="/klaim" enctype="multipart/form-data" class="p-8 md:p-10 space-y-6">
            @csrf

            <input type="hidden" name="item_type" value="{{ $itemType }}">
            <input type="hidden" name="item_id" value="{{ $itemId }}">

            <div class="space-y-2">
                <label class="block text-sm font-bold text-slate-700 ml-1">Nama Lengkap</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-brand-600 transition-colors">
                        <i data-lucide="user" class="w-5 h-5"></i>
                    </div>
                    <input type="text" name="nama_pengklaim" required
                        class="w-full pl-12 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:ring-4 focus:ring-brand-600/10 focus:border-brand-600 transition-all placeholder:text-slate-400"
                        placeholder="Masukkan nama Anda">
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-bold text-slate-700 ml-1">Nomor WhatsApp / Kontak</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-brand-600 transition-colors">
                        <i data-lucide="phone" class="w-5 h-5"></i>
                    </div>
                    <input type="text" name="kontak" required
                        class="w-full pl-12 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:ring-4 focus:ring-brand-600/10 focus:border-brand-600 transition-all placeholder:text-slate-400"
                        placeholder="Contoh: 08123456789">
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-bold text-slate-700 ml-1">Unggah Foto Bukti</label>
                <div class="relative group">
                    <label for="foto_bukti" class="flex flex-col items-center justify-center w-full h-44 border-2 border-dashed border-slate-200 rounded-3xl cursor-pointer bg-slate-50 hover:bg-slate-100 hover:border-brand-300 transition-all overflow-hidden group">
                        <div id="preview-container" class="hidden absolute inset-0 w-full h-full bg-white">
                            <img id="image-preview" src="#" alt="Preview" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black/20 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <span class="bg-white px-4 py-2 rounded-xl text-xs font-bold shadow-lg">Ganti Foto</span>
                            </div>
                        </div>

                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <div class="p-3 bg-white rounded-2xl shadow-sm text-slate-400 mb-3 group-hover:text-brand-600 group-hover:scale-110 transition-all duration-300">
                                <i data-lucide="upload-cloud" class="w-8 h-8"></i>
                            </div>
                            <p class="text-sm text-slate-600 font-semibold">Klik untuk unggah foto</p>
                            <p class="text-[10px] text-slate-400 uppercase tracking-widest mt-1">PNG, JPG atau JPEG (Maks. 2MB)</p>
                        </div>
                        <input id="foto_bukti" type="file" name="foto_bukti" class="hidden" required onchange="previewImage(this)" />
                    </label>
                </div>
                <p class="text-[11px] text-slate-400 italic px-1 italic">Tunjukkan bukti kuat seperti foto barang saat masih Anda miliki atau foto saat Anda memegang barang tersebut.</p>
            </div>

            <button type="submit"
                class="w-full bg-slate-900 text-white py-4 rounded-2xl font-bold text-sm hover:bg-brand-600 hover:-translate-y-1 active:translate-y-0 transition-all shadow-xl shadow-slate-200 flex items-center justify-center gap-2 group">
                Kirim Laporan Klaim
                <i data-lucide="send" class="w-4 h-4 transition-transform group-hover:translate-x-1 group-hover:-translate-y-1"></i>
            </button>
        </form>
    </div>

    <p class="text-center text-slate-400 text-xs mt-8">
        Data Anda aman dan hanya digunakan untuk keperluan verifikasi oleh tim SiTemu.
    </p>
</div>

<script>
    function previewImage(input) {
        const preview = document.getElementById('image-preview');
        const container = document.getElementById('preview-container');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                container.classList.remove('hidden');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
</script>
@endsection
