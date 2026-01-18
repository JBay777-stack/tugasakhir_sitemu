<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - SiTemu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f5f3ff',
                            600: '#6366f1',
                            700: '#4f46e5',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#f8fafc] font-sans antialiased">

<div class="min-h-screen flex items-center justify-center p-6 bg-[radial-gradient(circle_at_top_right,_#e0e7ff_0%,_#f8fafc_50%)]">

    <div class="w-full max-w-[440px] bg-white/80 backdrop-blur-xl p-8 md:p-10 rounded-[32px] shadow-[0_20px_50px_-12px_rgba(0,0,0,0.08)] border border-white/70 animate-in fade-in slide-in-from-bottom-5 duration-700">

        <div class="text-center mb-10">
            <div class="w-16 h-16 bg-brand-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-brand-600/30 text-white">
                <i data-lucide="shield-check" class="w-8 h-8"></i>
            </div>
            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Portal Admin</h2>
            <p class="text-slate-500 mt-2 text-sm">Silakan masuk dengan akun resmi SiTemu</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-100 rounded-2xl flex items-center gap-3 text-red-600 text-sm font-medium animate-shake">
                <i data-lucide="alert-circle" class="w-5 h-5 flex-shrink-0"></i>
                <p>{{ $errors->first() }}</p>
            </div>
        @endif

        <form method="POST" action="/admin/login" class="space-y-5">
            @csrf

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-2 ml-1 uppercase tracking-wider">Alamat Email</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-brand-600 transition-colors">
                        <i data-lucide="mail" class="w-5 h-5"></i>
                    </div>
                    <input type="email" name="email"
                        class="w-full pl-12 pr-4 py-3.5 bg-white border border-slate-200 rounded-2xl text-sm focus:outline-none focus:ring-4 focus:ring-brand-600/10 focus:border-brand-600 transition-all placeholder:text-slate-400"
                        placeholder="admin@sitemu.com" required autofocus>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-2 ml-1 uppercase tracking-wider">Kata Sandi</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-brand-600 transition-colors">
                        <i data-lucide="lock" class="w-5 h-5"></i>
                    </div>
                    <input type="password" name="password"
                        class="w-full pl-12 pr-4 py-3.5 bg-white border border-slate-200 rounded-2xl text-sm focus:outline-none focus:ring-4 focus:ring-brand-600/10 focus:border-brand-600 transition-all placeholder:text-slate-400"
                        placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit"
                class="w-full bg-brand-600 text-white py-4 rounded-2xl font-bold text-sm hover:bg-brand-700 hover:-translate-y-0.5 active:translate-y-0 transition-all shadow-lg shadow-brand-600/25 flex items-center justify-center gap-2 group">
                Masuk Sekarang
                <i data-lucide="arrow-right" class="w-4 h-4 transition-transform group-hover:translate-x-1"></i>
            </button>
        </form>

        <div class="mt-10 text-center">
            <a href="/" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-400 hover:text-brand-600 transition-colors group">
                <i data-lucide="chevron-left" class="w-4 h-4 transition-transform group-hover:-translate-x-1"></i>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>

<script>
    lucide.createIcons();
</script>

</body>
</html>
