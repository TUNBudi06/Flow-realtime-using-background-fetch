@extends('layouts')

@section('title')
    ISEKI | Dashboard
@endsection

@section('content')
    <div class="pt-20 min-h-screen mx-auto px-4 sm:px-6 lg:px-8">
        <x-table-list-production />
    </div>
@endsection
