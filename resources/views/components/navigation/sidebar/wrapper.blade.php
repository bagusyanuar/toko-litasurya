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
            <x-navigation.sidebar.item-tree
                icon="database"
                title="Master"
                :active="false"
            >
                <x-navigation.sidebar.item
                    to="/master"
                    icon="tags"
                    title="Kategori"
                    active="{{ \Illuminate\Support\Facades\Route::is('category') }}"
                ></x-navigation.sidebar.item>
                <x-navigation.sidebar.item
                    to="/master"
                    icon="box"
                    title="Barang"
                    active="{{ \Illuminate\Support\Facades\Route::is('item') }}"
                ></x-navigation.sidebar.item>
                <x-navigation.sidebar.item
                    to="/master"
                    icon="gift"
                    title="Hadiah"
                    active="{{ \Illuminate\Support\Facades\Route::is('gift') }}"
                ></x-navigation.sidebar.item>
                <x-navigation.sidebar.item
                    to="/master"
                    icon="route"
                    title="Jalur"
                    active="{{ \Illuminate\Support\Facades\Route::is('gift') }}"
                ></x-navigation.sidebar.item>
            </x-navigation.sidebar.item-tree>
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
            <x-navigation.sidebar.item
                to="/users"
                icon="contact"
                title="Member"
            ></x-navigation.sidebar.item>
            <x-navigation.sidebar.item
                to="/users"
                icon="calendar-check"
                title="Jadwal"
            ></x-navigation.sidebar.item>
            <x-navigation.sidebar.item-tree
                icon="clipboard-minus"
                title="Laporan"
                active="{{ \Illuminate\Support\Facades\Route::is('dashboard') }}"
            >
                <x-navigation.sidebar.item
                    to="/users"
                    icon="calendar-check"
                    title="Jadwal"
                ></x-navigation.sidebar.item>
            </x-navigation.sidebar.item-tree>

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
