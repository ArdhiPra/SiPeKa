@extends('layouts.admin')

@section('title', 'Edit Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
    <h1 class="mb-0">Edit Dashboard</h1>
    <div class="d-none d-md-flex">
        <a href="{{ route('admin.bidang.tambah') }}" class="btn btn-green me-2">
            <i class="bi bi-plus-circle"></i> Tambah Bidang
        </a>
    </div>
    <div class="d-flex d-md-none gap-2 ms-auto">
        <a href="{{ route('admin.magang.create') }}" class="btn btn-green p-2">
            <i class="bi bi-plus-circle fs-5"></i>
        </a>
    </div>
</div>

{{-- RINGKASAN --}}
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body p-4 text-white"
        style="background: linear-gradient(135deg, #0d47a1, #1976d2, #42a5f5); border-radius: 10px;">
        <div class="row text-center">
            <div class="col-6 col-md-3 mb-3 mb-md-0 border-end">
                <div class="small fw-bold mb-1"><i class="bi bi-people-fill me-1"></i> Total Anak Magang</div>
                <div class="display-6 fw-bold">{{ $totalAnak }}</div>
            </div>
            <div class="col-6 col-md-3 mb-3 mb-md-0 border-end">
                <div class="small fw-bold mb-1"><i class="bi bi-box-seam me-1"></i> Jumlah Kuota</div>
                <div class="display-6 fw-bold">{{ $jumlahKuota }}</div>
            </div>
            <div class="col-6 col-md-3 mb-3 mb-md-0 border-end">
                <div class="small fw-bold mb-1"><i class="bi bi-check-circle-fill me-1"></i> Terisi</div>
                <div class="display-6 fw-bold">{{ $terisiTotal }}</div>
            </div>
            <div class="col-6 col-md-3">
                <div class="small fw-bold mb-1"><i class="bi bi-x-circle-fill me-1"></i> Sisa Kuota</div>
                <div class="display-6 fw-bold">{{ $sisaTotal }}</div>
            </div>
        </div>
    </div>
</div>

{{-- KARTU BIDANG - DYNAMIC --}}
@php
    $colors = ['primary', 'success', 'warning', 'info', 'danger', 'secondary'];
    $icons  = ['bi-book', 'bi-broadcast', 'bi-shield-lock', 'bi-bar-chart-line', 'bi-hdd-network', 'bi-folder'];
@endphp

<div class="row g-4">
    @foreach($bidangs as $i => $bidang)
    @php
        $color   = $colors[$i % count($colors)];
        $icon    = $icons[$i % count($icons)];
        $percent = $bidang->kuota > 0 ? ($bidang->terisi / $bidang->kuota) * 100 : 0;
    @endphp
    <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">

                <div class="display-6 text-{{ $color }} mb-2">
                    <i class="bi {{ $icon }}"></i>
                </div>
                <h5 class="card-title fw-bold">{{ $bidang->nama_bidang }}</h5>

                <div class="progress mb-3" style="height: 20px;">
                    <div class="progress-bar bg-{{ $color }}" style="width: {{ $percent }}%;">
                        {{ $bidang->terisi }}/{{ $bidang->kuota }}
                    </div>
                </div>

                <div class="row text-center mb-3">
                    <div class="col">
                        <div class="fw-bold">{{ $bidang->kuota }}</div>
                        <small>Kuota</small>
                    </div>
                    <div class="col">
                        <div class="fw-bold text-success">{{ $bidang->terisi }}</div>
                        <small>Terisi</small>
                    </div>
                    <div class="col">
                        <div class="fw-bold text-danger">{{ $bidang->sisa }}</div>
                        <small>Sisa</small>
                    </div>
                </div>

                {{-- TOMBOL EDIT & HAPUS --}}
                <div class="d-flex justify-content-center gap-2">
                    <a href="{{ route('admin.bidang.edit', $bidang->id) }}"
                       class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>

                    <form action="{{ route('admin.bidang.destroy', $bidang->id) }}"
                        method="POST"
                        class="form-delete">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection