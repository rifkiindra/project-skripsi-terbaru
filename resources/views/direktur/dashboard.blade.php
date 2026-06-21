@extends('layouts.direktur')

@section('content')

<style>

/* ===== Layout Fix (Tidak pakai 100vh) ===== */
.main-dashboard {
    background: #f8fafc;
    padding: 30px 40px;
}

/* ===== Header ===== */
.dashboard-header h2 {
    font-weight: 700;
    color: #1e293b;
}

.dashboard-header p {
    color: #64748b;
}

/* ===== Card ===== */
.stat-card {
    border-radius: 18px;
    padding: 28px;
    color: white;
    transition: 0.3s ease;
    box-shadow: 0 8px 25px rgba(0,0,0,0.06);
}

.stat-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
}

.stat-title {
    font-size: 14px;
    opacity: 0.9;
}

.stat-number {
    font-size: 34px;
    font-weight: 700;
}

/* ===== Warna Corporate ===== */
.bg-total {
    background: linear-gradient(135deg, #2563eb, #3b82f6);
}

.bg-active {
    background: linear-gradient(135deg, #f59e0b, #fbbf24);
}

.bg-complete {
    background: linear-gradient(135deg, #10b981, #34d399);
}

/* ===== Ringkasan ===== */
.summary-box {
    background: white;
    border-radius: 18px;
    padding: 30px;
    margin-top: 35px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.05);
}

.fade-in {
    opacity: 0;
    transform: translateY(20px);
    transition: 0.6s ease;
}

.fade-in.show {
    opacity: 1;
    transform: translateY(0);
}

</style>

<div class="main-dashboard">

    {{-- Header --}}
    <div class="dashboard-header mb-4">
        <h2>Dashboard Direktur</h2>
        <p>Selamat datang, 
            <strong>{{ auth()->user()->nama ?? auth()->user()->name }}</strong>
        </p>
    </div>

    {{-- Statistik --}}
    <div class="row g-4">

        <div class="col-md-4 fade-in">
            <div class="stat-card bg-total">
                <div class="stat-title">Total Project</div>
                <div class="stat-number counter"
                     data-target="{{ $totalProjects ?? 0 }}">0</div>
            </div>
        </div>

        <div class="col-md-4 fade-in">
            <div class="stat-card bg-active">
                <div class="stat-title">Project Berjalan</div>
                <div class="stat-number counter"
                     data-target="{{ $activeProjects ?? 0 }}">0</div>
            </div>
        </div>

        <div class="col-md-4 fade-in">
            <div class="stat-card bg-complete">
                <div class="stat-title">Project Selesai</div>
                <div class="stat-number counter"
                     data-target="{{ $completedProjects ?? 0 }}">0</div>
            </div>
        </div>

    </div>

    {{-- Ringkasan --}}
    <div class="summary-box fade-in">
        <h5 class="fw-bold">Ringkasan Kinerja</h5>
        <p class="text-muted mt-2 mb-0">
            Menampilkan gambaran keseluruhan aktivitas proyek dan progres tim 
            untuk membantu pengambilan keputusan secara strategis.
        </p>
    </div>

</div>

<script>

/* Counter Animation */
document.querySelectorAll('.counter').forEach(counter => {
    const update = () => {
        const target = +counter.getAttribute('data-target');
        const current = +counter.innerText;
        const increment = target / 60;

        if(current < target){
            counter.innerText = Math.ceil(current + increment);
            setTimeout(update, 15);
        } else {
            counter.innerText = target;
        }
    };
    update();
});

/* Fade Animation */
window.addEventListener('load', () => {
    document.querySelectorAll('.fade-in').forEach((el, index) => {
        setTimeout(() => el.classList.add('show'), index * 150);
    });
});

</script>

@endsection