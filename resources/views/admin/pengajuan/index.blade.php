@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Daftar Pengajuan Magang</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Bidang</th>
                <th>Periode</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengajuan as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->bidang->nama_bidang ?? '-' }}</td>
                <td>{{ $item->tanggal_mulai }} s/d {{ $item->tanggal_selesai }}</td>
                <td>
                    @php
                        $badge = match($item->status) {
                            'pending'  => 'warning',
                            'diterima' => 'success',
                            'ditolak'  => 'danger',
                            default    => 'secondary',
                        };
                    @endphp
                    <span class="badge bg-{{ $badge }}">{{ ucfirst($item->status) }}</span>
                </td>
                <td>
                    <a href="{{ route('admin.pengajuan.show', $item->id) }}" class="btn btn-sm btn-info">Detail</a>
                </td>
            </tr>
            @empty
                <tr><td colspan="6" class="text-center">Tidak ada pengajuan.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $pengajuan->links() }}
</div>
@endsection