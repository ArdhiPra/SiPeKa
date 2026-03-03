@extends('layouts.admin')

@section('title', 'Tambah Data Magang')

@section('content')
<div class="container my-4">
    <h2 class="mb-4 fw-semibold text-center text-md-start">Tambah Data Magang</h2>

    <form action="{{ route('admin.magang.store') }}" method="POST" class="needs-validation" novalidate>
        @csrf

        <div class="row g-3 mb-3">
            <div class="col-md-6 col-12">
                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" name="nama_lengkap" class="form-control" required value="{{ old('nama_lengkap') }}">
            </div>
            <div class="col-md-6 col-12">
                <label class="form-label">Asal Instansi</label>
                <input type="text" name="asal_instansi" class="form-control">
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6 col-12">
                <label class="form-label">Program Studi</label>
                <input type="text" name="program_studi" class="form-control">
            </div>
            <div class="col-md-6 col-12">
                <label class="form-label">Tingkat</label>
                <select name="tingkat" class="form-select">
                    <option value="">-- Pilih Tingkat --</option>
                    <option value="SMA/K" {{ old('tingkat') == 'SMA/K' ? 'selected' : '' }}>SMA/K</option>
                    <option value="D3" {{ old('tingkat') == 'D3' ? 'selected' : '' }}>D3</option>
                    <option value="D4" {{ old('tingkat') == 'D4' ? 'selected' : '' }}>D4</option>
                    <option value="S1" {{ old('tingkat') == 'S1' ? 'selected' : '' }}>S1</option>
                    <option value="S2" {{ old('tingkat') == 'S2' ? 'selected' : '' }}>S2</option>
                </select>
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6 col-12">
                <label class="form-label">NIS / NIM</label>
                <input type="text" name="nomor_induk" class="form-control">
            </div>
            <div class="col-md-6 col-12">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select">
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6 col-12">
                <label class="form-label">No. HP</label>
                <input type="text" name="no_hp" class="form-control">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat Domisili</label>
            <textarea name="alamat_domisili"class="form-control"rows="3"placeholder="Tulis alamat lengkap...">{{ old('alamat_domisili') }}</textarea>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6 col-12">
                <label class="form-label">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" class="form-control">
            </div>
            <div class="col-md-6 col-12">
                <label class="form-label">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" class="form-control">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Unit Penempatan</label>
            <select name="bidang_id" class="form-select">
                <option value="">-- Pilih Unit --</option>
                @foreach($bidang as $b)
                    <option value="{{ $b->id }}">{{ $b->nama_bidang }}</option>
                @endforeach
            </select>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6 col-12">
                <label class="form-label">Pembimbing Instansi</label>
                <input type="text" name="pembimbing_instansi" class="form-control">
            </div>
            <div class="col-md-6 col-12">
                <label class="form-label">Pembimbing Lapangan</label>
                <input type="text" name="pembimbing_lapangan" class="form-control">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="Selesai" {{ old('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="Diberhentikan" {{ old('status') == 'Diberhentikan' ? 'selected' : '' }}>Diberhentikan</option>
            </select>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4">
    <button type="submit" class="btn btn-primary">Simpan Data</button>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-danger">Batal</a>
</div>
    </form>
</div>
@endsection
