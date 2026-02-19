@extends('layouts.app')

@section('title', 'Barang Hilang - SiTemu')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-12">
        <div class="text-center space-y-4 animate-in fade-in slide-in-from-top-4 duration-700">
            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">Barang Hilang</h2>
            <p class="text-slate-500 max-w-2xl mx-auto text-lg">Daftar barang yang dilaporkan hilang. Bantu pemiliknya menemukan barang mereka.</p>
        </div>

        <section class="space-y-6">
            <div class="flex items-center justify-between border-b border-slate-200 pb-4">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-orange-100 rounded-lg text-orange-600">
                        <i data-lucide="search" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-800">Laporan Kehilangan</h3>
                </div>
                <span class="text-sm font-medium text-slate-400 bg-slate-100 px-3 py-1 rounded-full">{{ $lostItems->count() }} Laporan Aktif</span>
            </div>

            @if ($lostItems->isEmpty())
                <div class="bg-slate-50 rounded-3xl p-12 text-center border-2 border-dashed border-slate-200">
                    <i data-lucide="package-search" class="w-12 h-12 text-slate-300 mx-auto mb-4"></i>
                    <p class="text-slate-500 font-medium">Saat ini tidak ada laporan barang hilang.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($lostItems as $item)
                        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden group hover:shadow-xl transition-all duration-300">
                            <div class="relative h-48 overflow-hidden bg-slate-100">
                                <img src="{{ asset('storage/' . $item->foto) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="{{ $item->nama_barang }}">
                                <div class="absolute top-4 left-4">
                                    <span class="bg-orange-600 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest shadow-lg">Hilang</span>
                                </div>
                            </div>
                            <div class="p-6 space-y-4">
                                <div>
                                    <h4 class="text-lg font-bold text-slate-800 line-clamp-1">{{ $item->nama_barang }}</h4>

                                    {{-- TANGGAL LAPORAN DIBUAT --}}
                                    <div class="flex items-center gap-1.5 mt-1 mb-2 text-xs text-slate-400 font-medium">
                                        <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                                        <span>{{ $item->created_at->format('d M Y') }}</span>
                                    </div>

                                    <p class="text-slate-500 text-sm line-clamp-2">{{ $item->deskripsi }}</p>
                                </div>
                                <a href="/klaim/lost/{{ $item->id }}" class="block text-center w-full py-3 px-4 bg-slate-900 text-white rounded-2xl font-bold text-sm hover:bg-orange-600 transition-colors shadow-lg">Saya Menemukannya</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>
    </div>
@endsection
