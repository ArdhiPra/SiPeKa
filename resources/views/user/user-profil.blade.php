@extends('layouts.user')

@section('title', 'Profil')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/profil.css') }}">
@endpush

@section('content')
<div class="container mt-4 mb-5">
    <div class="settings-wrapper">

        <div class="settings-title">Pengaturan Akun</div>

        {{-- TABS --}}
        <div class="settings-tabs">
            <a href="#" class="active" data-tab="profil">Profil Saya</a>
            <a href="#" data-tab="sandi">Ubah Sandi</a>
            @php
                $badgeClass = match($notifStatus ?? '') {
                    'diterima' => 'badge-hijau',
                    'ditolak'  => 'badge-merah',
                    'pending'  => 'badge-kuning',
                    default    => 'badge-default',
                };
            @endphp
            <a href="#" data-tab="notifikasi">
                Notifikasi 
                @if(($notifCount ?? 0) > 0)
                    <span class="tab-badge {{ $badgeClass }}">{{ $notifCount }}</span>
                @endif
            </a>
        </div>
    <div id="tab-profil">
        {{-- SECTION HEADER --}}
        <div class="section-title">Informasi Pribadi</div>
        <div class="section-sub">Perbarui foto dan detail pribadi kamu di sini.</div>

        <form action="{{ route('user.profil.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- FOTO --}}
            <div class="photo-row">
    <div class="photo-label-col">
        <div class="field-label">Foto Profil</div>
        <div class="field-sub">Foto ini akan ditampilkan di profilmu.</div>
    </div>

    {{-- AVATAR --}}
<div class="photo-avatar">
    @php
        $nama  = $profil->nama_lengkap ?? auth()->user()->name ?? '';
        $words = explode(' ', trim($nama));
        $inisial  = strtoupper(substr($words[0] ?? '', 0, 1));
        $inisial .= strtoupper(substr($words[1] ?? '', 0, 1));
    @endphp

    @if($profil?->foto)
        <img id="preview-foto"
            src="{{ asset('storage/' . $profil->foto) }}"
            alt="Foto Profil"
            class="avatar-img">
    @else
        <div id="preview-foto" class="avatar-initials">
            {{ $inisial ?: '?' }}
        </div>
    @endif
</div>

{{-- TOMBOL HAPUS FOTO (pakai JS, hindari nested form) --}}
@if($profil?->foto)
    <button type="button" class="btn-delete-foto" onclick="hapusFoto()">
        Hapus Foto
    </button>
@endif

{{-- UPLOAD --}}
<label class="photo-upload-box" for="foto_input">
    <div class="upload-icon"><i class="bi bi-cloud-arrow-up"></i></div>
    <div class="upload-text">
        <a href="#">Klik untuk unggah</a> atau seret dan lepas
    </div>
    <div class="upload-hint">JPG, PNG, max 2MB</div>
    <input type="file" id="foto_input" name="foto" accept="image/*" class="d-none">
</label>
</div>

            <hr class="settings-divider">

            {{-- NAMA --}}
            <div class="form-row-custom">
                <div class="form-row-label">
                    <div class="field-label">Nama Lengkap</div>
                </div>
                <div class="form-row-fields">
                    <div class="name-row">
                        <input type="text" name="nama_lengkap" class="form-control-custom"
                            placeholder="Nama Lengkap"
                            value="{{ old('nama_lengkap', $profil->nama_lengkap ?? '') }}">
                        </div>
                </div>
            </div>

            {{-- NIM/NISN --}}
            <div class="form-row-custom">
                <div class="form-row-label">
                    <div class="field-label">NIM / NISN</div>
                </div>
                <div class="form-row-fields">
                    <input type="text" name="nomor_induk" class="form-control-custom"
                        placeholder="Masukkan NIM/NISN"
                        value="{{ old('nomor_induk', $profil->nomor_induk ?? '') }}">
                </div>
            </div>
            <div class="form-row-custom">
    <div class="form-row-label">
        <div class="field-label">Jenis Kelamin</div>
    </div>
    <div class="form-row-fields">
        <select name="jenis_kelamin" class="form-control-custom" required>
            <option value="">-- Pilih Jenis Kelamin --</option>
            <option value="Laki-laki"  {{ old('jenis_kelamin', $profil->jenis_kelamin ?? '') == 'Laki-laki'  ? 'selected' : '' }}>Laki-laki</option>
            <option value="Perempuan"  {{ old('jenis_kelamin', $profil->jenis_kelamin ?? '') == 'Perempuan'  ? 'selected' : '' }}>Perempuan</option>
        </select>
    </div>
</div>

{{-- ASAL INSTANSI --}}
<div class="form-row-custom">
    <div class="form-row-label">
        <div class="field-label">Asal Instansi</div>
    </div>
    <div class="form-row-fields">
        <input type="text" name="asal_instansi" class="form-control-custom"
            placeholder="Contoh: Universitas Padjadjaran"
            value="{{ old('asal_instansi', $profil->asal_instansi ?? '') }}">
    </div>
</div>

{{-- TINGKAT --}}
<div class="form-row-custom">
    <div class="form-row-label">
        <div class="field-label">Tingkat</div>
    </div>
    <div class="form-row-fields">
        <select name="tingkat" class="form-control-custom" required>
            <option value="">-- Pilih Tingkat --</option>
            <option value="SMA/K" {{ old('tingkat', $profil->tingkat ?? '') == 'SMA/K' ? 'selected' : '' }}>SMA/K</option>
            <option value="D3"      {{ old('tingkat', $profil->tingkat ?? '') == 'D3'      ? 'selected' : '' }}>D3</option>
            <option value="D4"      {{ old('tingkat', $profil->tingkat ?? '') == 'D4'      ? 'selected' : '' }}>D4</option>
            <option value="S1"      {{ old('tingkat', $profil->tingkat ?? '') == 'S1'      ? 'selected' : '' }}>S1</option>
            <option value="S2"      {{ old('tingkat', $profil->tingkat ?? '') == 'S2'      ? 'selected' : '' }}>S2</option>
        </select>
    </div>
</div>

{{-- PROGRAM STUDI --}}
<div class="form-row-custom">
    <div class="form-row-label">
        <div class="field-label">Program Studi</div>
    </div>
    <div class="form-row-fields">
        <input type="text" name="program_studi" class="form-control-custom"
            placeholder="Contoh: Teknik Informatika"
            value="{{ old('program_studi', $profil->program_studi ?? '') }}">
    </div>
</div>

            {{-- EMAIL --}}
            <div class="form-row-custom">
                <div class="form-row-label">
                    <div class="field-label">Alamat Email</div>
                </div>
                <div class="form-row-fields">
                    <div class="input-with-icon">
                        <i class="bi bi-envelope"></i>
                        <input type="email" class="form-control-custom" readonly
                            value="{{ auth()->user()->email }}">
                    </div>
                </div>
            </div>

            {{-- TELEPON --}}
            <div class="form-row-custom">
                <div class="form-row-label">
                    <div class="field-label">Telepon</div>
                </div>
                <div class="form-row-fields">
                    <input type="text" name="telepon" class="form-control-custom"
                        placeholder="+62 812 345 6789"
                        value="{{ old('telepon', $profil->telepon ?? '') }}">
                </div>
            </div>

            {{-- BIO / ALAMAT --}}
            <div class="form-row-custom">
                <div class="form-row-label">
                    <div class="field-label">Alamat</div>
                </div>
                <div class="form-row-fields">
                    <textarea name="alamat_domisili" class="form-control-custom"
                        placeholder="Alamat Lengkap">{{ old('alamat_domisili', $profil->alamat_domisili ?? '') }}</textarea>
                </div>
            </div>

            {{-- TOMBOL AKSI --}}
            <div class="form-actions">
            <button type="reset" class="btn-cancel">Batal</button>               
            <button type="submit" class="btn-save">Simpan</button>
            </div>
        </form>
    </div>
    <div id="tab-sandi" style="display: none;">
        <div class="section-title">Ubah Kata Sandi</div>
    <div class="section-sub">Pastikan kata sandi baru minimal 8 karakter.</div>

    <form action="{{ route('user.profil.sandi') }}" method="POST">
        @csrf

        <div class="form-row-custom">
            <div class="form-row-label">
                <div class="field-label">Sandi Lama</div>
            </div>
            <div class="form-row-fields">
                <input type="password" name="sandi_lama" class="form-control-custom"
                    placeholder="Masukkan sandi lama">
            </div>
        </div>

        <div class="form-row-custom">
            <div class="form-row-label">
                <div class="field-label">Sandi Baru</div>
            </div>
            <div class="form-row-fields">
                <input type="password" name="sandi_baru" class="form-control-custom"
                    placeholder="Minimal 8 karakter">
            </div>
        </div>

        <div class="form-row-custom">
            <div class="form-row-label">
                <div class="field-label">Konfirmasi Sandi</div>
            </div>
            <div class="form-row-fields">
                <input type="password" name="sandi_baru_confirmation" class="form-control-custom"
                    placeholder="Ulangi sandi baru">
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-save">Simpan Sandi</button>
        </div>
    </form>
</div>
<div id="tab-notifikasi" style="display: none;">
    <div class="section-title">Notifikasi Pengajuan Magang</div>
    <div class="section-sub">Riwayat status pengajuan magang kamu.</div>

    @if($pengajuanList->isEmpty())
        <div class="empty-notif">
            <i class="bi bi-inbox" style="font-size:2rem; color:#9ca3af;"></i>
            <p>Belum ada pengajuan.</p>
        </div>
    @else
        @foreach($pengajuanList as $item)
        @php
            $statusClass = match($item->status) {
                'diterima' => 'status-hijau',
                'ditolak'  => 'status-merah',
                default    => 'status-kuning',
            };
            $statusLabel = match($item->status) {
                'diterima' => 'Diterima',
                'ditolak'  => 'Ditolak',
                default    => 'Menunggu',
            };
        @endphp
        <div class="notif-card">
            <div class="notif-card-header">
                <div class="notif-bidang">
                    <i class="bi bi-briefcase"></i>
                    {{ $item->bidang->nama_bidang ?? '-' }}
                </div>
                <span class="notif-status {{ $statusClass }}">{{ $statusLabel }}</span>
            </div>
            <div class="notif-card-body">
                <div class="notif-info-row">
                    <span><i class="bi bi-person"></i> {{ $item->nama }}</span>
                    <span><i class="bi bi-card-text"></i> {{ $item->nomor_induk }}</span>
                </div>
                <div class="notif-info-row">
                    <span><i class="bi bi-calendar-check"></i>
                        {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }}
                        –
                        {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }}
                    </span>
                </div>
                <div class="notif-info-row">
                    <span><i class="bi bi-clock-history"></i>
                        Dikirim {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->diffForHumans() }}
                    </span>
                </div>
                @if($item->status === 'ditolak' && $item->alasan_tolak)
                <div class="notif-info-row mt-2">
                    <span style="
                        background: #fff1f1;
                        border-left: 3px solid #ef4444;
                        padding: 8px 12px;
                        border-radius: 6px;
                        color: #b91c1c;
                        font-size: 0.875rem;
                        width: 100%;
                        display: block;
                    ">
                        <i class="bi bi-x-circle me-1"></i>
                        <strong>Alasan Penolakan:</strong> {{ $item->alasan_tolak }}
                    </span>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    @endif
</div>
</div>
@endsection

@push('scripts')
<script>
    @php
        $nama    = $profil->nama_lengkap ?? auth()->user()->name ?? '';
        $words   = explode(' ', trim($nama));
        $inisial = strtoupper(substr($words[0] ?? '', 0, 1))
                 . strtoupper(substr($words[1] ?? '', 0, 1));
    @endphp

    window.openSandiTab  = {!! json_encode(
        session('tab') == 'sandi' || $errors->has('sandi_lama') || $errors->has('sandi_baru')
    ) !!};
    window.markAsReadUrl = "{{ route('user.notifikasi.read') }}";
    window.deleteFotoUrl = "{{ route('user.profil.deleteFoto') }}";
    window.csrfToken     = "{{ csrf_token() }}";
    window.userInisial   = "{{ $inisial }}";
</script>
<script src="{{ asset('js/profil.js') }}"></script>
@endpush