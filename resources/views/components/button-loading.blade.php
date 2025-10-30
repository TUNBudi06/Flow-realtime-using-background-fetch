@props([
    'type' => 'submit',
    'color' => 'blue',
    'loadingText' => 'Loading...',
    'wire:target' => null,
])

@php
    $colorClasses = [
        'blue' => 'bg-blue-500 hover:bg-blue-600 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800',
        'green' => 'bg-green-500 hover:bg-green-600 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800',
        'red' => 'bg-red-500 hover:bg-red-600 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800',
        'gray' => 'bg-gray-500 hover:bg-gray-600 focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800',
        'yellow' => 'bg-yellow-500 hover:bg-yellow-600 focus:ring-yellow-300 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800',
    ];

    $buttonClasses = $colorClasses[$color] ?? $colorClasses['blue'];
@endphp

<button
    type="{{ $type }}"
    {{ $attributes->merge(['class' => "w-full text-white font-medium py-2 px-4 rounded-md transition-colors duration-200 focus:ring-4 focus:outline-none disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2 {$buttonClasses}"]) }}
    wire:loading.attr="disabled"
    @if($attributes->has('wire:click'))
        wire:target="{{ $attributes->get('wire:click') }}"
    @endif
>
    <!-- Loading Spinner -->
    <svg wire:loading class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
    </svg>

    <!-- Button Text (hidden when loading) -->
    <span wire:loading.remove>
        {{ $slot }}
    </span>

    <!-- Loading Text -->
    <span wire:loading>
        {{ $loadingText }}
    </span>
</button>

