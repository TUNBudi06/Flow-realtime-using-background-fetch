@extends('layouts')

@section('title')
    ISEKI | Delivery Scanner
@endsection

@section('content')
    <x-sidebar>
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Delivery Scanner</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Scan and Manage Delivery Items</p>
        </div>

        <div id="video-container">
            <video id="qr-video"></video>
        </div>

        <livewire:delivery.qrscan />
    </x-sidebar>
@endsection
