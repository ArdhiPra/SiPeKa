@extends('layouts.user')

@section('title', 'Pengajuan Magang')

@section('content')
<div class="container mt-4">
    <h4>Pengajuan Magang</h4>

    <form action="{{ route('user.pengajuan.magang.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- AUTO FILL --}}
        <div class="mb-3">
            <label>Nama Lengkap</label>
            <input type="text" class="form-control" value="{{ $profil->nama_lengkap }}" readonly>
        </div>

        <div class="mb-3">
            <label>NIM / NISN</label>
            <input type="text" class="form-control" value="{{ $profil->nomor_induk ?? '-' }}" readonly>
        </div>

        {{-- INPUT --}}
        <div class="mb-3">
            <label>Tingkat</label>
            @if($profil->tingkat)
                {{-- Tampilkan sebagai teks readonly, kirim via hidden input --}}
                <input type="text" class="form-control" value="{{ $profil->tingkat }}" readonly>
                <input type="hidden" name="tingkat" value="{{ $profil->tingkat }}">
            @else
        {{-- Fallback: pilih manual kalau profil belum diisi --}}
        <select name="tingkat" class="form-control" required>
            <option value="">-- Pilih Tingkat --</option>
            <option value="SMA/SMK">SMA/SMK</option>
            <option value="D3">D3</option>
            <option value="D4">D4</option>
            <option value="S1">S1</option>
            <option value="S2">S2</option>
        </select>
        <small class="text-danger">Lengkapi profil kamu agar terisi otomatis.</small>
    @endif
</div>

        <div class="mb-3">
            <label>Bidang Penempatan</label>
            <select name="bidang_id" class="form-control" required>
                <option value="">-- Pilih Bidang --</option>
                @foreach($bidangs as $bidang)
                    <option value="{{ $bidang->id }}">
                        {{ $bidang->nama_bidang }} (Kuota: {{ $bidang->kuota }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Upload Surat Lamaran</label>
            <input type="file" name="file_pengajuan" class="form-control" 
                accept=".pdf" required>
            <small class="text-muted">Format file: PDF (maks. 2MB)</small>
        </div>

        <button class="btn btn-primary">Kirim Pengajuan</button>
    </form>
</div>
@endsection