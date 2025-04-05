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
            active="{{ \Illuminate\Support\Facades\Route::is('transaction*') }}"
        ></x-gxui.sidebar.item>
        <x-gxui.sidebar.item
            icon="archive"
            to="/master-data"
            title="Master Data"
            active="{{ \Illuminate\Support\Facades\Route::is('master-data*') }}"
        ></x-gxui.sidebar.item>
        <x-gxui.sidebar.item
            icon="users"
            to="/users"
            title="User Account"
            active="{{ \Illuminate\Support\Facades\Route::is('users*') }}"
        ></x-gxui.sidebar.item>
        <x-gxui.sidebar.item
            icon="chart-pie"
            to="/report"
            title="Reports & Analytics"
            active="{{ \Illuminate\Support\Facades\Route::is('setting*') }}"
        ></x-gxui.sidebar.item>
        <x-gxui.sidebar.item
            icon="settings"
            to="/setting"
            title="Setting"
            active="{{ \Illuminate\Support\Facades\Route::is('setting*') }}"
        ></x-gxui.sidebar.item>
    </div>
</div>
