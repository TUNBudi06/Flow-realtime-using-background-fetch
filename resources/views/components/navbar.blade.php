<a href="{{ route('home') }}" class="text-gray-700 px-2 py-3 rounded-xl data-[active=true]:bg-[#BCE784] dark:text-[#9BBEC7] dark:data-[active=true]:bg-gray-500 hover:text-gray-900 hover:bg-[#EAD94C] dark:hover:text-white transition" data-active="{{Route::is('home')?'true':'false'}}">
    Dashboard
</a>
<a href="{{ route('admin.home') }}" class="text-gray-700 px-2 py-3 rounded-xl data-[active=true]:bg-[#BCE784] dark:text-[#9BBEC7] dark:data-[active=true]:bg-gray-500 hover:text-gray-900 hover:bg-[#EAD94C] dark:hover:text-white transition" data-active="{{ str_contains(request()->path(), 'admin') ? 'true' : 'false' }}">
    Menu
</a>
