@extends('layouts.app')

@section('title', 'Selamat Datang di SiTemu')

@section('content')
<div class="relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
        <div class="text-center space-y-8 animate-in fade-in slide-in-from-bottom-10 duration-1000">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-brand-50 border border-brand-100 text-brand-600 text-xs font-bold uppercase tracking-wider mx-auto">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-brand-600"></span>
                </span>
                Solusi Kehilangan Barang
            </div>

            <h1 class="text-4xl md:text-6xl font-extrabold text-slate-900 tracking-tight leading-tight">
                Temukan yang <span class="text-brand-600">Hilang</span>,<br>
                Kembalikan yang <span class="text-emerald-500">Ditemukan</span>.
            </h1>

            <p class="text-slate-500 max-w-2xl mx-auto text-lg md:text-xl leading-relaxed">
                SiTemu adalah platform digital sekolah untuk melaporkan barang hilang dan mengelola penemuan barang secara transparan, cepat, dan terpercaya.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="/lapor-kehilangan" class="w-full sm:w-auto px-8 py-4 bg-slate-900 text-white rounded-2xl font-bold hover:bg-slate-800 transition-all shadow-xl shadow-slate-200 flex items-center justify-center gap-2 group">
                    <i data-lucide="frown" class="w-5 h-5 group-hover:rotate-12 transition-transform"></i>
                    Saya Kehilangan Barang
                </a>
                <a href="/lapor-temuan" class="w-full sm:w-auto px-8 py-4 bg-white text-slate-900 border-2 border-slate-200 rounded-2xl font-bold hover:bg-slate-50 transition-all flex items-center justify-center gap-2">
                    <i data-lucide="smile" class="w-5 h-5 text-emerald-500"></i>
                    Saya Menemukan Barang
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white border-y border-slate-100 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h3 class="text-2xl font-bold text-slate-900">Bagaimana Cara Kerjanya?</h3>
                <p class="text-slate-500 mt-2">Ikuti 3 langkah mudah untuk mengklaim barang Anda</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="relative p-8 rounded-3xl bg-slate-50 border border-slate-100 group hover:bg-white hover:shadow-2xl hover:shadow-slate-200/50 transition-all duration-500">
                    <div class="w-14 h-14 bg-brand-600 text-white rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-brand-200 transition-transform group-hover:-rotate-6">
                        <i data-lucide="file-text" class="w-6 h-6"></i>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-3">1. Isi Form Laporan</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Lengkapi detail barang mulai dari nama, lokasi terakhir, hingga foto bukti pendukung yang jelas.
                    </p>
                    <div class="absolute top-8 right-8 text-slate-200 text-5xl font-black">01</div>
                </div>

                <div class="relative p-8 rounded-3xl bg-slate-50 border border-slate-100 group hover:bg-white hover:shadow-2xl hover:shadow-slate-200/50 transition-all duration-500">
                    <div class="w-14 h-14 bg-amber-500 text-white rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-amber-200 transition-transform group-hover:-rotate-6">
                        <i data-lucide="clock" class="w-6 h-6"></i>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-3">2. Tunggu Verifikasi</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Admin akan memeriksa laporan Anda untuk memastikan validitas data sebelum dipublikasikan ke publik.
                    </p>
                    <div class="absolute top-8 right-8 text-slate-200 text-5xl font-black">02</div>
                </div>

                <div class="relative p-8 rounded-3xl bg-slate-50 border border-slate-100 group hover:bg-white hover:shadow-2xl hover:shadow-slate-200/50 transition-all duration-500">
                    <div class="w-14 h-14 bg-emerald-500 text-white rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-emerald-200 transition-transform group-hover:-rotate-6">
                        <i data-lucide="check-circle-2" class="w-6 h-6"></i>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-3">3. Selesai & Ambil</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Jika klaim disetujui, Anda dapat mengambil barang sesuai dengan instruksi dan jadwal dari pihak admin.
                    </p>
                    <div class="absolute top-8 right-8 text-slate-200 text-5xl font-black">03</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
</script>
@endsection
