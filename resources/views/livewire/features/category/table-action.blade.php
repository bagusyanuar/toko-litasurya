<div
    class="relative"
    x-data="{
        open: false,
        initIcons() {
           setTimeout(() => { lucide.createIcons(); }, 0);
        }
    }"
    x-init="initIcons()"
    x-effect="initIcons()"
>
        <button class="px-4 py-2" wire:ignore x-on:click="open = !open">
            <i data-lucide="ellipsis-vertical" class="h-3 aspect-[1/1]"></i>
        </button>
        <ul x-show="open" x-on:click.away="open = false" class="absolute right-0 top-0 bg-white w-48 border mt-4 rounded shadow-lg">
            <li><button class="block px-4 py-2 text-left" wire:click="archive">Archive</button></li>
            <li><button class="block px-4 py-2 text-left" wire:click="delete">Delete</button></li>
        </ul>

{{--    <button type="button"--}}
{{--            class="bg-warning-500 text-neutral-900 py-1 px-2 rounded-[4px] hover:bg-warning-600 hover:text-white transition-all duration-200 ease-in">--}}
{{--        edit--}}
{{--    </button>--}}
{{--    <div--}}
{{--        class="relative"--}}
{{--        x-data="{ modalDeleteCategory{{ $idx }}: false }"--}}
{{--    >--}}
{{--        <button--}}
{{--            type="button"--}}
{{--            class="bg-danger-500 text-white py-1 px-2 rounded-[4px] hover:bg-danger-700 transition-all duration-200 ease-in"--}}
{{--            x-on:click="modalDeleteCategory{{ $idx }} =  true"--}}
{{--        >--}}
{{--            hapus--}}
{{--        </button>--}}
{{--        <div x-show="modalDeleteCategory{{ $idx }}"--}}
{{--             class="fixed inset-0 bg-gray-500 bg-opacity-50 z-[250]">--}}
{{--        </div>--}}
{{--        <div--}}
{{--            x-show="modalDeleteCategory{{ $idx }}"--}}
{{--            x-transition:enter="transition ease-out duration-300 transform"--}}
{{--            x-transition:enter-start="translate-y-[-100%] opacity-0"--}}
{{--            x-transition:enter-end="translate-y-0 opacity-100"--}}
{{--            x-transition:leave="transition ease-in duration-200 transform"--}}
{{--            x-transition:leave-start="translate-y-0 opacity-100"--}}
{{--            x-transition:leave-end="translate-y-[-100%] opacity-0"--}}
{{--            class="fixed top-8 left-1/2 transform -translate-x-1/2 z-[251] flex items-center justify-center"--}}
{{--        >--}}
{{--            <div class="bg-white rounded shadow-lg w-full max-w-sm max-h-full">--}}
{{--                <div class="p-4">--}}
{{--                    <div class="flex items-start gap-3">--}}
{{--                        <div--}}
{{--                            class="aspect-[1/1] h-[35px] flex items-center justify-center rounded-[4px] bg-danger-100"--}}
{{--                            wire:ignore--}}
{{--                        >--}}
{{--                            <i data-lucide="trash-2" class="h-4 aspect-[1/1] text-danger-500"></i>--}}
{{--                        </div>--}}
{{--                        <div class="flex-grow flex-col items-start justify-start">--}}
{{--                            <div class="mb-1 text-sm text-danger-500 font-semibold text-start">--}}
{{--                                Anda akan menghapus kategori--}}
{{--                            </div>--}}
{{--                            <div class="mb-0 text-xs text-justify text-neutral-700">--}}
{{--                                Apakah anda yakin ingin menghapus kategori "<span--}}
{{--                                    class="font-semibold">{{ $category->name }}</span>"? Kategori yang telah dihapus--}}
{{--                                tidak akan dapat--}}
{{--                                ditampilkan lagi--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div--}}
{{--                    x-data--}}
{{--                    class="flex items-center gap-2 justify-end px-4 py-2.5 border-t border-neutral-300 rounded-b">--}}
{{--                    <button--}}
{{--                        wire:target="onDeleteCategory"--}}
{{--                        wire:loading.attr="disabled"--}}
{{--                        @click="modalDeleteCategory{{ $idx }} = false;"--}}
{{--                        class="py-2 px-3.5 text-xs bg-white border border-[#CBD5E1] text-danger-500 rounded-[4px] hover:bg-danger-50 transition-all duration-200 ease-in"--}}
{{--                    >--}}
{{--                        Batal--}}
{{--                    </button>--}}
{{--                    <button--}}
{{--                        wire:loading.attr="disabled"--}}
{{--                        @click="$wire.onDeleteCategory().then(() => {--}}
{{--                            modalDeleteCategory{{ $idx }} = false;--}}
{{--                        })"--}}
{{--                        class="flex py-2 px-3.5 text-xs border border-brand-500 text-white bg-brand-500 rounded-[4px] hover:bg-brand-700 hover:border-brand-700 transition-all duration-200 ease-in"--}}
{{--                    >--}}
{{--                        <div--}}
{{--                            wire:target="onDeleteCategory"--}}
{{--                            wire:loading--}}
{{--                            class="w-full">--}}
{{--                            <x-loader.button-loader></x-loader.button-loader>--}}
{{--                        </div>--}}
{{--                        <span--}}
{{--                            wire:target="onDeleteCategory"--}}
{{--                            wire:loading.remove--}}
{{--                            class="w-full">--}}
{{--                            Ya, Hapus--}}
{{--                        </span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
</div>

{{--<div class="flex items-center justify-center gap-1"--}}
{{--     x-data="{--}}
{{--        initIcons() {--}}
{{--           setTimeout(() => { lucide.createIcons(); }, 0);--}}
{{--        }--}}
{{--    }"--}}
{{--     x-init="initIcons()"--}}
{{--     x-effect="initIcons()"--}}
{{-->--}}
{{--    <div--}}
{{--        class="w-6 aspect-[1/1] flex items-center justify-center bg-warning-400 text-neutral-900 hover:text-white hover:bg-warning-500 transition-all duration-200 ease-in rounded-[4px] cursor-pointer"--}}
{{--        wire:ignore--}}
{{--    >--}}
{{--        <i data-lucide="pencil" class="h-3 aspect-[1/1]"></i>--}}
{{--    </div>--}}
{{--    <div--}}
{{--        class="w-6 aspect-[1/1] flex items-center justify-center bg-danger-500 text-white hover:bg-danger-700 transition-all duration-200 ease-in rounded-[4px] cursor-pointer"--}}
{{--        wire:ignore--}}
{{--    >--}}
{{--        <i data-lucide="trash-2" class="h-3 aspect-[1/1]"></i>--}}
{{--    </div>--}}
{{--</div>--}}
