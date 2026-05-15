@extends('layouts.admin')

@section('title', 'Edit Data Magang')

@section('content')


    <div class="container my-4">

        {{-- TITLE --}}
        <div class="mb-4">
            <h4 class="fw-bold mb-1">Edit Data Magang</h4>
            <small class="text-muted">Pilih data mahasiswa untuk melakukan perubahan informasi magang</small>
        </div>

        {{-- FILTER --}}
        <form method="GET" action="{{ route('admin.edit.index') }}" class="mb-4">
    <div class="filter-panel">
        <div class="row g-2 align-items-end">

            <div class="col">
                <label class="filter-label">Bidang</label>
                <select name="bidang" class="form-select filter-control">
                    <option value="">Semua Bidang</option>
                    @foreach($bidang as $b)
                        <option value="{{ $b->id }}" {{ request('bidang') == $b->id ? 'selected' : '' }}>
                            {{ $b->nama_bidang }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col">
                <label class="filter-label">Asal Instansi</label>
                <input type="text" name="asal_instansi" class="form-control filter-control"
                    placeholder="Cari instansi..." value="{{ request('asal_instansi') }}">
            </div>

            <div class="col">
                <label class="filter-label">Status</label>
                <select name="status" class="form-select filter-control">
                    <option value="">Semua Status</option>
                    <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="Diberhentikan" {{ request('status') == 'Diberhentikan' ? 'selected' : '' }}>Diberhentikan</option>
                </select>
            </div>

            <div class="col">
                <label class="filter-label">Tahun</label>
                <select name="tahun" class="form-select filter-control">
                    <option value="">Semua</option>
                    @foreach($tahunList as $tahun)
                        <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <label class="filter-label d-block">&nbsp;</label>
                <button type="submit" class="btn btn-primary filter-btn w-100">
                    Terapkan Filter
                </button>
            </div>

        </div>
    </div>
</form>

        {{-- TABLE --}}
        <div class="table-card">
            <div class="table-responsive">
                <table class="table custom-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Lengkap</th>
                            <th>Asal Instansi</th>
                            <th>Bidang</th>
                            <th>Status</th>
                            <th width="12%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($magang as $index => $m)
                            <tr>
                                <td>{{ $index + 1 }}</td>

                                <td>
                                    <a href="{{ route('admin.edit.form', $m->id) }}"
                                        class="fw-semibold text-decoration-none text-primary">
                                        {{ $m->nama_lengkap }}
                                    </a>
                                </td>

                                <td class="text-muted">{{ $m->asal_instansi ?? '-' }}</td>

                                <td>{{ optional($m->bidang)->nama_bidang ?? '-' }}</td>

                                <td>
                                    @if($m->status == 'Aktif')
                                        <span class="status-pill status-active">Aktif</span>
                                    @elseif($m->status == 'Selesai')
                                        <span class="status-pill status-finish">Selesai</span>
                                    @else
                                        <span class="status-pill status-danger">Diberhentikan</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.edit.form', $m->id) }}"
                                            class="btn btn-sm btn-outline-warning rounded-circle" data-bs-toggle="tooltip"
                                            title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <form action="{{ route('admin.edit.destroy', $m->id) }}" method="POST"
                                            class="form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle"
                                                data-bs-toggle="tooltip" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    Tidak ada data magang ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
            .forEach(el => new bootstrap.Tooltip(el));
    </script>

@endsection