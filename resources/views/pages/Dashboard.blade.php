@extends('layouts')

@section('title')
    ISEKI | Dashboard
@endsection

@section('content')
    <div class="pt-20 min-h-screen max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold">Dashboard Production</h1>
        <span class="text-sm text-gray-500">List of tractor Result</span>

        <div class="mt-8 w-full">
            <livewire:production.tablelist />
        </div>
    </div>
@endsection
