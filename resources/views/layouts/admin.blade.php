@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar')
@endsection

@push('styles')
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bidang.css') }}" rel="stylesheet">
    <link href="{{ asset('css/editindex.css') }}" rel="stylesheet">
@endpush