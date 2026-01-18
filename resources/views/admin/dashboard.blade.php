@extends('layouts.app')

@section('is_admin', true)
@section('title', 'Dashboard Overview - SiTemu')
@section('page_title', 'Dashboard Overview')

@section('content')
    <div class="mb-10 animate-in fade-in slide-in-from-left duration-700">
        <h3 class="text-2xl font-extrabold text-slate-900 tracking-tight">Selamat datang, Admin SiTemu! 👋</h3>
        <p class="text-slate-500 mt-1 text-sm font-medium">Pantau dan kelola laporan warga sekolah dalam satu panel kendali terpadu.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-white p-6 rounded-[24px] border border-slate-200 shadow-sm hover:shadow-md transition-all duration-300 group">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 bg-orange-100 text-orange-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i data-lucide="search" class="w-7 h-7"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.15em]">Kehilangan</p>
                    <h4 class="text-3xl font-black text-slate-800">{{ $lostCount }}</h4>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-[24px] border border-slate-200 shadow-sm hover:shadow-md transition-all duration-300 group">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i data-lucide="check-circle" class="w-7 h-7"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.15em]">Temuan</p>
                    <h4 class="text-3xl font-black text-slate-800">{{ $foundCount }}</h4>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-[24px] border border-slate-200 shadow-sm hover:shadow-md transition-all duration-300 group">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 bg-indigo-100 text-indigo-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i data-lucide="database" class="w-7 h-7"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.15em]">Total Data</p>
                    <h4 class="text-3xl font-black text-slate-800">{{ $lostCount + $foundCount }}</h4>
                </div>
            </div>
        </div>

        <div class="bg-slate-900 p-6 rounded-[24px] shadow-xl shadow-slate-200 text-white group">
            <div class="flex items-center gap-4">
                <div class="relative">
                    <div class="w-14 h-14 bg-white/10 rounded-2xl flex items-center justify-center">
                        <i data-lucide="activity" class="w-7 h-7 text-emerald-400 group-hover:rotate-12 transition-transform"></i>
                    </div>
                    <span class="absolute top-0 right-0 flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                    </span>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-white/50 uppercase tracking-[0.15em]">System</p>
                    <h4 class="text-lg font-extrabold text-white leading-tight">Online</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white rounded-[32px] border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/30">
                <h4 class="font-bold text-slate-800 flex items-center gap-2.5">
                    <span class="w-3 h-3 bg-orange-500 rounded-full shadow-[0_0_10px_rgba(249,115,22,0.4)]"></span>
                    Kehilangan Terbaru
                </h4>
                <a href="/admin/laporan-kehilangan" class="text-[11px] font-bold text-brand-600 bg-brand-50 px-3 py-1.5 rounded-xl hover:bg-brand-600 hover:text-white transition-all">LIHAT SEMUA</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50/50">
                        <tr>
                            <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Barang</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Pelapor</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($lostItems as $item)
                        <tr class="hover:bg-slate-50/80 transition-colors group">
                            <td class="px-6 py-5 font-bold text-slate-700 tracking-tight">{{ $item->nama_barang }}</td>
                            <td class="px-6 py-5 text-slate-500 font-medium">{{ $item->nama_pelapor }}</td>
                            <td class="px-6 py-5 text-right">
                                <span class="px-3 py-1.5 text-[10px] font-extrabold uppercase rounded-lg {{ $item->status == 'Terverifikasi' ? 'bg-emerald-50 text-emerald-600' : 'bg-orange-50 text-orange-600' }}">
                                    {{ $item->status }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-[32px] border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/30">
                <h4 class="font-bold text-slate-800 flex items-center gap-2.5">
                    <span class="w-3 h-3 bg-emerald-500 rounded-full shadow-[0_0_10px_rgba(16,185,129,0.4)]"></span>
                    Temuan Terbaru
                </h4>
                <a href="/admin/laporan-temuan" class="text-[11px] font-bold text-brand-600 bg-brand-50 px-3 py-1.5 rounded-xl hover:bg-brand-600 hover:text-white transition-all">LIHAT SEMUA</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50/50">
                        <tr>
                            <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Deskripsi</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Lokasi</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($foundItems as $item)
                        <tr class="hover:bg-slate-50/80 transition-colors group">
                            <td class="px-6 py-5 font-medium text-slate-700 italic tracking-tight">"{{ Str::limit($item->deskripsi, 35) }}"</td>
                            <td class="px-6 py-5 text-slate-500 font-semibold flex items-center gap-1.5">
                                <i data-lucide="map-pin" class="w-3.5 h-3.5 text-emerald-500"></i> {{ $item->lokasi }}
                            </td>
                            <td class="px-6 py-5 text-right">
                                <span class="px-3 py-1.5 text-[10px] font-extrabold uppercase bg-brand-50 text-brand-600 rounded-lg border border-brand-100">
                                    {{ $item->status }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
