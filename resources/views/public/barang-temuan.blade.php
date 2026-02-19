@extends('layouts.app')

@section('title', 'Barang Temuan - SiTemu')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-12">
        <div class="text-center space-y-4 animate-in fade-in slide-in-from-top-4 duration-700">
            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight">Barang Temuan</h2>
            <p class="text-slate-500 max-w-2xl mx-auto text-lg">Cari barang Anda yang mungkin sudah ditemukan oleh orang lain di sini.</p>
        </div>

        <section class="space-y-6">
            <div class="flex items-center justify-between border-b border-slate-200 pb-4">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-emerald-100 rounded-lg text-emerald-600">
                        <i data-lucide="check-circle" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-800">Laporan Penemuan</h3>
                </div>
                <span class="text-sm font-medium text-slate-400 bg-slate-100 px-3 py-1 rounded-full">{{ $foundItems->count() }} Laporan Aktif</span>
            </div>

            @if ($foundItems->isEmpty())
                <div class="bg-slate-50 rounded-3xl p-12 text-center border-2 border-dashed border-slate-200">
                    <i data-lucide="inbox" class="w-12 h-12 text-slate-300 mx-auto mb-4"></i>
                    <p class="text-slate-500 font-medium">Saat ini tidak ada laporan barang ditemukan.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($foundItems as $item)
                        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden group hover:shadow-xl transition-all duration-300">
                            <div class="relative h-48 overflow-hidden bg-slate-100">
                                <img src="{{ asset('storage/' . $item->foto) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Temuan">
                                <div class="absolute top-4 left-4">
                                    <span class="bg-emerald-600 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest shadow-lg">Ditemukan</span>
                                </div>
                            </div>
                            <div class="p-6 space-y-4">
                                <div>
                                    <p class="text-slate-800 font-medium line-clamp-2 italic">"{{ $item->deskripsi }}"</p>

                                    <div class="flex flex-col gap-1 mt-3">
                                        {{-- TANGGAL LAPORAN DIBUAT --}}
                                        <div class="flex items-center gap-1.5 text-xs text-slate-400 font-medium">
                                            <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                                            <span>{{ $item->created_at->format('d M Y') }}</span>
                                        </div>

                                        {{-- LOKASI PENEMUAN --}}
                                        <div class="flex items-center gap-1.5 text-slate-500 text-xs">
                                            <i data-lucide="map-pin" class="w-3.5 h-3.5 text-emerald-500"></i>
                                            <span>{{ $item->lokasi }}</span>
                                        </div>
                                    </div>
                                </div>
                                <a href="/klaim/found/{{ $item->id }}" class="block text-center w-full py-3 px-4 bg-emerald-600 text-white rounded-2xl font-bold text-sm hover:bg-emerald-700 transition-all shadow-lg">Ini Milik Saya</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>
    </div>
@endsection
