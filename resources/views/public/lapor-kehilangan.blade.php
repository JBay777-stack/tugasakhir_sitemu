@extends('layouts.app')

@section('title', 'Lapor Barang Hilang - SiTemu')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-12">
    <div class="text-center mb-10 animate-in fade-in slide-in-from-top-4 duration-700">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-orange-50 rounded-2xl text-orange-600 mb-4 shadow-sm border border-orange-100">
            <i data-lucide="search" class="w-8 h-8"></i>
        </div>
        <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Lapor Barang Hilang</h2>
        <p class="text-slate-500 mt-2">Berikan detail yang jelas untuk membantu proses pencarian.</p>
    </div>

    <div class="bg-white rounded-[32px] shadow-xl shadow-slate-200/60 border border-slate-100 overflow-hidden animate-in fade-in slide-in-from-bottom-6 duration-700">
        <form method="POST" action="/lapor-kehilangan" enctype="multipart/form-data" class="p-8 md:p-10 space-y-8">
            @csrf

            <div class="space-y-5">
                <div class="flex items-center gap-2 pb-2 border-b border-slate-100">
                    <i data-lucide="user-circle" class="w-5 h-5 text-orange-500"></i>
                    <h3 class="font-bold text-slate-800">Informasi Pelapor</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-slate-700 ml-1">Nama Pelapor</label>
                        <input type="text" name="nama_pelapor" required
                            class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 transition-all placeholder:text-slate-400"
                            placeholder="Nama lengkap Anda">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-slate-700 ml-1">Status</label>
                        <select name="status_pelapor" id="status_pelapor" onchange="toggleStudentFields()" required
                            class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 transition-all text-slate-700">
                            <option value="" disabled selected>Pilih Status...</option>
                            <option value="Siswa">Siswa</option>
                            <option value="Guru">Guru</option>
                            <option value="Karyawan">Karyawan</option>
                        </select>
                    </div>
                </div>

                <div id="student_fields" class="grid grid-cols-1 md:grid-cols-2 gap-5 hidden">
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-slate-700 ml-1">Kelas</label>
                        <select name="kelas" id="kelas_input"
                            class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 transition-all text-slate-700">
                            <option value="" disabled selected>Pilih Kelas...</option>
                            <option value="X">X</option>
                            <option value="XI">XI</option>
                            <option value="XII">XII</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-slate-700 ml-1">Jurusan</label>
                        <select name="jurusan" id="jurusan_input"
                            class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 transition-all text-slate-700">
                            <option value="" disabled selected>Pilih Jurusan...</option>
                            <option value="RPL">RPL 1</option>
                            <option value="RPL">RPL 2</option>
                            <option value="RPL">RPL 3</option>
                            <option value="APHP">APHP 1</option>
                            <option value="APHP">APHP 2</option>
                            <option value="DKV">DKV 1</option>
                            <option value="DKV">DKV 2</option>
                            <option value="KULINER">KULINER 1</option>
                            <option value="KULINER">KULINER 2</option>
                            <option value="KULINER">KULINER 3</option>
                            <option value="PS">PS 1</option>
                            <option value="PS">PS 2</option>
                            </select>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-bold text-slate-700 ml-1">WhatsApp / Kontak</label>
                    <input type="text" name="kontak" required
                        class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 transition-all placeholder:text-slate-400"
                        placeholder="Contoh: 0812xxxx">
                </div>
            </div>

            <div class="space-y-5 pt-4">
                <div class="flex items-center gap-2 pb-2 border-b border-slate-100">
                    <i data-lucide="package" class="w-5 h-5 text-orange-500"></i>
                    <h3 class="font-bold text-slate-800">Detail Barang</h3>
                </div>

                <div class="space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-700 ml-1">Nama Barang</label>
                            <input type="text" name="nama_barang" required
                                class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 transition-all placeholder:text-slate-400"
                                placeholder="Apa barang yang hilang?">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-700 ml-1">Tanggal Laporan Kehilangan</label>
                            <input type="date" name="tanggal_kehilangan" required
                                class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 transition-all text-slate-700">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-slate-700 ml-1">Deskripsi Kejadian</label>
                        <textarea name="deskripsi" rows="3" required
                            class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 transition-all placeholder:text-slate-400"
                            placeholder="Ceritakan ciri-ciri barang atau lokasi terakhir terlihat..."></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-700 ml-1">Foto Barang</label>
                            <label class="flex items-center justify-between w-full px-4 py-3 bg-white border border-slate-200 rounded-2xl cursor-pointer hover:bg-slate-50 transition-all group">
                                <span id="file-name" class="text-sm text-slate-400 truncate">Pilih foto barang...</span>
                                <div class="px-3 py-1 bg-orange-100 text-orange-600 rounded-lg text-[10px] font-bold uppercase group-hover:bg-orange-600 group-hover:text-white transition-colors">
                                    Pilih
                                </div>
                                <input type="file" name="foto" class="hidden" required onchange="updateFileName(this)">
                            </label>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-700 ml-1">Imbalan (Opsional)</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 font-bold text-sm">Rp</span>
                                <input type="text" name="imbalan"
                                    class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:ring-4 focus:ring-orange-500/10 focus:border-orange-500 transition-all placeholder:text-slate-400"
                                    placeholder="Contoh: 100.000">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-6">
                <button type="submit"
                    class="w-full bg-slate-900 text-white py-4 rounded-2xl font-bold text-sm hover:bg-orange-600 hover:-translate-y-1 active:translate-y-0 transition-all shadow-xl shadow-slate-200 flex items-center justify-center gap-2 group">
                    <i data-lucide="megaphone" class="w-5 h-5 transition-transform group-hover:rotate-12"></i>
                    Kirim Laporan Kehilangan
                </button>
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

    function toggleStudentFields() {
        const status = document.getElementById('status_pelapor').value;
        const studentFields = document.getElementById('student_fields');
        const kelasInput = document.getElementById('kelas_input');
        const jurusanInput = document.getElementById('jurusan_input');

        if (status === 'Siswa') {
            studentFields.classList.remove('hidden');
            kelasInput.setAttribute('required', 'required');
            jurusanInput.setAttribute('required', 'required');
        } else {
            studentFields.classList.add('hidden');
            kelasInput.removeAttribute('required');
            jurusanInput.removeAttribute('required');
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
            title: 'Laporan Terkirim!',
            text: @json(session('success')),
            confirmButtonColor: '#ea580c',
            confirmButtonText: 'Tutup',
            customClass: {
                popup: 'rounded-[32px]',
                confirmButton: 'rounded-xl px-8 font-bold'
            }
        });
    });
</script>
@endif
@endsection
