<x-guest-layout>
    @if (session('success'))
<div 
    x-data="{ show: true }" 
    x-show="show" 
    x-transition:enter="transition ease-out duration-700"
    x-transition:enter-start="opacity-0 -translate-y-8"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-500"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 -translate-y-8"
    x-init="
        const audio = new Audio('https://cdn.pixabay.com/download/audio/2022/03/15/audio_11f6b6f60b.mp3?filename=notification-3-181850.mp3');
        audio.volume = 0.7;
        // Autoplay fix — tunggu interaksi user bila autoplay diblokir
        audio.play().catch(() => {
            document.addEventListener('click', () => audio.play(), { once: true });
        });
        setTimeout(() => show = false, 10000);
    "
    class="fixed top-10 left-1/2 transform -translate-x-1/2 z-50 w-full flex justify-center"
>
    <div class="bg-white border border-green-400/70 rounded-2xl shadow-2xl shadow-green-200/60 p-6 w-[360px] text-center">
        <div class="flex flex-col items-center">
            <div class="w-14 h-14 bg-green-500 rounded-full flex items-center justify-center shadow-md shadow-green-400 mb-3 animate-pulse">
                <svg xmlns='http://www.w3.org/2000/svg' class='w-8 h-8 text-white' fill='none' viewBox='0 0 24 24' stroke='currentColor' stroke-width='3'>
                    <path stroke-linecap='round' stroke-linejoin='round' d='M5 13l4 4L19 7'/>
                </svg>
            </div>
            <h2 class="text-lg font-bold text-green-700 tracking-wide">Registrasi Berhasil!</h2>
            <p class="text-gray-600 text-sm mt-1">Silakan login untuk melanjutkan.</p>
            <button 
                @click="show = false" 
                class="mt-4 px-4 py-2 text-sm rounded-lg bg-green-500 text-white hover:bg-green-600 shadow-md transition"
            >
                Tutup
            </button>
        </div>
    </div>
</div>
@endif

     
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
    <x-input-label for="email" :value="__('Email')" class="text-white" />

    <x-text-input 
        id="email"
        class="block mt-1 w-full"
        type="email"
        name="email"
        :value="old('email')"
        placeholder="Masukkan email"
        required
        autofocus
        autocomplete="username"
    />

    <x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

       <!-- Password -->
<div class="mt-4" x-data="{ showPassword: false }">
    <x-input-label for="password" :value="__('Password')" class="text-white" />

    <div class="relative mt-1">
        <input 
            id="password"
            name="password"
            x-bind:type="showPassword ? 'text' : 'password'"
            required
            autocomplete="current-password"
            placeholder="Masukkan password"
            class="block w-full h-14 rounded-xl border border-gray-300 bg-white text-black shadow-sm focus:border-indigo-500 focus:ring-indigo-500 pr-14 pl-4"
        >

        <!-- Eye Icon BENAR-BENAR di dalam kotak putih -->
        <button 
            type="button"
            @click="showPassword = !showPassword"
            class="absolute top-1/2 right-4 -translate-y-1/2 flex items-center justify-center text-gray-500 hover:text-cyan-500 transition z-10"
        >
            <!-- Eye Open -->
            <svg 
                x-show="!showPassword"
                x-cloak
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
            >
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5
                    c4.478 0 8.268 2.943 9.542 7
                    -1.274 4.057-5.064 7-9.542 7
                    -4.477 0-8.268-2.943-9.542-7z" />
            </svg>

            <!-- Eye Closed -->
            <svg 
                x-show="showPassword"
                x-cloak
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
            >
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M13.875 18.825A10.05 10.05 0 0112 19
                    c-4.478 0-8.268-2.943-9.542-7
                    a9.956 9.956 0 012.042-3.368M6.223 6.223
                    A9.953 9.953 0 0112 5c4.478 0 8.268 2.943
                    9.542 7a9.97 9.97 0 01-4.132 5.411M15
                    12a3 3 0 11-6 0 3 3 0 016 0zm6 6L3 3" />
            </svg>
        </button>
    </div>

    <x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>

       

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-white hover:text-blue-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
             {{ __('Forgot your password?') }}
        </a>

            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
