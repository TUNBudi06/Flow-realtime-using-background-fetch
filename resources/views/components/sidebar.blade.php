<div x-data="{ sidebarOpen: false }">
<aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform" :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full sm:translate-x-0'" aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800 flex flex-col">
        <!-- Logo/Brand Section -->
        <div class="mb-6 px-2">
            <h2 class="text-xl font-bold text-gray-800 dark:text-white">ISEKI Flow</h2>
            <p class="text-xs text-gray-500 dark:text-gray-400">Production Management</p>
        </div>

        <!-- Main Menu -->
        <ul class="space-y-2 font-medium flex-1">
            <!-- Dashboard -->
            <li>
                <a href="{{ route('home') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group data-[active=true]:bg-blue-100 data-[active=true]:dark:bg-blue-900" data-active="{{Route::is('admin.home')?'true':'false'}}">
                    <svg class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white data-[active=true]:bg-blue-100 data-[active=true]:dark:bg-blue-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 18a8 8 0 1 1 0-16 8 8 0 0 1 0 16Zm0-13a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3Zm2 10h-4v-1a2 2 0 0 1 4 0v1Zm1-4h-6v-1a3 3 0 0 1 6 0v1Z"/>
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Dashboard</span>
                </a>
            </li>

            <!-- MainLine -->
            <li>
                <a href="{{ route('mainline') }}" data-active="{{Route::is('mainline')?'true':'false'}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group data-[active=true]:bg-blue-100 data-[active=true]:dark:bg-blue-900">
                    <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white data-[active=true]:bg-blue-100 data-[active=true]:dark:bg-blue-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">MainLine</span>
                </a>
            </li>

            <!-- Inspection -->
            <li>
                <a href="{{ route('inspection') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group data-[active=true]:bg-blue-100 data-[active=true]:dark:bg-blue-900">
                    <svg class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white data-[active=true]:bg-blue-100 data-[active=true]:dark:bg-blue-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M18 5h-.7c.229-.467.349-.98.351-1.5a3.5 3.5 0 0 0-3.5-3.5c-1.717 0-3.215 1.2-4.331 2.481C8.4.842 6.949 0 5.5 0A3.5 3.5 0 0 0 2 3.5c.003.52.123 1.033.351 1.5H2a2 2 0 0 0-2 2v3a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V7a2 2 0 0 0-2-2ZM8.058 5H5.5a1.5 1.5 0 0 1 0-3c.9 0 2 .754 3.092 2.122-.219.337-.392.635-.534.878Zm6.1 0h-3.742c.933-1.368 2.371-3 3.739-3a1.5 1.5 0 0 1 0 3h.003ZM11 13H9v7h2v-7Zm-4 0H2v5a2 2 0 0 0 2 2h3v-7Zm6 0v7h3a2 2 0 0 0 2-2v-5h-5Z"/>
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Inspection</span>
                </a>
            </li>

            <!-- Delivery -->
            <li>
                <a href="{{ route('delivery') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group data-[active=true]:bg-blue-100 data-[active=true]:dark:bg-blue-900">
                    <svg class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white data-[active=true]:bg-blue-100 data-[active=true]:dark:bg-blue-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Delivery</span>
                </a>
            </li>

            <!-- Divider -->
            <li class="pt-4 mt-4 border-t border-gray-200 dark:border-gray-700"></li>

            <!-- Settings -->
            <li>
                <a href="{{ route('settings') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group data-[active=true]:bg-blue-100 data-[active=true]:dark:bg-blue-900">
                    <svg class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white data-[active=true]:bg-blue-100 data-[active=true]:dark:bg-blue-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M18 7.5h-.423l-.452-1.09.3-.3a1.5 1.5 0 0 0 0-2.121L16.01 2.575a1.5 1.5 0 0 0-2.121 0l-.3.3-1.089-.452V2A1.5 1.5 0 0 0 11 .5H9A1.5 1.5 0 0 0 7.5 2v.423l-1.09.452-.3-.3a1.5 1.5 0 0 0-2.121 0L2.576 3.99a1.5 1.5 0 0 0 0 2.121l.3.3L2.423 7.5H2A1.5 1.5 0 0 0 .5 9v2A1.5 1.5 0 0 0 2 12.5h.423l.452 1.09-.3.3a1.5 1.5 0 0 0 0 2.121l1.415 1.413a1.5 1.5 0 0 0 2.121 0l.3-.3 1.09.452V18A1.5 1.5 0 0 0 9 19.5h2a1.5 1.5 0 0 0 1.5-1.5v-.423l1.09-.452.3.3a1.5 1.5 0 0 0 2.121 0l1.415-1.414a1.5 1.5 0 0 0 0-2.121l-.3-.3.452-1.09H18a1.5 1.5 0 0 0 1.5-1.5V9A1.5 1.5 0 0 0 18 7.5Zm-8 6a3.5 3.5 0 1 1 0-7 3.5 3.5 0 0 1 0 7Z"/>
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Settings</span>
                </a>
            </li>
        </ul>

        <!-- Logout at bottom -->
        <div class="pt-4 mt-4 border-t border-gray-200 dark:border-gray-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center w-full p-2 text-gray-900 rounded-lg dark:text-white hover:bg-red-100 dark:hover:bg-red-900 group">
                    <svg class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-red-600 dark:group-hover:text-red-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3"/>
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap text-left">Logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>

<!-- Sidebar Toggle Button - Moves from bottom-left to bottom-right when open -->
<button
    @click="sidebarOpen = !sidebarOpen"
    type="button"
    class="fixed bottom-4 z-50 inline-flex items-center p-3 text-sm text-white bg-blue-600 rounded-full shadow-lg hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 sm:hidden transition-all duration-300"
    :class="sidebarOpen ? 'right-4' : 'left-4'"
    aria-label="Toggle sidebar">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" x-show="!sidebarOpen">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
    </svg>
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" x-show="sidebarOpen" x-cloak>
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
    </svg>
</button>

<!-- Overlay for mobile when sidebar is open -->
<div
    x-show="sidebarOpen"
    @click="sidebarOpen = false"
    x-cloak
    class="fixed inset-0 z-30 bg-gray-600 opacity-80 sm:hidden"
    x-transition:enter="transition-opacity ease-linear duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-50"
    x-transition:leave="transition-opacity ease-linear duration-300"
    x-transition:leave-start="opacity-50"
    x-transition:leave-end="opacity-0">
</div>

<div class="p-4 sm:ml-64 pt-20">
    {{ $slot }}
</div>
</div>
