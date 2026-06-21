<section id="studio-overview" class="relative w-full h-[140vh] overflow-hidden">

    {{-- VIDEO BACKGROUND --}}
    <video 
        src="{{ asset('videos/hhh.mp4') }}" 
        autoplay 
        muted 
        loop 
        playsinline
        id="studioVideo"
        class="absolute top-1/2 left-1/2 min-w-full min-h-full object-cover -translate-x-1/2 -translate-y-1/2 transition-all duration-[1200ms] ease-out"
    ></video>

    {{-- OVERLAY GRADIENT + DARKEN --}}
    <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/30 to-black/90"></div>

    {{-- TEXT CONTENT --}}
    <div class="relative z-20 flex flex-col items-center justify-center h-full text-center px-6">
        <h2 class="text-white text-6xl font-bold tracking-wide drop-shadow-2xl">
            THE STUDIO
        </h2>
        <p class="text-white/80 text-xl mt-6 max-w-3xl">
            Where art, engineering, and storytelling form a single creative engine.
        </p>
    </div>

</section>

{{-- SCROLL EFFECT --}}
<script>
    document.addEventListener("scroll", () => {
        const video = document.getElementById("studioVideo");
        const scrollY = window.scrollY;

        // Semakin di-scroll → semakin besar
        const scale = 1 + (scrollY * 0.0009);
        video.style.transform = `translate(-50%, -50%) scale(${scale})`;
    });
</script>
