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
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-white" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center" >
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-blue-600">{{ __('Remember me') }}</span>
            </label>
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
