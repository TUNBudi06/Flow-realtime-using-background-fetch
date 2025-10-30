@extends('layouts')


@section('title')
    ISEKI | Settings
@endsection

@section('content')
    <x-sidebar>
        @livewire('settings.profileedit')
    </x-sidebar>
@endsection
