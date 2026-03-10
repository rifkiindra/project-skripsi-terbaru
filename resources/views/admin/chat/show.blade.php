{{-- HEADER CHAT --}}
<div class="card h-100 d-flex flex-column">

    <div class="card-header bg-dark text-white">
        Chat dengan {{ $user->name }}
    </div>

    {{-- CHAT BODY --}}
<div class="chat-wrapper flex-grow-1" id="chatBox">
@foreach ($messages as $msg)

    @php
    $isAdmin = $msg->from_id === auth()->id();
    $sender  = $msg->sender;

    if ($sender && $sender->profile_photo_url) {
        // karena DB sudah /storage/profile/xxx.jpg
        $photo = asset($sender->profile_photo_url);
    } else {
        $photo = asset('images/avatar-default.jpg');
    }
@endphp


    <div class="chat-row {{ $isAdmin ? 'chat-right' : 'chat-left' }}">

        {{-- FOTO PROFIL --}}
        <img src="{{ $photo }}" class="chat-avatar">

        {{-- BUBBLE --}}
        <div class="chat-bubble {{ $isAdmin ? 'bubble-admin' : 'bubble-user' }}"
             data-id="{{ $msg->id }}">

            @if ($msg->type === 'text')
                {{ $msg->message }}

            @elseif ($msg->type === 'image')
                <img src="{{ asset('storage/'.$msg->file_path) }}" class="chat-media">

            @elseif ($msg->type === 'video')
                <video controls class="chat-media">
                    <source src="{{ asset('storage/'.$msg->file_path) }}">
                </video>

            @else
                <a href="{{ asset('storage/'.$msg->file_path) }}" target="_blank">📄 File</a>
            @endif

            <div class="chat-time">
                {{ $msg->created_at->format('H:i') }}
                @if($isAdmin)
                    <i class="fas fa-check-double text-info ms-1"></i>
                @endif
            </div>
        </div>

    </div>

@endforeach
</div>

    {{-- PREVIEW --}}
<div id="previewContainer" class="chat-preview d-none">
    <img id="previewImage" class="d-none">
    <video id="previewVideo" class="d-none" controls></video>
    <span id="removePreview">✕</span>
</div>

{{-- EMOJI --}}
<div id="emojiBox" class="emoji-box d-none">
    <span>😀</span><span>😁</span><span>😂</span><span>🤣</span>
    <span>😊</span><span>😍</span><span>😎</span><span>😭</span>
    <span>😡</span><span>👍</span><span>👏</span><span>🙏</span>
    <span>🔥</span><span>❤️</span>
</div>

{{-- INPUT --}}
<div class="chat-input-wrapper">
<form id="chatForm"
      method="POST"
      action="{{ route('admin.chat.send', $user) }}"
      enctype="multipart/form-data"
      class="chat-form">
    @csrf

    <button type="button" id="emojiBtn" class="chat-btn">😀</button>

    <label class="chat-btn">
        📎
        <input type="file"
               id="fileInput"
               name="file"
               hidden
               accept="image/*,video/*">
    </label>

    <textarea id="messageInput"
          name="message"
          class="chat-textarea"
          placeholder="Tulis pesan..."
          rows="1"></textarea>

    <button type="submit" class="chat-btn send">➤</button>
</form>
</div>
</div>

<script>
    const chatBox = document.getElementById('chatBox');
    if (chatBox) chatBox.scrollTop = chatBox.scrollHeight;
</script>
