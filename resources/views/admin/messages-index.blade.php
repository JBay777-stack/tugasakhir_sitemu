@extends('layouts.app')

@section('is_admin', true)
@section('page_title', 'Pesan Masuk (Chat)')

@section('content')
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 lg:col-span-4 bg-white rounded-2xl border border-slate-200 overflow-hidden h-[calc(100vh-200px)] flex flex-col">
        <div class="p-4 border-b border-slate-100 bg-slate-50/50">
            <h3 class="font-bold text-slate-800">Daftar Percakapan</h3>
        </div>
        <div class="flex-1 overflow-y-auto">
            @forelse($chats as $chat)
                <a href="?session={{ $chat->session_id }}"
                   class="block p-4 border-b border-slate-50 hover:bg-brand-50 transition-colors {{ request('session') == $chat->session_id ? 'bg-brand-50 border-r-4 border-r-brand-600' : '' }}">
                    <div class="flex justify-between items-start mb-1">
                        <span class="font-bold text-sm text-slate-700">Guest #{{ substr($chat->session_id, 0, 8) }}</span>
                        <span class="text-[10px] text-slate-400">{{ \Carbon\Carbon::parse($chat->last_chat)->diffForHumans() }}</span>
                    </div>
                    <p class="text-xs text-slate-500 truncate">Klik untuk melihat pesan...</p>
                </a>
            @empty
                <div class="p-8 text-center text-slate-400">
                    <i data-lucide="message-square-off" class="w-10 h-10 mx-auto mb-2 opacity-20"></i>
                    <p class="text-sm">Belum ada pesan masuk</p>
                </div>
            @endforelse
        </div>
    </div>

    <div class="col-span-12 lg:col-span-8 bg-white rounded-2xl border border-slate-200 overflow-hidden h-[calc(100vh-200px)] flex flex-col">
        @if(request('session'))
            <div class="p-4 border-b border-slate-100 flex justify-between items-center bg-white">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-brand-100 text-brand-600 rounded-full flex items-center justify-center font-bold">
                        G
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-800 text-sm">Guest #{{ substr(request('session'), 0, 8) }}</h4>
                        <span class="text-[10px] text-emerald-500 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span> Online
                        </span>
                    </div>
                </div>
            </div>

            <div class="flex-1 overflow-y-auto p-6 space-y-4 bg-slate-50/50" id="admin-chat-content">
                @php
                    $messages = DB::table('messages')->where('session_id', request('session'))->orderBy('created_at', 'asc')->get();
                @endphp
                @foreach($messages as $m)
                    <div class="flex {{ $m->sender_type == 'admin' ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-[70%] {{ $m->sender_type == 'admin' ? 'bg-brand-600 text-white rounded-tr-none' : 'bg-white text-slate-700 border border-slate-200 rounded-tl-none' }} p-3 rounded-2xl shadow-sm">
                            <p class="text-sm">{{ $m->message }}</p>
                            <span class="text-[10px] mt-1 block opacity-60">{{ \Carbon\Carbon::parse($m->created_at)->format('H:i') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="p-4 bg-white border-t border-slate-100">
                <form action="{{ route('admin.messages.reply') }}" method="POST" class="flex gap-2">
                    @csrf
                    <input type="hidden" name="session_id" value="{{ request('session') }}">
                    <input type="text" name="message" required
                           class="flex-1 bg-slate-100 border-none rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-brand-600 outline-none"
                           placeholder="Ketik balasan untuk user...">
                    <button type="submit" class="bg-brand-600 hover:bg-brand-700 text-white px-4 py-2 rounded-xl transition-all flex items-center gap-2 font-bold text-sm">
                        <i data-lucide="send" class="w-4 h-4"></i> Kirim
                    </button>
                </form>
            </div>
        @else
            <div class="flex-1 flex flex-col items-center justify-center text-slate-400 p-12 text-center">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                    <i data-lucide="messages-square" class="w-10 h-10 opacity-20"></i>
                </div>
                <h3 class="font-bold text-slate-600">Pilih Pesan</h3>
                <p class="text-sm max-w-xs">Silakan pilih salah satu percakapan di sebelah kiri untuk mulai membalas chat dari user.</p>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    // Auto scroll ke bawah saat halaman dimuat
    const chatContent = document.getElementById('admin-chat-content');
    if(chatContent) {
        chatContent.scrollTop = chatContent.scrollHeight;
    }
</script>
@endpush
@endsection
