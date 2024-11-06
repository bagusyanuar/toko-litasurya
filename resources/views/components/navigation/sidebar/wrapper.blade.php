<div class="fixed top-0 left-0 h-screen shadow-sidebar w-sidebar px-3">
    <!-- sidebar header -->
    <div class="w-full h-20 flex justify-center items-center border-b border-neutral-300 mb-3">
        <img
            src="{{ asset('/assets/images/logo.png') }}"
            alt="img-logo"
            class="h-12">
    </div>
    <!-- sidebar menu -->
    <div class="w-full flex flex-col">
        <p class="text-xs text-neutral-400 font-light mb-1">Menu</p>
        <div class="flex flex-col w-full gap-1">
            <x-navigation.sidebar.item
                to="/dashboard"
                icon="house"
                title="Dashboard"
                active="{{ \Illuminate\Support\Facades\Route::is('dashboard') }}"
            ></x-navigation.sidebar.item>
            <x-navigation.sidebar.item
                to="/master"
                icon="database"
                title="Master"
                active="{{ \Illuminate\Support\Facades\Route::is('dashboard') }}"
            ></x-navigation.sidebar.item>
            <x-navigation.sidebar.item
                to="/cashier"
                icon="shopping-bag"
                title="Kasir"
            ></x-navigation.sidebar.item>
            <x-navigation.sidebar.item
                to="/point"
                icon="arrow-left-right"
                title="Penukaran Poin"
            ></x-navigation.sidebar.item>
            <x-navigation.sidebar.item
                to="/users"
                icon="users"
                title="Pengguna"
            ></x-navigation.sidebar.item>
            <div x-data="{open: false}">
                <div
                    x-on:click="open = !open"
                    class="w-full rounded-md flex items-center gap-2 text-xs font-light text-neutral-400 p-3 cursor-pointer transition-all ease-in duration-200 hover:bg-brand-500 hover:text-white">
                    <i data-lucide="users" class="h-4 aspect-[1/1]"></i>
                    <span class="w-full flex items-center">
                        User
                    </span>
                </div>
                <div class="w-full mt-1" x-show="open" x-collapse>
                    <div
                        class="w-full rounded-md flex items-center gap-2 text-xs font-light text-neutral-400 p-3 cursor-pointer transition-all ease-in duration-200 hover:bg-brand-500 hover:text-white">
                        <i data-lucide="users" class="h-4 aspect-[1/1]"></i>
                        <span class="w-full flex items-center">
                        User
                    </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--    <div class="header">--}}
    {{--        @if(isset($header))--}}
    {{--        @endif--}}
    {{--    </div>--}}
    {{--    <div class="item-wrapper">--}}
    {{--        {{ $slot }}--}}
    {{--    </div>--}}
</div>
