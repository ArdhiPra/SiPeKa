@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
    <h1 class="mb-0">Dashboard Admin</h1>

    <!-- Tombol Desktop -->
    <div class="d-none d-md-flex">
        <a href="{{ route('admin.magang.create') }}" class="btn btn-green me-2">
            <i class="bi bi-plus-circle"></i> Tambah Data
        </a>
        <a href="{{ route('admin.edit.index') }}" class="btn btn-yellow">
            <i class="bi bi-pencil-square"></i> Edit Data
        </a>
    </div>

    <!-- Tombol Mobile (ikon saja di kanan atas) -->
    <div class="d-flex d-md-none gap-2 ms-auto">
        <a href="{{ route('admin.magang.create') }}" class="btn btn-green p-2">
            <i class="bi bi-plus-circle fs-5"></i>
        </a>
        <a href="{{ route('admin.edit.index') }}" class="btn btn-yellow p-2">
            <i class="bi bi-pencil-square fs-5"></i>
        </a>
    </div>
</div>

        <!-- Ringkasan -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4 text-white" 
            style="background: linear-gradient(135deg, #0d47a1, #1976d2, #42a5f5); 
                    color: #fff; 
                    border-radius: 10px;">
            <div class="row text-center">
            <!-- Jumlah Anak Magang -->
                <div class="col-6 col-md-3 mb-3 mb-md-0 border-end">
                    <div class="small fw-bold mb-1">
                        <i class="bi bi-people-fill me-1"></i> Total Anak Magang
                    </div>
                    <div class="display-6 fw-bold">{{ $totalAnak }}</div>
                </div>
            <!-- Jumlah Kuota -->
                <div class="col-6 col-md-3 mb-3 mb-md-0 border-end hide-border-mobile">
                    <div class="small fw-bold mb-1">
                        <i class="bi bi-box-seam me-1"></i> Jumlah Kuota
                    </div>
                    <div class="display-6 fw-bold">{{ $jumlahKuota }}</div>
                </div>
            <!-- Terisi -->
                <div class="col-6 col-md-3 mb-3 mb-md-0 border-end">
                    <div class="small fw-bold mb-1">
                        <i class="bi bi-check-circle-fill me-1"></i> Terisi
                    </div>
                    <div class="display-6 fw-bold">{{ $terisiTotal }}</div>
                </div>
            <!-- Sisa Kuota -->
                <div class="col-6 col-md-3">
                    <div class="small fw-bold mb-1">
                        <i class="bi bi-x-circle-fill me-1"></i> Sisa Kuota
                    </div>
                    <div class="display-6 fw-bold">{{ $sisaTotal }}</div>
                </div>
            </div>
        </div>
    </div>

        <!-- Bidang -->
        <div class="row g-4">
            <!-- Sekretariat -->
            @php 
                $sekretariat = $bidangs->firstWhere('nama_bidang', 'Sekretariat'); 
            @endphp
            @if($sekretariat)
            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center">
                        <div class="display-6 text-primary mb-2"><i class="bi bi-book"></i></div>
                        <h5 class="card-title fw-bold">Bidang Sekretariat</h5>
                        @php $percent = $sekretariat->kuota > 0 ? ($sekretariat->terisi / $sekretariat->kuota) * 100 : 0; @endphp
                        <div class="progress mb-3" style="height: 20px;">
                            <div class="progress-bar bg-primary" style="width: {{ $percent }}%;">
                                {{ $sekretariat->terisi }}/{{ $sekretariat->kuota }}
                            </div>
                        </div>
                        <div class="row text-center mb-3">
                            <div class="col"><div class="fw-bold">{{ $sekretariat->kuota }}</div><small>Jumlah Kuota</small></div>
                            <div class="col"><div class="fw-bold text-success">{{ $sekretariat->terisi }}</div><small>Terisi</small></div>
                            <div class="col"><div class="fw-bold text-danger">{{ $sekretariat->sisa }}</div><small>Sisa</small></div>
                        </div>
                        <a href="{{ route('admin.sekretariat') }}" class="btn btn-outline-primary btn-sm">Lihat Detail</a>
                    </div>
                </div>
            </div>
            @endif

            <!-- TIK -->
            @php $tik = $bidangs->firstWhere('nama_bidang', 'TIK'); @endphp
            @if($tik)
            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center">
                        <div class="display-6 text-success mb-2"><i class="bi bi-broadcast"></i></div>
                        <h5 class="card-title fw-bold">Bidang TIK</h5>
                        @php $percent = $tik->kuota > 0 ? ($tik->terisi / $tik->kuota) * 100 : 0; @endphp
                        <div class="progress mb-3" style="height: 20px;">
                            <div class="progress-bar bg-success" style="width: {{ $percent }}%;">
                                {{ $tik->terisi }}/{{ $tik->kuota }}
                            </div>
                        </div>
                        <div class="row text-center mb-3">
                            <div class="col"><div class="fw-bold">{{ $tik->kuota }}</div><small>Jumlah Kuota</small></div>
                            <div class="col"><div class="fw-bold text-success">{{ $tik->terisi }}</div><small>Terisi</small></div>
                            <div class="col"><div class="fw-bold text-danger">{{ $tik->sisa }}</div><small>Sisa</small></div>
                        </div>
                        <a href="{{ route('admin.tik') }}" class="btn btn-outline-success btn-sm">Lihat Detail</a>
                    </div>
                </div>
            </div>
            @endif

            <!-- Persandian -->
            @php $persandian = $bidangs->firstWhere('nama_bidang', 'Persandian'); @endphp
            @if($persandian)
            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center">
                        <div class="display-6 text-warning mb-2"><i class="bi bi-shield-lock"></i></div>
                        <h5 class="card-title fw-bold">Bidang Persandian</h5>
                        @php $percent = $persandian->kuota > 0 ? ($persandian->terisi / $persandian->kuota) * 100 : 0; @endphp
                        <div class="progress mb-3" style="height: 20px;">
                            <div class="progress-bar bg-warning" style="width: {{ $percent }}%;">
                                {{ $persandian->terisi }}/{{ $persandian->kuota }}
                            </div>
                        </div>
                        <div class="row text-center mb-3">
                            <div class="col"><div class="fw-bold">{{ $persandian->kuota }}</div><small>Jumlah Kuota</small></div>
                            <div class="col"><div class="fw-bold text-success">{{ $persandian->terisi }}</div><small>Terisi</small></div>
                            <div class="col"><div class="fw-bold text-danger">{{ $persandian->sisa }}</div><small>Sisa</small></div>
                        </div>
                        <a href="{{ route('admin.persandian') }}" class="btn btn-outline-warning btn-sm">Lihat Detail</a>
                    </div>
                </div>
            </div>
            @endif

            <!-- Statistik -->
            @php $statistik = $bidangs->firstWhere('nama_bidang', 'Statistik'); @endphp
            @if($statistik)
            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center">
                        <div class="display-6 text-info mb-2"><i class="bi bi-bar-chart-line"></i></div>
                        <h5 class="card-title fw-bold">Bidang Statistik</h5>
                        @php $percent = $statistik->kuota > 0 ? ($statistik->terisi / $statistik->kuota) * 100 : 0; @endphp
                        <div class="progress mb-3" style="height: 20px;">
                            <div class="progress-bar bg-info" style="width: {{ $percent }}%;">
                                {{ $statistik->terisi }}/{{ $statistik->kuota }}
                            </div>
                        </div>
                        <div class="row text-center mb-3">
                            <div class="col"><div class="fw-bold">{{ $statistik->kuota }}</div><small>Jumlah Kuota</small></div>
                            <div class="col"><div class="fw-bold text-success">{{ $statistik->terisi }}</div><small>Terisi</small></div>
                            <div class="col"><div class="fw-bold text-danger">{{ $statistik->sisa }}</div><small>Sisa</small></div>
                        </div>
                        <a href="{{ route('admin.statistik') }}" class="btn btn-outline-info btn-sm">Lihat Detail</a>
                    </div>
                </div>
            </div>
            @endif

            <!-- PIKP -->
            @php $pikp = $bidangs->firstWhere('nama_bidang', 'PIKP'); @endphp
            @if($pikp)
            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center">
                        <div class="display-6 text-danger mb-2"><i class="bi bi-hdd-network"></i></div>
                        <h5 class="card-title fw-bold">Bidang PIKP</h5>
                        @php $percent = $pikp->kuota > 0 ? ($pikp->terisi / $pikp->kuota) * 100 : 0; @endphp
                        <div class="progress mb-3" style="height: 20px;">
                            <div class="progress-bar bg-danger" style="width: {{ $percent }}%;">
                                {{ $pikp->terisi }}/{{ $pikp->kuota }}
                            </div>
                        </div>
                        <div class="row text-center mb-3">
                            <div class="col"><div class="fw-bold">{{ $pikp->kuota }}</div><small>Jumlah Kuota</small></div>
                            <div class="col"><div class="fw-bold text-success">{{ $pikp->terisi }}</div><small>Terisi</small></div>
                            <div class="col"><div class="fw-bold text-danger">{{ $pikp->sisa }}</div><small>Sisa</small></div>
                        </div>
                        <a href="{{ route('admin.pikp') }}" class="btn btn-outline-danger btn-sm">Lihat Detail</a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection
