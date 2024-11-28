<x-navigation.sidebar.wrapper>
    <x-navigation.sidebar.item
        to="/dashboard"
        icon="house"
        title="Dashboard"
        active="{{ \Illuminate\Support\Facades\Route::is('dashboard') }}"
    ></x-navigation.sidebar.item>
    <x-navigation.sidebar.item-tree
        icon="database"
        title="Master"
        active="{{ in_array(\Illuminate\Support\Facades\Route::currentRouteName(), $masterRoutes) ? 'true' : 'false'  }}"
    >
        <x-navigation.sidebar.item
            to="{{ route('category.list') }}"
            icon="tags"
            title="Kategori"
            active="{{ \Illuminate\Support\Facades\Route::is('category.list') }}"
        ></x-navigation.sidebar.item>
        <x-navigation.sidebar.item
            to="{{ route('item.list') }}"
            icon="box"
            title="Barang"
            active="{{ \Illuminate\Support\Facades\Route::is('item.list') }}"
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
        <x-navigation.sidebar.item
            to="/users"
            icon="circle-percent"
            title="Penjualan Kasir"
        ></x-navigation.sidebar.item>
        <x-navigation.sidebar.item
            to="/users"
            icon="file-user"
            title="Penjualan Sales"
        ></x-navigation.sidebar.item>
    </x-navigation.sidebar.item-tree>
    <x-navigation.sidebar.item
        to="/users"
        icon="settings"
        title="Pengaturan"
    ></x-navigation.sidebar.item>
</x-navigation.sidebar.wrapper>
