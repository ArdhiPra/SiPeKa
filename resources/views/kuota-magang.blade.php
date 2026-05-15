@extends('layouts.guest')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid my-4 ps-md-4">

    <div class="page-header">
        <h2>Dashboard</h2>
    </div>

    {{-- ======================== --}}
    {{-- SUMMARY STATISTICS BAR  --}}
    {{-- ======================== --}}
    <div class="row g-3 mt-4 mb-4">

        <div class="col-md-4">
            <div class="info-card shadow-sm d-flex align-items-center p-3">
                <div class="icon-wrap bg-primary bg-opacity-10 text-primary">
                    <i class="bi bi-people"></i>
                </div>
                <div class="ms-3">
                    <small class="text-muted">Total Peserta</small>
                    <h5 class="m-0 fw-bold">{{ $totalPeserta }}</h5>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="info-card shadow-sm d-flex align-items-center p-3">
                <div class="icon-wrap bg-success bg-opacity-10 text-success">
                    <i class="bi bi-person-check"></i>
                </div>
                <div class="ms-3">
                    <small class="text-muted">Peserta Aktif</small>
                    <h5 class="m-0 fw-bold">{{ $pesertaAktif }}</h5>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="info-card shadow-sm d-flex align-items-center p-3">
                <div class="icon-wrap bg-warning bg-opacity-10 text-warning">
                    <i class="bi bi-box"></i>
                </div>
                <div class="ms-3">
                    <small class="text-muted">Sisa Kuota</small>
                    <h5 class="m-0 fw-bold">{{ $bidangs->sum('sisa') }}</h5>
                </div>
            </div>
        </div>

    </div>

    {{-- ======================== --}}
    {{-- KARTU + CHART           --}}
    {{-- ======================== --}}

    {{-- Definisi warna gradient per index, otomatis cycling --}}
    @php
        $gradients = [
            'linear-gradient(135deg,#3b82f6,#06b6d4)',
            'linear-gradient(135deg,#6366f1,#8b5cf6)',
            'linear-gradient(135deg,#f59e0b,#fbbf24)',
            'linear-gradient(135deg,#10b981,#34d399)',
            'linear-gradient(135deg,#ef4444,#f87171)',
            'linear-gradient(135deg,#ec4899,#f472b6)',
            'linear-gradient(135deg,#14b8a6,#2dd4bf)',
        ];
    @endphp

    <div class="row g-4">

        {{-- CARD KIRI — Dynamic --}}
        <div class="col-md-6">
            <div class="row g-4">
                @foreach($bidangs as $index => $bidang)
                    {{-- Card terakhir (jika ganjil) full width --}}
                    @php
                        $isLast = $loop->last && ($bidangs->count() % 2 !== 0);
                        $colClass = $isLast ? 'col-12' : 'col-6 col-md-6';
                        $gradient = $gradients[$index % count($gradients)];
                    @endphp

                    <div class="{{ $colClass }}">
                        <div class="grad-card" style="background: {{ $gradient }}">
                            <div class="grad-title">{{ $bidang->nama_bidang }}</div>
                            <div class="grad-value">{{ $bidang->terisi }}</div>
                            <div class="grad-info">
                                Kuota: {{ $bidang->kuota }} <br>
                                Sisa : {{ $bidang->sisa }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- CHART KANAN — Dynamic --}}
        <div class="col-md-6">
            <div class="p-3 shadow-sm" style="border-radius: 20px; background:white; height: 340px;">
                <div class="d-flex justify-content-between mb-2">
                    <h5 class="fw-bold mb-0">Kuota Terisi per Bidang</h5>
                </div>
                <canvas id="activityChart" style="height: 260px;"></canvas>
            </div>
        </div>

    </div>

</div>

{{-- CSS --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<style>
    .info-card {
        border-radius: 14px;
        background: white;
        transition: 0.2s ease;
    }
    .info-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 16px rgba(0,0,0,0.08);
    }
    .icon-wrap {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 22px;
    }
    .grad-card {
        border-radius: 18px;
        padding: 18px 20px;
        color: #fff;
        box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        transition: .25s;
    }
    .grad-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 14px 32px rgba(0,0,0,0.20);
    }
    .grad-title { font-size: 14px; opacity: .9; }
    .grad-value { font-size: 30px; font-weight: bold; }
    .grad-info  { font-size: 13px; opacity: .85; }
</style>

{{-- CHART JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById("activityChart").getContext("2d");

    // ✅ Data dari database, bukan hardcode
    const labels   = @json($bidangs->pluck('nama_bidang'));
    const dataTerisi = @json($bidangs->pluck('terisi'));

    let gradient = ctx.createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, "rgba(99,102,241,0.8)");
    gradient.addColorStop(1, "rgba(99,102,241,0.15)");

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: labels,
            datasets: [{
                data: dataTerisi,
                backgroundColor: gradient,
                borderRadius: 10,
                barThickness: 40
            }]
        },
        options: {
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: "#fff",
                    titleColor: "#000",
                    bodyColor: "#000",
                    borderWidth: 1,
                    borderColor: "#e5e7eb",
                    displayColors: false,
                    padding: 10
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 13 }, color: "#333" }
                },
                y: {
                    beginAtZero: true,
                    grid: { color: "rgba(0,0,0,0.05)" },
                    ticks: { font: { size: 12 }, color: "#666" }
                }
            },
            animation: { duration: 900, easing: "easeOutQuart" }
        }
    });
</script>

@endsection