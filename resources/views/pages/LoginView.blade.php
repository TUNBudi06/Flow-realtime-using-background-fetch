@extends('layouts')


@section('title')
    ISEKI | Login Boarding
@endsection

@section('content')
    <div class="backdrop-grayscale-50 h-screen w-full relative flex items-center bg-radial-[at_50%_25%] from-sky-300 to-black h-20">
        <livewire:auth.loginlogic />
    </div>
@endsection
