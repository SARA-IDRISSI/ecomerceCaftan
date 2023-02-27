@extends('admin.dashboard')
@section('title', 'admin')
@section('content')
@livewireStyles
    <livewire:edit-category-component />
    @livewireScripts
@endsection
