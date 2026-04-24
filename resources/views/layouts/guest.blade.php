@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar-guest')
@endsection

@push('styles')
    <link href="{{ asset('css/guest.css') }}" rel="stylesheet">
@endpush