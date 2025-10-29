@extends('layouts')

@section('title')
    ISEKI | Menu Dashboard
@endsection

@section('content')
    <x-sidebar>
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Production</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Production Management System</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <div class="mb-4">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Overview</h2>
            </div>

            <!-- Content here -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-blue-50 dark:bg-blue-900 p-4 rounded-lg">
                    <h3 class="text-lg font-medium text-blue-900 dark:text-blue-100">MainLine</h3>
                    <p class="text-3xl font-bold text-blue-600 dark:text-blue-300 mt-2">125</p>
                </div>
                <div class="bg-green-50 dark:bg-green-900 p-4 rounded-lg">
                    <h3 class="text-lg font-medium text-green-900 dark:text-green-100">Inspection</h3>
                    <p class="text-3xl font-bold text-green-600 dark:text-green-300 mt-2">98</p>
                </div>
                <div class="bg-yellow-50 dark:bg-yellow-900 p-4 rounded-lg">
                    <h3 class="text-lg font-medium text-yellow-900 dark:text-yellow-100">Delivery</h3>
                    <p class="text-3xl font-bold text-yellow-600 dark:text-yellow-300 mt-2">27</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg p-6 mt-4 border border-gray-200 overflow-hidden">
            <x-table-list-production />
        </div>
    </x-sidebar>
@endsection
