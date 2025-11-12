@extends('layouts')


@section('title')
    ISEKI | Login Boarding
@endsection

@section('content')
    <div class="backdrop-grayscale-50 h-screen w-full relative flex items-center bg-gradient-to-b from-brand-pink-300 to-brand-pink-800 h-20">
        <livewire:auth.loginlogic />
    </div>
@endsection
