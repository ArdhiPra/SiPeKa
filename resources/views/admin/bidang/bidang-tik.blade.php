@extends('layouts.admin')

@section('title', 'Data Magang Bidang tik')

@section('content')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


    <div class="container my-4">
        <div class="customers-card shadow-sm">

            {{-- Header --}}
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
                <div>
                    <div class="customers-title">Data Magang TIK</div>
                    <div class="customers-subtitle">Active Members</div>
                </div>

                <div class="d-flex gap-2 mt-3 mt-md-0">
                    <div class="search-box">
                        <i class=""></i>

                    </div>


                </div>
            </div>

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table customers-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="60">No</th>
                            <th>Nama Lengkap</th>
                            <th>Asal Instansi</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($magang as $index => $m)
                            <tr>
                                <td>{{ $index + 1 }}</td>

                                <td>
                                    <a href="{{ route('admin.profil.mahasiswa', $m->id) }}" class="customer-name">
                                        {{ $m->nama_lengkap }}
                                    </a>
                                </td>

                                <td class="text-muted">
                                    {{ $m->asal_instansi ?? '-' }}
                                </td>

                                <td>
                                    @if($m->status == 'Aktif')
                                        <span class="status-pill status-active">Aktif</span>
                                    @elseif($m->status == 'Selesai')
                                        <span class="status-pill status-finish">Selesai</span>
                                    @else
                                        <span class="status-pill status-danger">Diberhentikan</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    Tidak ada data magang.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection