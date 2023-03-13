@extends('layouts.contentLayoutMaster')

@section('title', 'Shifts')

@livewireStyles

@livewireScripts


@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{ asset(mix('fonts/font-awesome/css/font-awesome.min.css')) }}">
@endsection

@section('content')
@livewire('shift.dashboard')
@endsection

