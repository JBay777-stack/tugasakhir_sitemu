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


        html {
            scroll-behavior: smooth;
        }

        /* Custom scrollbar untuk chat */
        #chat-content::-webkit-scrollbar {
            width: 4px;
        }
        #chat-content::-webkit-scrollbar-thumb {
            background-color: #e2e8f0;
            border-radius: 10px;
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

                    <a href="{{ route('admin.messages.index') }}"
                        class="flex items-center gap-3 p-3 rounded-xl transition-all font-semibold {{ Request::is('admin/messages*') ? 'bg-brand-50 text-brand-600' : 'text-slate-600 hover:bg-slate-50' }}">
                        <i data-lucide="message-circle" class="w-5 h-5"></i> Pesan Masuk
                    </a>
                </nav>
                <div class="p-4 border-t border-slate-100">
                    <form method="POST" action="/admin/logout">
                        @csrf
                        <button class="w-full flex items-center gap-3 p-3 rounded-xl text-red-500 hover:bg-red-50 font-bold transition-all">
                            <i data-lucide="log-out" class="w-5 h-5"></i> Keluar
                        </button>
                    </form>
                </div>
            </aside>

            <main class="flex-1 lg:ml-64">
                <header class="h-16 bg-white/80 backdrop-blur-md border-b border-slate-100 sticky top-0 z-10 px-8 flex items-center justify-between">
                    <h2 class="font-bold text-slate-800">@yield('page_title', 'Admin Panel')</h2>
                    <div class="w-8 h-8 bg-brand-600 rounded-full flex items-center justify-center text-white font-bold text-xs uppercase">MIN</div>
                </header>
                <div class="p-8 animate-slide-up">
                    @yield('content')
                </div>
            </main>
        </div>
    @else
        <nav class="bg-white/80 backdrop-blur-md border-b border-slate-100 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 h-16 flex items-center justify-between">
                <a href="/admin/login" class="font-black text-xl text-brand-600 tracking-tighter flex items-center gap-2">
                    <i data-lucide="box" class="w-6 h-6"></i> SiTemu
                </a>

                <div class="hidden md:flex items-center gap-8 text-sm font-bold text-slate-600">
                    <a href="/" class="{{ Request::is('/') ? 'text-brand-600' : 'hover:text-brand-600' }} transition-colors">Beranda</a>

                    <a href="/barang-hilang" class="flex items-center gap-2 {{ Request::is('barang-hilang') ? 'text-orange-600' : 'hover:text-orange-600' }} transition-colors">
                         Barang Hilang
                    </a>

                    <a href="/barang-temuan" class="flex items-center gap-2 {{ Request::is('barang-temuan') ? 'text-emerald-600' : 'hover:text-emerald-600' }} transition-colors">
                         Barang Temuan
                    </a>

                    <a href="/barang-selesai" class="flex items-center gap-2 {{ Request::is('barang-selesai') ? 'text-brand-600' : 'hover:text-brand-600' }} transition-colors">
                         Selesai
                    </a>
                </div>
            </div>
        </nav>

        <main class="animate-slide-up">
            @yield('content')
        </main>

        <div id="chat-widget" class="fixed bottom-6 right-6 z-[60] flex flex-col items-end">
            <div id="chat-box" class="hidden bg-white w-[320px] md:w-[350px] h-[450px] rounded-2xl shadow-2xl border border-slate-200 flex flex-col mb-4 overflow-hidden animate-slide-up">
                <div class="bg-brand-600 p-4 text-white font-bold flex justify-between items-center shadow-lg">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></div>
                        <span>CS SiTemu</span>
                    </div>
                    <button onclick="toggleChat()" class="hover:bg-white/20 rounded-lg p-1 transition-colors">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>

                <div id="chat-content" class="flex-1 p-4 overflow-y-auto space-y-4 bg-slate-50 flex flex-col">
                    <div class="bg-white border border-slate-100 p-3 rounded-2xl rounded-tl-none shadow-sm max-w-[85%] text-sm text-slate-600">
                        Halo! Ada yang bisa kami bantu terkait barang temuan atau hilang? 😊
                    </div>
                </div>

                <div class="p-4 bg-white border-t border-slate-100">
                    <div class="flex gap-2">
                        <input type="text" id="chat-input"
                            class="flex-1 bg-slate-100 border-none rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-brand-600 outline-none"
                            placeholder="Ketik pesan anda..."
                            onkeypress="if(event.key === 'Enter') sendMsg()">
                        <button onclick="sendMsg()" class="bg-brand-600 hover:bg-brand-700 text-white p-2 rounded-xl transition-transform active:scale-95 shadow-md shadow-brand-600/20">
                            <i data-lucide="send" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>
            </div>

            <button onclick="toggleChat()" class="bg-brand-600 hover:bg-brand-700 text-white p-4 rounded-full shadow-2xl transition-all duration-300 hover:scale-110 flex items-center justify-center group">
                <i data-lucide="message-circle" class="w-7 h-7 group-hover:rotate-12 transition-transform"></i>
            </button>
        </div>

        <script>
            function toggleChat() {
                const box = document.getElementById('chat-box');
                box.classList.toggle('hidden');
                if(!box.classList.contains('hidden')) {
                    loadMessages();
                    document.getElementById('chat-input').focus();
                }
            }

            async function loadMessages() {
                try {
                    const res = await fetch('/chat/get-messages');
                    const data = await res.json();
                    const container = document.getElementById('chat-content');

                    if(data.length > 0) {
                        container.innerHTML = data.map(m => `
                            <div class="${m.sender_type === 'user' ? 'ml-auto bg-brand-600 text-white rounded-tr-none' : 'mr-auto bg-white text-slate-700 border border-slate-200 rounded-tl-none'} max-w-[85%] p-3 rounded-2xl shadow-sm text-sm">
                                ${m.message}
                                <div class="text-[10px] mt-1 opacity-70 ${m.sender_type === 'user' ? 'text-right' : 'text-left'}">
                                    ${new Date(m.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}
                                </div>
                            </div>
                        `).join('');
                        container.scrollTop = container.scrollHeight;
                    }
                } catch (e) { console.error("Gagal memuat pesan"); }
            }

            async function sendMsg() {
                const input = document.getElementById('chat-input');
                const message = input.value.trim();
                if(!message) return;

                input.value = '';
                try {
                    await fetch('/chat/send', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ message: message })
                    });
                    loadMessages();
                } catch (e) { alert("Gagal mengirim pesan"); }
            }

            // Polling pesan baru setiap 5 detik saat chat terbuka
            setInterval(() => {
                const box = document.getElementById('chat-box');
                if(!box.classList.contains('hidden')) loadMessages();
            }, 5000);
        </script>
    @endif

    <script>
        lucide.createIcons();
    </script>

    @stack('scripts')
</body>
</html>
