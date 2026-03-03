@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar')
@endsection

@push('styles')
    <link href="{{ asset('css/user.css') }}" rel="stylesheet">
@endpush