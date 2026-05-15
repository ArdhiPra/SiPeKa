@extends('layouts.admin')

@section('title', 'Edit Data Magang')

@section('content')
<div class="container my-4">
    <h2 class="mb-4 fw-semibold text-center text-md-start">Edit Data Magang</h2>
    <form action="{{ route('admin.edit.update', $magang->id) }}" method="POST">
    @csrf
    @method('PUT')
        <div class="row g-3 mb-3">
            <div class="col-md-6 col-12">
                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap', $magang->nama_lengkap) }}" required>
            </div>
            <div class="col-md-6 col-12">
                <label class="form-label">Asal Instansi</label>
                <input type="text" name="asal_instansi" class="form-control" value="{{ old('asal_instansi', $magang->asal_instansi) }}">
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6 col-12">
                <label class="form-label">Program Studi</label>
                <input type="text" name="program_studi" class="form-control" value="{{ old('program_studi', $magang->program_studi) }}">
            </div>
            <div class="col-md-6 col-12">
                <label class="form-label">Tingkat</label>
                <select name="tingkat" class="form-select">
                    <option value="">-- Pilih Tingkat --</option>
                    <option value="SMA/K" {{ $magang->tingkat == 'SMA/K' ? 'selected' : '' }}>SMA/K</option>
                    <option value="D3" {{ $magang->tingkat == 'D3' ? 'selected' : '' }}>D3</option>
                    <option value="D4" {{ $magang->tingkat == 'D4' ? 'selected' : '' }}>D4</option>
                    <option value="S1" {{ $magang->tingkat == 'S1' ? 'selected' : '' }}>S1</option>
                    <option value="S2" {{ $magang->tingkat == 'S2' ? 'selected' : '' }}>S2</option>
                </select>
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6 col-12">
                <label class="form-label">NIS / NIM</label>
                <input type="text" name="nomor_induk" class="form-control" value="{{ old('nomor_induk', $magang->nomor_induk) }}">
            </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6 col-12">
                <label class="form-label">No. HP</label>
                <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $magang->no_hp) }}">
            </div>
            <div class="col-md-6 col-12">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select">
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki" {{ $magang->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ $magang->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat Domisili</label>
            <textarea name="alamat_domisili" class="form-control" rows="3">{{ old('alamat_domisili', $magang->alamat_domisili) }}</textarea>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6 col-12">
                <label class="form-label">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai"
                    class="form-control"
                    value="{{ old('tanggal_mulai', $magang->tanggal_mulai?->format('Y-m-d')) }}">    
            </div>
            <div class="col-md-6 col-12">
                <label class="form-label">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai"
                    class="form-control"
                    value="{{ old('tanggal_selesai', $magang->tanggal_selesai?->format('Y-m-d')) }}">    
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Unit Penempatan</label>
            <select name="unit_penempatan" class="form-select">
                <option value="">-- Pilih Unit --</option>
                @foreach($bidang as $b)
                    <option value="{{ $b->id }}" {{ $magang->unit_penempatan == $b->id ? 'selected' : '' }}>
                        {{ $b->nama_bidang }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6 col-12">
                <label class="form-label">Pembimbing Instansi</label>
                <input type="text" name="pembimbing_instansi" class="form-control" value="{{ old('pembimbing_instansi', $magang->pembimbing_instansi) }}">
            </div>
            <div class="col-md-6 col-12">
                <label class="form-label">Pembimbing Lapangan</label>
                <input type="text" name="pembimbing_lapangan" class="form-control" value="{{ old('pembimbing_lapangan', $magang->pembimbing_lapangan) }}">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="Aktif" {{ $magang->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="Selesai" {{ $magang->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="Diberhentikan" {{ $magang->status == 'Diberhentikan' ? 'selected' : '' }}>Diberhentikan</option>
            </select>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('admin.edit.index') }}" class="btn btn-danger">Batal</a>
        </div>
    </form>
</div>
@endsection
