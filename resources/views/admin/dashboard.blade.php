@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h4 class="mb-0 fw-bold">Dashboard Admin</h4>
        <small class="text-muted">Ringkasan data magang aktif</small>
    </div>
    <div class="d-none d-md-flex gap-2">
        <a href="{{ route('admin.magang.create') }}" class="btn btn-green">
            <i class="bi bi-plus-circle"></i> Tambah Data
        </a>
        <a href="{{ route('admin.edit.index') }}" class="btn btn-yellow">
            <i class="bi bi-pencil-square"></i> Edit Data
        </a>
    </div>
    <div class="d-flex d-md-none gap-2 ms-auto">
        <a href="{{ route('admin.magang.create') }}" class="btn btn-green p-2">
            <i class="bi bi-plus-circle fs-5"></i>
        </a>
        <a href="{{ route('admin.edit.index') }}" class="btn btn-yellow p-2">
            <i class="bi bi-pencil-square fs-5"></i>
        </a>
    </div>
</div>

{{-- RINGKASAN --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #1976d2 !important;">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                     style="width:48px;height:48px;background:#e3f0ff;flex-shrink:0;">
                    <i class="bi bi-people-fill text-primary fs-5"></i>
                </div>
                <div>
                    <div class="small text-muted fw-semibold">Total Magang</div>
                    <div class="fs-3 fw-bold lh-1">{{ $totalAnak }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #388e3c !important;">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                     style="width:48px;height:48px;background:#e8f5e9;flex-shrink:0;">
                    <i class="bi bi-box-seam text-success fs-5"></i>
                </div>
                <div>
                    <div class="small text-muted fw-semibold">Jumlah Kuota</div>
                    <div class="fs-3 fw-bold lh-1">{{ $jumlahKuota }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #f9a825 !important;">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                     style="width:48px;height:48px;background:#fffde7;flex-shrink:0;">
                    <i class="bi bi-check-circle-fill text-warning fs-5"></i>
                </div>
                <div>
                    <div class="small text-muted fw-semibold">Terisi</div>
                    <div class="fs-3 fw-bold lh-1">{{ $terisiTotal }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #d32f2f !important;">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                     style="width:48px;height:48px;background:#ffebee;flex-shrink:0;">
                    <i class="bi bi-x-circle-fill text-danger fs-5"></i>
                </div>
                <div>
                    <div class="small text-muted fw-semibold">Sisa Kuota</div>
                    <div class="fs-3 fw-bold lh-1">{{ $sisaTotal }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- KARTU BIDANG --}}
<h6 class="fw-bold text-muted mb-3 text-uppercase" style="letter-spacing:.06em;font-size:11px;">
    Bidang Penempatan
</h6>

<div class="row g-4">
    @forelse($bidangs as $bidang)
    @php
        $percent = $bidang->kuota > 0 ? ($bidang->terisi / $bidang->kuota) * 100 : 0;
        $warna   = $bidang->warna ?? 'secondary';
        $icon    = $bidang->icon  ?? 'bi-folder';
    @endphp
    <div class="col-md-4 col-sm-6">
        <div class="card border-0 shadow-sm h-100" 
             style="border-top: 3px solid var(--bs-{{ $warna }}) !important; transition: transform .2s;"
             onmouseover="this.style.transform='translateY(-4px)'"
             onmouseout="this.style.transform='translateY(0)'">
            <div class="card-body">

                {{-- HEADER KARTU --}}
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center text-{{ $warna }}"
                         style="width:46px;height:46px;background:rgba(var(--bs-{{ $warna }}-rgb),.1);flex-shrink:0;">
                        <i class="bi {{ $icon }} fs-5"></i>
                    </div>
                    <div>
                        <div class="fw-bold">{{ $bidang->nama_bidang }}</div>
                        <small class="text-muted">{{ $bidang->terisi }} dari {{ $bidang->kuota }} terisi</small>
                    </div>
                </div>

                {{-- PROGRESS --}}
                <div class="progress mb-3" style="height:8px;border-radius:10px;">
                    <div class="progress-bar bg-{{ $warna }}" 
                         role="progressbar"
                         style="width:{{ $percent }}%;border-radius:10px;"
                         title="{{ round($percent) }}%">
                    </div>
                </div>

                {{-- STAT ROW --}}
                <div class="row text-center g-0 mb-3">
                    <div class="col border-end">
                        <div class="fw-bold fs-5">{{ $bidang->kuota }}</div>
                        <div class="small text-muted">Kuota</div>
                    </div>
                    <div class="col border-end">
                        <div class="fw-bold fs-5 text-success">{{ $bidang->terisi }}</div>
                        <div class="small text-muted">Terisi</div>
                    </div>
                    <div class="col">
                        <div class="fw-bold fs-5 text-danger">{{ $bidang->sisa }}</div>
                        <div class="small text-muted">Sisa</div>
                    </div>
                </div>
                {{-- LIHAT DETAIL --}}
                <a href="{{ route('admin.bidang.show', $bidang->slug) }}" 
                    class="btn btn-outline-{{ $warna }} btn-sm w-100">
                    <i class="bi bi-eye"></i> Lihat Detail
                </a>
            </div>
        </div>
    </div>

    @empty
    <div class="col-12 text-center py-5 text-muted">
        <i class="bi bi-inbox fs-1 d-block mb-2"></i>
        Belum ada bidang. <a href="{{ route('admin.magang.create') }}">Tambah sekarang</a>
    </div>
    @endforelse
</div>

@endsection