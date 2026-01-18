<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SiTemu')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif']
                    },
                    colors: {
                        brand: {
                            50: '#f5f3ff',
                            600: '#6366f1',
                            700: '#4f46e5'
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .animate-slide-up {
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="bg-[#f8fafc] font-sans antialiased text-slate-900">

    @if (View::hasSection('is_admin'))
        <div class="flex min-h-screen">
            <aside class="w-64 bg-white border-r border-slate-200 hidden lg:flex flex-col fixed h-full">
                <div class="p-6 border-b border-slate-100 font-extrabold text-xl text-brand-600 flex items-center gap-2">
                    <i data-lucide="box" class="w-6 h-6"></i> SiTemu Admin
                </div>
                <nav class="p-4 space-y-2 flex-1">
                    <a href="/admin/dashboard"
                        class="flex items-center gap-3 p-3 rounded-xl transition-all font-bold {{ Request::is('admin/dashboard') ? 'bg-brand-50 text-brand-600' : 'text-slate-600 hover:bg-slate-50' }}">
                        <i data-lucide="layout-dashboard" class="w-5 h-5"></i> Dashboard
                    </a>

                    <a href="/admin/laporan-kehilangan"
                        class="flex items-center gap-3 p-3 rounded-xl transition-all font-semibold {{ Request::is('admin/laporan-kehilangan*') ? 'bg-brand-50 text-brand-600' : 'text-slate-600 hover:bg-slate-50' }}">
                        <i data-lucide="search" class="w-5 h-5"></i> Barang Hilang
                    </a>

                    <a href="/admin/laporan-temuan"
                        class="flex items-center gap-3 p-3 rounded-xl transition-all font-semibold {{ Request::is('admin/laporan-temuan*') ? 'bg-brand-50 text-brand-600' : 'text-slate-600 hover:bg-slate-50' }}">
                        <i data-lucide="package-plus" class="w-5 h-5"></i> Barang Temuan
                    </a>

                    <a href="/admin/klaim"
                        class="flex items-center gap-3 p-3 rounded-xl transition-all font-semibold {{ Request::is('admin/klaim*') ? 'bg-brand-50 text-brand-600' : 'text-slate-600 hover:bg-slate-50' }}">
                        <i data-lucide="clipboard-check" class="w-5 h-5"></i> Klaim Barang
                    </a>

                </nav>
                <div class="p-4 border-t border-slate-100">
                    <form method="POST" action="/admin/logout">
                        @csrf
                        <button
                            class="w-full flex items-center gap-3 p-3 rounded-xl text-red-500 hover:bg-red-50 font-bold transition-all">
                            <i data-lucide="log-out" class="w-5 h-5"></i> Keluar
                        </button>
                    </form>
                </div>
            </aside>

            <main class="flex-1 lg:ml-64">
                <header
                    class="h-16 bg-white/80 backdrop-blur-md border-b border-slate-100 sticky top-0 z-10 px-8 flex items-center justify-between">
                    <h2 class="font-bold text-slate-800">@yield('page_title', 'Admin Panel')</h2>
                    <div
                        class="w-8 h-8 bg-brand-600 rounded-full flex items-center justify-center text-white font-bold text-xs uppercase">
                        MIN
                    </div>
                </header>
                <div class="p-8 animate-slide-up">
                    @yield('content')
                </div>
            </main>
        </div>
    @else
        <nav class="bg-white/80 backdrop-blur-md border-b border-slate-100 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 h-16 flex items-center justify-between">
                <a href="admin/login" class="font-black text-xl text-brand-600 tracking-tighter flex items-center gap-2">
                    <i data-lucide="box" class="w-6 h-6"></i> SiTemu
                </a>
                <div class="hidden md:flex items-center gap-8 text-sm font-bold text-slate-600">
                    <a href="/" class="hover:text-brand-600 transition-colors">Beranda</a>
                    <a href="/daftar-barang" class="hover:text-brand-600 transition-colors">Cari Barang</a>
                </div>
            </div>
        </nav>

        <main class="animate-slide-up">
            @yield('content')
        </main>
    @endif

    <script>
        lucide.createIcons();
    </script>

    @stack('scripts')
</body>

</html>
