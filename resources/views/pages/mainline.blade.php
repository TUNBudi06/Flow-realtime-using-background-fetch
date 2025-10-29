@extends('layouts')

@section('title')
    ISEKI | MainLine Scanner
@endsection

@section('content')
    <x-sidebar>
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">MainLine Scanner</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Scan and Manage Production Line Items</p>
        </div>

        <div id="video-container">
            <video id="qr-video"></video>
        </div>

        <livewire:mainline.qrscan />
    </x-sidebar>
@endsection
