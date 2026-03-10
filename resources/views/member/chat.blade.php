@extends('layouts.member')

@section('title', 'Chat Admin')

@section('content')

<div class="chat-wrapper">

    {{-- HEADER --}}
    <div class="chat-header">
        <div class="avatar">A</div>
        <div>
            <div class="name">Admin</div>
            <div class="status">Online</div>
        </div>
    </div>

    {{-- CHAT BODY --}}
    <div class="chat-body" id="chatBody">
        @forelse ($messages as $msg)
            <div class="chat-row {{ $msg->from_id == auth()->id() ? 'me' : 'other' }}">
                <div class="bubble">

                    @if ($msg->type === 'text')
                        {!! nl2br(e($msg->message)) !!}

                    @elseif ($msg->type === 'image')
                        <img src="{{ asset('storage/'.$msg->file_path) }}"
                             class="chat-image"
                             onclick="openImage(this.src)">

                    @elseif ($msg->type === 'video')
                        <video controls class="chat-video">
                            <source src="{{ asset('storage/'.$msg->file_path) }}">
                        </video>
                    @endif

                    <div class="time">{{ $msg->created_at->format('H:i') }}</div>
                </div>
            </div>
        @empty
            <div class="empty-chat">👋 Mulai percakapan</div>
        @endforelse
    </div>

    {{-- PREVIEW --}}
    <div class="preview-box" id="previewBox">
        <span class="close-preview" onclick="clearPreview()">✕</span>
        <img id="imgPreview">
        <video id="videoPreview" controls></video>
    </div>

    {{-- EMOJI --}}
    <div class="emoji-box" id="emojiBox">
        <span onclick="addEmoji('😀')">😀</span>
        <span onclick="addEmoji('😂')">😂</span>
        <span onclick="addEmoji('😍')">😍</span>
        <span onclick="addEmoji('🔥')">🔥</span>
        <span onclick="addEmoji('👍')">👍</span>
        <span onclick="addEmoji('🙏')">🙏</span>
    </div>

    {{-- INPUT --}}
    <form action="{{ route('member.chat.send') }}"
          method="POST"
          enctype="multipart/form-data"
          class="chat-input">
        @csrf

        <input type="hidden" name="type" id="chatType" value="text">
        <input type="file" name="file" id="fileInput" hidden>

        <button type="button" onclick="toggleEmoji()">😊</button>
        <button type="button" onclick="pickImage()">📷</button>
        <button type="button" onclick="pickVideo()">🎥</button>

        <input type="text" name="message" id="messageInput" placeholder="Tulis pesan...">

        <button type="submit">➤</button>
    </form>

</div>

{{-- IMAGE MODAL --}}
<div class="image-modal" id="imageModal" onclick="closeImage()">
    <img id="modalImage">
</div>

@endsection
