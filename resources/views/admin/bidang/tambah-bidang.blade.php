@extends('layouts.admin')

@section('title', 'Tambah Bidang')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<div class="container my-4">
    <div class="card shadow-sm">
        
        {{-- Header --}}
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="bi bi-plus-circle"></i> Tambah Bidang
            </h5>
        </div>

        {{-- Body --}}
        <div class="card-body">

            {{-- Error --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.bidang.store') }}" method="POST">
                @csrf

                {{-- Nama Bidang --}}
                <div class="mb-3">
                    <label class="form-label">Nama Bidang</label>
                    <input type="text" name="nama_bidang" class="form-control" 
                           value="{{ old('nama_bidang') }}" required>
                </div>

                {{-- Kuota --}}
                <div class="mb-3">
                    <label class="form-label">Kuota</label>
                    <input type="number" name="kuota" class="form-control" 
                           value="{{ old('kuota') }}" required>
                </div>

                {{-- Icon --}}
                <div class="mb-3">
                   <label>Icon <small class="text-muted">(Bootstrap Icons)</small></label>
    <select name="icon" class="form-control" required>
        <option value="bi-folder">📁 Folder (Default)</option>
        <option value="bi-book">📚 Book</option>
        <option value="bi-broadcast">📡 Broadcast</option>
        <option value="bi-shield-lock">🛡️ Shield Lock</option>
        <option value="bi-bar-chart-line">📊 Bar Chart</option>
        <option value="bi-hdd-network">🖥️ HDD Network</option>
        <option value="bi-people">👥 People</option>
        <option value="bi-gear">⚙️ Gear</option>
        <option value="bi-clipboard-data">📋 Clipboard</option>
    </select>
                </div>

                {{-- Warna --}}
                <div class="mb-3">
                    <label>Warna</label>
    <select name="warna" class="form-control" required>
        <option value="primary">🔵 Biru</option>
        <option value="success">🟢 Hijau</option>
        <option value="warning">🟡 Kuning</option>
        <option value="danger">🔴 Merah</option>
        <option value="info">🩵 Info</option>
        <option value="secondary">⚫ Abu-abu</option>
    </select>
                </div>

                {{-- Action --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection