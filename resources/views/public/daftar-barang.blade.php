@extends('layouts.app')

@section('title', 'Daftar Barang - SiTemu')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-12">

        <div class="text-center space-y-4 animate-in fade-in slide-in-from-top-4 duration-700">
            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">Pusat Informasi Barang</h2>
            <p class="text-slate-500 max-w-2xl mx-auto text-lg">Cari barang Anda yang hilang atau bantu kembalikan barang yang Anda temukan di sini.</p>
        </div>

        {{-- Section Barang Hilang --}}
        <section id="hilang" class="space-y-6 scroll-mt-24">
            <div class="flex items-center justify-between border-b border-slate-200 pb-4">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-orange-100 rounded-lg text-orange-600">
                        <i data-lucide="search" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-800">Barang Hilang</h3>
                </div>
                <span class="text-sm font-medium text-slate-400 bg-slate-100 px-3 py-1 rounded-full">{{ $lostItems->count() }} Laporan</span>
            </div>

            @if ($lostItems->isEmpty())
                <div class="bg-slate-50 rounded-3xl p-12 text-center border-2 border-dashed border-slate-200">
                    <i data-lucide="package-search" class="w-12 h-12 text-slate-300 mx-auto mb-4"></i>
                    <p class="text-slate-500 font-medium">Belum ada laporan barang hilang saat ini.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($lostItems as $item)
                        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden group hover:shadow-xl transition-all duration-300">
                            <div class="relative h-48 overflow-hidden bg-slate-100">
                                <img src="{{ asset('storage/' . $item->foto) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110 {{ $item->status === 'selesai' ? 'grayscale opacity-50' : '' }}" alt="{{ $item->nama_barang }}">
                                <div class="absolute top-4 left-4">
                                    @if($item->status === 'selesai')
                                        <span class="bg-slate-600 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest shadow-lg">Sudah Kembali</span>
                                    @else
                                        <span class="bg-orange-600 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest shadow-lg">Hilang</span>
                                    @endif
                                </div>
                            </div>
                            <div class="p-6 space-y-4">
                                <div>
                                    <h4 class="text-lg font-bold text-slate-800 line-clamp-1">{{ $item->nama_barang }}</h4>
                                    <p class="text-slate-500 text-sm line-clamp-2 mt-1">{{ $item->deskripsi }}</p>
                                </div>

                                @if($item->status === 'selesai')
                                    <button disabled class="w-full py-3 px-4 bg-slate-100 text-slate-400 rounded-2xl font-bold text-sm cursor-not-allowed border border-slate-200">
                                        Barang Telah Di Klaim
                                    </button>
                                @else
                                    <a href="/klaim/lost/{{ $item->id }}" class="block text-center w-full py-3 px-4 bg-slate-900 text-white rounded-2xl font-bold text-sm hover:bg-orange-600 transition-colors shadow-lg">
                                        Saya Menemukannya
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>

        {{-- Section Barang Temuan --}}
        <section id="temuan" class="space-y-6 scroll-mt-24 pt-10">
            <div class="flex items-center justify-between border-b border-slate-200 pb-4">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-emerald-100 rounded-lg text-emerald-600">
                        <i data-lucide="check-circle" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-800">Barang Ditemukan</h3>
                </div>
                <span class="text-sm font-medium text-slate-400 bg-slate-100 px-3 py-1 rounded-full">{{ $foundItems->count() }} Laporan</span>
            </div>

            @if ($foundItems->isEmpty())
                <div class="bg-slate-50 rounded-3xl p-12 text-center border-2 border-dashed border-slate-200">
                    <i data-lucide="inbox" class="w-12 h-12 text-slate-300 mx-auto mb-4"></i>
                    <p class="text-slate-500 font-medium">Belum ada laporan barang ditemukan saat ini.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($foundItems as $item)
                        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden group hover:shadow-xl transition-all duration-300">
                            <div class="relative h-48 overflow-hidden bg-slate-100">
                                <img src="{{ asset('storage/' . $item->foto) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110 {{ $item->status === 'selesai' ? 'grayscale opacity-50' : '' }}" alt="Temuan">
                                <div class="absolute top-4 left-4">
                                    @if($item->status === 'selesai')
                                        <span class="bg-slate-600 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest shadow-lg">Selesai</span>
                                    @else
                                        <span class="bg-emerald-600 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest shadow-lg">Ditemukan</span>
                                    @endif
                                </div>
                            </div>
                            <div class="p-6 space-y-4">
                                <div>
                                    <p class="text-slate-800 font-medium line-clamp-2 italic">"{{ $item->deskripsi }}"</p>
                                    <div class="flex items-center gap-1.5 mt-3 text-slate-500 text-xs">
                                        <i data-lucide="map-pin" class="w-4 h-4 text-emerald-500"></i>
                                        <span>{{ $item->lokasi }}</span>
                                    </div>
                                </div>

                                @if($item->status === 'selesai')
                                    <button disabled class="w-full py-3 px-4 bg-slate-100 text-slate-400 rounded-2xl font-bold text-sm cursor-not-allowed border border-slate-200">
                                        Barang Telah Di Klaim
                                    </button>
                                @else
                                    <a href="/klaim/found/{{ $item->id }}" class="block text-center w-full py-3 px-4 bg-emerald-600 text-white rounded-2xl font-bold text-sm hover:bg-emerald-700 transition-all shadow-lg">
                                        Ini Milik Saya
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>
    </div>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const msg = @json(session('success'));
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: msg,
                    confirmButtonColor: '#6366f1',
                    confirmButtonText: 'Tutup',
                    customClass: {
                        popup: 'rounded-[32px]',
                        confirmButton: 'rounded-xl px-6'
                    }
                });
            });
        </script>
    @endif
@endsection
