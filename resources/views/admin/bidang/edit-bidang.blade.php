@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card p-3 shadow-sm">

        <h5 class="mb-3">Edit Bidang</h5>

        <form action="{{ route('admin.bidang.update', $bidang->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Bidang</label>
                <input type="text" name="nama_bidang" 
                       class="form-control form-control-lg"
                       value="{{ $bidang->nama_bidang }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Kuota</label>
                <input type="number" name="kuota" 
                       class="form-control form-control-lg"
                       value="{{ $bidang->kuota }}">
            </div>

            <button class="btn btn-primary w-100">
                Update
            </button>
        </form>

    </div>
</div>
@endsection