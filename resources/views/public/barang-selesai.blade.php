@extends('layouts.app')

@section('title', 'Barang Selesai - SiTemu')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-16">
        <div class="text-center space-y-4 animate-in fade-in slide-in-from-top-4 duration-700">
            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">Barang Selesai</h2>
            <p class="text-slate-500 max-w-2xl mx-auto text-lg">Arsip barang-barang yang telah berhasil kembali ke pemiliknya melalui SiTemu.</p>
        </div>

        {{-- Section Lost Items yang Selesai --}}
        <section class="space-y-6">
            <h3 class="text-xl font-bold text-slate-800 border-l-4 border-orange-500 pl-4">Kehilangan yang Teratasi</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse ($lostItems as $item)
                    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden opacity-75 grayscale hover:grayscale-0 transition-all duration-500">
                        <div class="relative h-40 bg-slate-100">
                            <img src="{{ asset('storage/' . $item->foto) }}" class="w-full h-full object-cover" alt="Selesai">
                            <div class="absolute inset-0 bg-slate-900/40 flex items-center justify-center">
                                <span class="bg-white/90 text-slate-900 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest">Sudah Kembali</span>
                            </div>
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-slate-800 line-clamp-1">{{ $item->nama_barang }}</h4>
                            <p class="text-slate-500 text-xs mt-1">Dilaporkan oleh: {{ $item->nama_pelapor }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-slate-400 text-sm italic">Belum ada arsip kehilangan.</p>
                @endforelse
            </div>
        </section>

        {{-- Section Found Items yang Selesai --}}
        <section class="space-y-6">
            <h3 class="text-xl font-bold text-slate-800 border-l-4 border-emerald-500 pl-4">Temuan yang Terklaim</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse ($foundItems as $item)
                    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden opacity-75 grayscale hover:grayscale-0 transition-all duration-500">
                        <div class="relative h-40 bg-slate-100">
                            <img src="{{ asset('storage/' . $item->foto) }}" class="w-full h-full object-cover" alt="Selesai">
                            <div class="absolute inset-0 bg-slate-900/40 flex items-center justify-center">
                                <span class="bg-white/90 text-slate-900 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest">Terklaim</span>
                            </div>
                        </div>
                        <div class="p-4">
                            <p class="text-slate-800 font-medium text-sm italic line-clamp-1">"{{ $item->deskripsi }}"</p>
                            <p class="text-slate-500 text-xs mt-1">Ditemukan di: {{ $item->lokasi }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-slate-400 text-sm italic">Belum ada arsip temuan.</p>
                @endforelse
            </div>
        </section>
    </div>
@endsection
