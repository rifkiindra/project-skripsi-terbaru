<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Chat')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSS CHAT MEMBER --}}
    <link rel="stylesheet" href="{{ asset('css/chat-user.css') }}">
</head>
<body class="chat-user-page">

    {{-- CONTENT CHAT --}}
    @yield('content')

    {{-- JS CHAT MEMBER --}}
    <script src="{{ asset('js/chat-user.js') }}"></script>

    {{-- IMAGE MODAL SCRIPT --}}
    <script>
        function openImage(src) {
            const modal = document.getElementById('imageModal');
            const img = document.getElementById('modalImage');
            img.src = src;
            modal.style.display = 'flex';
        }

        function closeImage() {
            document.getElementById('imageModal').style.display = 'none';
        }
    </script>

</body>
</html>
