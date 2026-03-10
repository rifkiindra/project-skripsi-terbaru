@extends('layouts.adminlte')

@section('title', 'Chat Revisi')

@push('admin-css')
<link rel="stylesheet" href="{{ asset('css/chat.css') }}">
@endpush

@section('content')
<div class="card chat-card">

    {{-- HEADER --}}
    <div class="card-header bg-dark text-white">
        Revisi: {{ $artwork->judul ?? 'Artwork' }}
    </div>
    <div class="card-header bg-dark text-white">
        Klien : {{ $artwork->member->nama ?? 'Member' }}
    </div>

    {{-- CHAT WRAPPER --}}
    <div class="chat-wrapper">

        {{-- MESSAGE LIST --}}
        <div id="chatBox">
            @foreach ($messages as $msg)
                @php $isMe = $msg->from_id === auth()->id(); @endphp

                @if($msg->deleted_by_sender && $msg->from_id === auth()->id())
                    @continue
                @endif

                <div class="chat-row {{ $isMe ? 'admin' : 'user' }}">
                    <div class="chat-bubble" data-id="{{ $msg->id }}">

                        @if($isMe)
                           <span class="msg-dropdown" data-id="{{ $msg->id }}">⋮</span>
                        @endif

                        @if($msg->deleted_for_all)
                            <em>Pesan ini telah dihapus</em>
                        @else
                            <strong>
                                {{ $isMe ? 'Anda' : ($msg->from->member->nama ?? 'Tim') }}
                            </strong>

                            @if($msg->type === 'text')
                                <p>{{ $msg->message }}</p>

                            @elseif($msg->type === 'image')
                                <img src="{{ asset('storage/'.$msg->file_path) }}"
                                     class="chat-image"
                                     data-src="{{ asset('storage/'.$msg->file_path) }}">
                                @if($msg->message)
                                    <div class="chat-caption">{{ $msg->message }}</div>
                                @endif
                            @endif

                            <div class="chat-time">
                                {{ $msg->created_at->format('H:i') }}
                            </div>
                        @endif

                    </div>
                </div>
            @endforeach
        </div>

        {{-- PREVIEW FILE --}}
        <div id="previewContainer" class="chat-preview d-none">
            <img id="previewImage">
            <video id="previewVideo" controls></video>
            <span id="removePreview">✕</span>
        </div>

        {{-- INPUT --}}
        <div class="chat-input-wrapper">
            <form id="chatForm"
                  method="POST"
                  action="{{ route('artworks.chat.store',$artwork->id) }}"
                  enctype="multipart/form-data"
                  class="chat-form">
                @csrf

                <button type="button" id="emojiBtn" class="chat-btn">😀</button>

                <label class="chat-btn">
                    📎
                    <input type="file" id="fileInput" name="file" hidden>
                </label>

                <input type="text"
                       id="messageInput"
                       name="message"
                       class="chat-textarea"
                       placeholder="Tulis pesan...">

                <button class="chat-btn send">➤</button>
            </form>
        </div>

    </div>
</div>

{{-- ========================= --}}
{{-- 🔥 EMOJI BOX (PINDAH KE SINI) --}}
{{-- ========================= --}}
<div id="emojiBox" class="emoji-box d-none">
    <span>😀</span><span>😁</span><span>😂</span><span>🤣</span>
    <span>😊</span><span>😍</span><span>😎</span><span>😭</span>
    <span>😡</span><span>👍</span><span>👏</span><span>🙏</span>
    <span>🔥</span><span>❤️</span>
</div>

{{-- DELETE MENU --}}
<div id="msgMenu" class="msg-menu d-none">
    <button data-action="me">Hapus untuk saya</button>
    <button data-action="all">Hapus untuk semua</button>
</div>

{{-- IMAGE VIEWER --}}
<div id="imageViewer" class="image-viewer d-none">
    <span id="closeViewer">✕</span>
    <img id="viewerImage">
    <a id="downloadImage" download class="download-btn">⬇ Download</a>
</div>
@endsection

@push('admin-js')
<script src="{{ asset('js/chat.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', initChatFeature);
</script>
@endpush
