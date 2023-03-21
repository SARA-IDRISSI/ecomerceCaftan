@extends('admin.dashboard')
@section('title', 'All Product Admin')
@section('form')
    @livewireStyles
    <livewire:all-product-component />
    @livewireScripts
@endsection
