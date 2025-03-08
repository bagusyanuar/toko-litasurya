<div class="fixed bg-white w-sidebar h-screen flex flex-col border-r border-neutral-300 z-[151]">
    <div class="h-[4.5rem] w-full flex items-center justify-center gap-3">
        <img
            src="{{ asset('/assets/images/logo_ls.png') }}"
            alt="img-logo"
            class="h-10">
        <p class="text-brand-500 font-semibold text-2xl">Lita Surya</p>
    </div>
    <div class="w-full flex-grow flex flex-col gap-1 px-4 py-5">
        <x-navigation.sidebar.ui-sidebar-item
            icon="house"
            to="/dashboard"
            title="Dashboard"
            active="{{ \Illuminate\Support\Facades\Route::is('dashboard') }}"
        ></x-navigation.sidebar.ui-sidebar-item>
        <x-navigation.sidebar.ui-sidebar-item
            icon="shopping-bag"
            to="/transaction"
            title="Transaction"
        ></x-navigation.sidebar.ui-sidebar-item>
        <x-navigation.sidebar.ui-sidebar-item
            icon="archive"
            to="/master-data"
            title="Master Data"
        ></x-navigation.sidebar.ui-sidebar-item>
        <x-navigation.sidebar.ui-sidebar-item
            icon="square-user"
            to="/customer"
            title="Customer"
        ></x-navigation.sidebar.ui-sidebar-item>
        <x-navigation.sidebar.ui-sidebar-item
            icon="users"
            to="/users"
            title="User"
        ></x-navigation.sidebar.ui-sidebar-item>
        <x-navigation.sidebar.ui-sidebar-item
            icon="settings"
            to="/setting"
            title="Setting"
        ></x-navigation.sidebar.ui-sidebar-item>
    </div>
</div>
