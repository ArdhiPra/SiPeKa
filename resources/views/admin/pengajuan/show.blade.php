@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Detail Pengajuan</h2>

    <table class="table table-bordered">
        <tr><th>Nama</th><td>{{ $pengajuan->nama }}</td></tr>
        <tr><th>Nomor Induk</th><td>{{ $pengajuan->nomor_induk ?? '-' }}</td></tr>
        <tr><th>Tingkat</th><td>{{ $pengajuan->tingkat ?? '-' }}</td></tr>
        <tr><th>Program Studi</th><td>{{ $pengajuan->program_studi }}</td></tr>
        <tr><th>Bidang</th><td>{{ $pengajuan->bidang->nama_bidang ?? '-' }}</td></tr>
        <tr><th>Periode</th><td>{{ $pengajuan->tanggal_mulai }} s/d {{ $pengajuan->tanggal_selesai }}</td></tr>
        <tr>
            <th>File Pengajuan</th>
            <td><a href="{{ asset('storage/' . $pengajuan->file_pengajuan) }}" target="_blank">Lihat PDF</a></td>
        </tr>
        <tr><th>Status</th><td>{{ ucfirst($pengajuan->status) }}</td></tr>
        @if($pengajuan->alasan_tolak)
        <tr><th>Alasan Tolak</th><td>{{ $pengajuan->alasan_tolak }}</td></tr>
        @endif
    </table>

    {{-- Tombol aksi hanya muncul jika masih pending --}}
    @if($pengajuan->status === 'pending')
    <div class="d-flex gap-2">

        {{-- Tombol Terima --}}
        <form action="{{ route('admin.pengajuan.terima', $pengajuan->id) }}" method="POST"
              onsubmit="return confirm('Yakin ingin menerima pengajuan ini?')">
            @csrf
            <button type="submit" class="btn btn-success">✓ Terima</button>
        </form>

        {{-- Tombol Tolak (toggle form) --}}
        <button class="btn btn-danger" onclick="document.getElementById('form-tolak').classList.toggle('d-none')">
            ✗ Tolak
        </button>
    </div>

    <div id="form-tolak" class="d-none mt-3">
        <form action="{{ route('admin.pengajuan.tolak', $pengajuan->id) }}" method="POST">
            @csrf
            <div class="mb-2">
                <label class="form-label">Alasan Penolakan</label>
                <textarea name="alasan_tolak" class="form-control" rows="3" required></textarea>
                @error('alasan_tolak') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <button type="submit" class="btn btn-danger">Kirim Penolakan</button>
        </form>
    </div>
    @endif

    <a href="{{ route('admin.pengajuan.index') }}" class="btn btn-secondary mt-3">← Kembali</a>
</div>
@endsection