<a href="{{ route('home') }}" class="text-gray-700 px-2 py-3 rounded-xl data-[active=true]:bg-brand-pink-400 dark:text-brand-pink-200 dark:data-[active=true]:bg-brand-pink-700 hover:text-gray-900 hover:bg-brand-pink-300 dark:hover:text-white transition" data-active="{{Route::is('home')?'true':'false'}}">
    Dashboard
</a>
<a href="{{ route('admin.home') }}" class="text-gray-700 px-2 py-3 rounded-xl data-[active=true]:bg-brand-pink-400 dark:text-brand-pink-200 dark:data-[active=true]:bg-brand-pink-700 hover:text-gray-900 hover:bg-brand-pink-300 dark:hover:text-white transition" data-active="{{ str_contains(request()->path(), 'admin') ? 'true' : 'false' }}">
    Menu
</a>
