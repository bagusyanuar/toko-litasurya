<div class="fixed top-0 left-0 h-screen shadow-sidebar w-sidebar flex flex-col bg-background">
    <!-- sidebar header -->
    <div class="w-full px-3">
        <div class="w-full h-20 flex justify-center items-center border-b border-neutral-300 mb-3 ">
            <img
                src="{{ asset('/assets/images/logo.png') }}"
                alt="img-logo"
                class="h-12">
        </div>
    </div>
    <!-- sidebar menu -->
    <div class="w-full flex-grow overflow-y-auto px-3 pb-3">
        <div class="w-full">
            <p class="text-xs text-neutral-400 font-light mb-1">Menu</p>
            <div class="flex flex-col w-full gap-1">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
