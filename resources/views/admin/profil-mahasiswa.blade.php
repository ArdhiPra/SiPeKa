@extends('layouts.admin')

@section('title', 'Profil Mahasiswa')

@section('content')

<style>
    .profile-card {
        background: #fff;
        border-radius: 14px;
        padding: 24px;
    }

    .profile-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #111827;
    }

    .profile-section {
        margin-top: 24px;
    }

    .profile-section h6 {
        font-size: 0.85rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 16px;
    }

    .form-label {
        font-size: 0.75rem;
        color: #6b7280;
        margin-bottom: 4px;
    }

    .form-control[readonly] {
        background-color: #f9fafb;
        border: 1px solid #e5e7eb;
        font-size: 0.85rem;
        border-radius: 8px;
    }
</style>

<div class="container my-4">

    <div class="profile-card shadow-sm">

        <div class="profile-title mb-3">
            Profil Mahasiswa
        </div>

        {{-- DATA PRIBADI --}}
        <div class="profile-section">
            <h6>Informasi Pribadi</h6>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" value="{{ $mahasiswa->nama_lengkap }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Nomor Induk</label>
                    <input type="text" class="form-control" value="{{ $mahasiswa->nomor_induk ?? '-' }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control" value="{{ $mahasiswa->email ?? '-' }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label">No Handphone</label>
                    <input type="text" class="form-control" value="{{ $mahasiswa->no_hp ?? '-' }}" readonly>
                </div>

                <div class="col-md-12">
                    <label class="form-label">Alamat Domisili</label>
                    <input type="text" class="form-control" value="{{ $mahasiswa->alamat_domisili ?? '-' }}" readonly>
                </div>
            </div>
        </div>

        {{-- DATA AKADEMIK --}}
        <div class="profile-section">
            <h6>Informasi Akademik</h6>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Asal Instansi</label>
                    <input type="text" class="form-control" value="{{ $mahasiswa->asal_instansi ?? '-' }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Program Studi</label>
                    <input type="text" class="form-control" value="{{ $mahasiswa->program_studi ?? '-' }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Tingkat</label>
                    <input type="text" class="form-control" value="{{ $mahasiswa->tingkat ?? '-' }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Unit Penempatan</label>
                    <input type="text" class="form-control" value="{{ $mahasiswa->bidang->nama_bidang ?? '-' }}" readonly>
                </div>
            </div>
        </div>

        {{-- DATA MAGANG --}}
        <div class="profile-section">
            <h6>Informasi Magang</h6>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Tanggal Mulai</label>
                    <input type="text" class="form-control"
                           value="{{ $mahasiswa->tanggal_mulai->format('d-m-Y') }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Tanggal Selesai</label>
                    <input type="text" class="form-control"
                           value="{{ $mahasiswa->tanggal_selesai->format('d-m-Y') }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Pembimbing Instansi</label>
                    <input type="text" class="form-control"
                           value="{{ $mahasiswa->pembimbing_instansi ?? '-' }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Pembimbing Lapangan</label>
                    <input type="text" class="form-control"
                           value="{{ $mahasiswa->pembimbing_lapangan ?? '-' }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <div class="pt-1">
                        @if($mahasiswa->status == 'Aktif')
                            <span class="badge bg-success">Aktif</span>
                        @elseif($mahasiswa->status == 'Selesai')
                            <span class="badge bg-info text-dark">Selesai</span>
                        @else
                            <span class="badge bg-danger">Dikeluarkan</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- BUTTON --}}
        <div class="d-flex justify-content-end mt-4">
            <a href="{{ url()->previous() }}" class="btn btn-secondary px-4">
                Kembali
            </a>
        </div>

    </div>

</div>

@endsection
