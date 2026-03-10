@extends('layouts.adminlte')

@section('title', 'Chat Member')

@push('admin-css')
<link rel="stylesheet" href="{{ asset('admin/css/chat.css') }}">
@endpush

@section('content')
<div class="admin-chat">

    {{-- LEFT : USER LIST --}}
    <div class="user-list">

        {{-- SEARCH --}}
        <input
            type="text"
            id="userSearch"
            class="form-control m-2"
            placeholder="Cari user..."
        >

        {{-- USERS --}}
        @foreach ($users as $user)
    @php
        $msg = $user->lastMessageWithAdmin(auth()->id());

        $avatar = !empty($user->profile_photo_url)
            ? asset($user->profile_photo_url)
            : asset('images/avatar-default.jpg');
    @endphp

    <div
        class="chat-item {{ $user->unread_count > 0 ? 'unread' : '' }}"
        onclick="openChat({{ $user->id }}, this)"
    >

        {{-- AVATAR --}}
        <div class="chat-avatar">
            <img src="{{ $avatar }}" alt="{{ $user->name }}">
        </div>

        {{-- CONTENT --}}
        <div class="chat-content">

            {{-- ROW 1 : NAME + TIME --}}
            <div class="chat-row-top">
                <span class="chat-name">{{ $user->name }}</span>

                @if ($msg)
                    <span class="chat-time">
                        {{ chatTime($msg->created_at) }}
                    </span>
                @endif
            </div>

            {{-- ROW 2 : LAST MESSAGE + BADGE --}}
            <div class="chat-row-bottom">
                <span class="chat-preview">
                    @if ($msg)
                        {{ Str::limit($msg->message ?? '[File]', 40) }}
                    @else
                        <span class="text-muted">Belum ada pesan</span>
                    @endif
                </span>

                @if ($user->unread_count > 0)
                    <span class="chat-badge">
                        {{ $user->unread_count }}
                    </span>
                @endif
            </div>

        </div>
    </div>
@endforeach


    </div>

    {{-- RIGHT : CHAT PANEL --}}
    <div class="chat-wrapper" id="chatWrapper">
        <div class="empty-chat">
            <div class="empty-inner">

                <div class="empty-icon">💬</div>

                <h4>Selamat datang di Admin Chat</h4>

                <p>
                    Pilih user atau member di sebelah kiri<br>
                    untuk mulai percakapan.
                </p>

                <span class="empty-hint">
                    Pesan akan tampil di sini
                </span>

            </div>
        </div>
    </div>

</div>
@endsection

@push('admin-js')
<script src="{{ asset('admin/js/chat.js') }}"></script>
@endpush
