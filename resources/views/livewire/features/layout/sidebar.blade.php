<div class="fixed bg-white w-sidebar h-screen flex flex-col border-r border-neutral-300 z-[151]">
    <div class="h-[4.5rem] w-full flex items-center justify-center gap-3">
        <img
            src="{{ asset('/static/images/logo_ls.png') }}"
            alt="img-logo"
            class="h-10">
        <p class="text-brand-500 font-semibold text-2xl">Lita Surya</p>
    </div>
    <div class="w-full flex-grow flex flex-col gap-1 px-4 py-5">
        <x-gxui.sidebar.item
            icon="house"
            to="/dashboard"
            title="Dashboard"
            active="{{ \Illuminate\Support\Facades\Route::is('dashboard') }}"
        ></x-gxui.sidebar.item>
        <x-gxui.sidebar.item
            icon="shopping-bag"
            to="/transaction"
            title="Transaction"
            active="{{ \Illuminate\Support\Facades\Route::is('transaction/*') }}"
        ></x-gxui.sidebar.item>
        <x-gxui.sidebar.item
            icon="archive"
            to="/master-data"
            title="Master Data"
            active="{{ \Illuminate\Support\Facades\Route::is('master-data/*') }}"
        ></x-gxui.sidebar.item>
        <x-gxui.sidebar.item
            icon="square-user"
            to="/customer"
            title="Customer"
            active="{{ \Illuminate\Support\Facades\Route::is('customer/*') }}"
        ></x-gxui.sidebar.item>
        <x-gxui.sidebar.item
            icon="users"
            to="/users"
            title="User Account"
            active="{{ \Illuminate\Support\Facades\Route::is('users/*') }}"
        ></x-gxui.sidebar.item>
        <x-gxui.sidebar.item
            icon="settings"
            to="/setting"
            title="Setting"
            active="{{ \Illuminate\Support\Facades\Route::is('setting/*') }}"
        ></x-gxui.sidebar.item>
    </div>
</div>
{{--<x-navigation.sidebar.wrapper>--}}
{{--    <x-navigation.sidebar.item--}}
{{--        to="/dashboard"--}}
{{--        icon="house"--}}
{{--        title="Dashboard"--}}
{{--        active="{{ \Illuminate\Support\Facades\Route::is('dashboard') }}"--}}
{{--    ></x-navigation.sidebar.item>--}}
{{--    <x-navigation.sidebar.item-tree--}}
{{--        icon="database"--}}
{{--        title="Master"--}}
{{--        active="{{ Str::startsWith(\Illuminate\Support\Facades\Route::currentRouteName(), $masterGroup) }}"--}}
{{--    >--}}
{{--        <x-navigation.sidebar.item--}}
{{--            to="{{ route('category.list') }}"--}}
{{--            icon="tags"--}}
{{--            title="Kategori"--}}
{{--            active="{{ \Illuminate\Support\Facades\Route::is('category.list') }}"--}}
{{--        ></x-navigation.sidebar.item>--}}
{{--        <x-navigation.sidebar.item--}}
{{--            to="{{ route('item.list') }}"--}}
{{--            icon="box"--}}
{{--            title="Barang"--}}
{{--            active="{{ \Illuminate\Support\Facades\Route::is('item.*') }}"--}}
{{--        ></x-navigation.sidebar.item>--}}
{{--        <x-navigation.sidebar.item--}}
{{--            to="/master"--}}
{{--            icon="gift"--}}
{{--            title="Hadiah"--}}
{{--            active="{{ \Illuminate\Support\Facades\Route::is('gift') }}"--}}
{{--        ></x-navigation.sidebar.item>--}}
{{--        <x-navigation.sidebar.item--}}
{{--            to="/master"--}}
{{--            icon="route"--}}
{{--            title="Jalur"--}}
{{--            active="{{ \Illuminate\Support\Facades\Route::is('gift') }}"--}}
{{--        ></x-navigation.sidebar.item>--}}
{{--    </x-navigation.sidebar.item-tree>--}}
{{--    <x-navigation.sidebar.item--}}
{{--        to="/cashier"--}}
{{--        icon="shopping-bag"--}}
{{--        title="Kasir"--}}
{{--    ></x-navigation.sidebar.item>--}}
{{--    <x-navigation.sidebar.item--}}
{{--        to="/point"--}}
{{--        icon="arrow-left-right"--}}
{{--        title="Penukaran Poin"--}}
{{--    ></x-navigation.sidebar.item>--}}
{{--    <x-navigation.sidebar.item--}}
{{--        to="/users"--}}
{{--        icon="users"--}}
{{--        title="Pengguna"--}}
{{--    ></x-navigation.sidebar.item>--}}
{{--    <x-navigation.sidebar.item--}}
{{--        to="/users"--}}
{{--        icon="contact"--}}
{{--        title="Member"--}}
{{--    ></x-navigation.sidebar.item>--}}
{{--    <x-navigation.sidebar.item--}}
{{--        to="/users"--}}
{{--        icon="calendar-check"--}}
{{--        title="Jadwal"--}}
{{--    ></x-navigation.sidebar.item>--}}
{{--    <x-navigation.sidebar.item-tree--}}
{{--        icon="clipboard-minus"--}}
{{--        title="Laporan"--}}
{{--        active="{{ \Illuminate\Support\Facades\Route::is('dashboard') }}"--}}
{{--    >--}}
{{--        <x-navigation.sidebar.item--}}
{{--            to="/users"--}}
{{--            icon="calendar-check"--}}
{{--            title="Jadwal"--}}
{{--        ></x-navigation.sidebar.item>--}}
{{--        <x-navigation.sidebar.item--}}
{{--            to="/users"--}}
{{--            icon="circle-percent"--}}
{{--            title="Penjualan Kasir"--}}
{{--        ></x-navigation.sidebar.item>--}}
{{--        <x-navigation.sidebar.item--}}
{{--            to="/users"--}}
{{--            icon="file-user"--}}
{{--            title="Penjualan Sales"--}}
{{--        ></x-navigation.sidebar.item>--}}
{{--    </x-navigation.sidebar.item-tree>--}}
{{--    <x-navigation.sidebar.item--}}
{{--        to="/users"--}}
{{--        icon="settings"--}}
{{--        title="Pengaturan"--}}
{{--    ></x-navigation.sidebar.item>--}}
{{--</x-navigation.sidebar.wrapper>--}}
