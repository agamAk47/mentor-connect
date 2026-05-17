@extends('layouts.app')

@section('title', 'Messages | MentorConnect')

@section('content')

<section class="relative min-h-[calc(100vh-4rem)] lg:min-h-[calc(100vh-5rem)] flex overflow-hidden bg-[#FAFBFF] py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto w-full flex flex-col h-[calc(100vh-8rem)] bg-white rounded-3xl shadow-[0_20px_50px_-12px_rgba(0,0,0,0.06)] border border-slate-100 overflow-hidden relative z-10">
        
        {{-- Chat Header --}}
        <div class="px-6 py-4 border-b border-slate-100 bg-white/80 backdrop-blur-md flex justify-between items-center z-10">
            <div class="flex items-center gap-4">
                <a href="{{ url()->previous() }}" class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-500 hover:bg-slate-100 hover:text-slate-800 transition-colors">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                </a>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-slate-100 text-slate-700 border border-slate-200 flex items-center justify-center font-bold shadow-sm">
                        {{ strtoupper(substr($receiver->name ?? $receiver->startup_name ?? 'U', 0, 1)) }}
                    </div>
                    <div>
                        <h2 class="font-bold text-slate-800 text-sm">{{ $receiver->name ?? $receiver->startup_name ?? 'Unknown' }}</h2>
                        <p class="text-xs text-slate-500 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Online
                        </p>
                    </div>
                </div>
            </div>
            
            <a href="mailto:{{ $receiver->email }}" class="px-4 py-2 bg-slate-50 text-slate-600 text-xs font-semibold rounded-lg hover:bg-slate-100 transition-colors flex items-center gap-2">
                <i data-lucide="mail" class="w-3.5 h-3.5"></i> Email
            </a>
        </div>

        {{-- Chat Messages Area --}}
        <div class="flex-1 overflow-y-auto p-6 space-y-6 bg-slate-50/50" id="chatContainer">
            @if($messages->isEmpty())
                <div class="flex flex-col items-center justify-center h-full text-center">
                    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mb-4 text-slate-400">
                        <i data-lucide="message-square" class="w-8 h-8"></i>
                    </div>
                    <h3 class="text-slate-700 font-bold mb-1">No messages yet</h3>
                    <p class="text-slate-500 text-sm">Send a message to start the conversation.</p>
                </div>
            @else
                @foreach($messages as $message)
                    @php
                        $isMine = ($message->sender_id == $currentUserId && $message->sender_type == $currentUserRole);
                    @endphp
                    
                    <div class="flex w-full {{ $isMine ? 'justify-end' : 'justify-start' }}">
                        <div class="flex flex-col {{ $isMine ? 'items-end' : 'items-start' }} max-w-[75%]">
                            <div class="px-5 py-3 rounded-2xl shadow-sm text-sm {{ $isMine ? 'bg-slate-800 text-white rounded-br-none' : 'bg-white border border-slate-200 text-slate-800 rounded-bl-none' }}">
                                {!! nl2br(e($message->content)) !!}
                            </div>
                            <span class="text-[0.65rem] text-slate-400 mt-1.5 mx-1 font-medium">
                                {{ $message->created_at->timezone('Asia/Kolkata')->format('M d, g:i A') }}
                            </span>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        {{-- Chat Input Area --}}
        <div class="p-4 bg-white border-t border-slate-100">
            <form action="{{ route('messages.store', ['receiverType' => $receiverType, 'receiverId' => $receiverId]) }}" method="POST" class="flex items-end gap-3">
                @csrf
                <div class="flex-1 relative">
                    <textarea name="content" rows="1" class="w-full pl-4 pr-12 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all resize-none max-h-32 shadow-sm" placeholder="Type a message..." required oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                </div>
                <button type="submit" class="w-12 h-12 flex items-center justify-center rounded-2xl bg-primary-500 text-white hover:bg-primary-600 transition-colors flex-shrink-0 shadow-sm hover:shadow shadow-primary-500/25">
                    <i data-lucide="send" class="w-5 h-5 ml-1"></i>
                </button>
            </form>
            @error('content')
                <p class="text-red-500 text-xs mt-2 ml-1">{{ $message }}</p>
            @enderror
            <p class="text-[0.65rem] text-slate-400 text-center mt-3 flex items-center justify-center gap-1">
                <i data-lucide="info" class="w-3 h-3"></i> Note: You must refresh the page to see new messages.
            </p>
        </div>
        
    </div>
</section>

@endsection

@section('scripts')
<script>
    lucide.createIcons();
    // Auto-scroll to bottom
    const chatContainer = document.getElementById('chatContainer');
    if (chatContainer) {
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }
</script>
@endsection
