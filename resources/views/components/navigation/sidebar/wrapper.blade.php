<div class="fixed top-0 left-0 h-screen shadow-sidebar w-sidebar px-3">
    <!-- sidebar header -->
    <div class="w-full h-24 flex justify-center items-center border-b border-neutral-300 mb-3">
        <img
            src="{{ asset('/assets/images/logo.png') }}"
            alt="img-logo"
            class="h-16">
    </div>
    <div class="w-full flex flex-col">
        <p class="text-sm text-neutral-400 font-light mb-1">Menu</p>
        <div class="flex flex-col w-full gap-1 font-light">
            <div
                class="w-full rounded-md flex items-center gap-2 text-sm text-neutral-400 p-3 cursor-pointer transition-all ease-in duration-200 hover:bg-brand-500 hover:text-white">
                <i data-lucide="house" class="h-5 aspect-[1/1]"></i>
                <a href="#" class="w-full flex items-center">
                    Dashboard
                </a>
            </div>
            <div
                class="w-full rounded-md flex items-center gap-2 text-sm text-neutral-400 p-3 cursor-pointer transition-all ease-in duration-200 hover:bg-brand-500 hover:text-white">
                <i data-lucide="database" class="h-5 aspect-[1/1]"></i>
                <a href="#" class="w-full flex items-center">
                    Master
                </a>
            </div>
            <div
                class="w-full rounded-md flex items-center gap-2 text-sm text-neutral-400 p-3 cursor-pointer transition-all ease-in duration-200 hover:bg-brand-500 hover:text-white">
                <i data-lucide="shopping-bag" class="h-5 aspect-[1/1]"></i>
                <a href="#" class="w-full flex items-center">
                    Kasir
                </a>
            </div>
            <div
                class="w-full rounded-md flex items-center gap-2 text-sm text-neutral-400 p-3 cursor-pointer transition-all ease-in duration-200 hover:bg-brand-500 hover:text-white">
                <i data-lucide="arrow-left-right" class="h-5 aspect-[1/1]"></i>
                <a href="#" class="w-full flex items-center">
                    Penukaran Poin
                </a>
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
