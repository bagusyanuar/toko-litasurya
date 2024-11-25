<div
    class=""
    x-data="{ {{ $modalKey }}: false,
            initIcons() {
               setTimeout(() => { lucide.createIcons(); }, 0);
            }
    }"
    x-init="initIcons()"
>
    <button
        type="button"
        {{ $attributes->merge(['class' => $baseClass]) }}
        x-on:click="{{ $modalKey }} =  true"
    >
        hapus
    </button>
    <div x-show="{{ $modalKey }}"
         class="fixed inset-0 bg-gray-500 bg-opacity-50 z-[250]">
    </div>
    <div
        x-show="{{ $modalKey }}"
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="translate-y-[-100%] opacity-0"
        x-transition:enter-end="translate-y-0 opacity-100"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="translate-y-0 opacity-100"
        x-transition:leave-end="translate-y-[-100%] opacity-0"
        class="fixed top-8 left-1/2 transform -translate-x-1/2 z-[251] flex items-center justify-center"
    >
        <div class="bg-white rounded shadow-lg w-full max-w-sm max-h-full">
            <div class="p-4">
                <div class="flex items-start gap-3">
                    <div
                        class="aspect-[1/1] h-[35px] flex items-center justify-center rounded-[4px] bg-danger-100"
                        wire:ignore
                    >
                        <i data-lucide="trash-2" class="h-4 aspect-[1/1] text-danger-500"></i>
                    </div>
                    <div class="flex-grow flex-col items-start justify-start">
                        <div class="mb-1 text-sm text-danger-500 font-semibold text-start">
                            {{ $title }}
                        </div>
                        <div class="mb-0 text-xs text-justify text-neutral-700">
                            Apakah anda yakin ingin menghapus {{ $targetMenu }} "<span
                                class="font-semibold">{{ $targetName }}</span>"? {{ $targetMenu }} yang telah dihapus
                            tidak akan dapat
                            ditampilkan lagi
                        </div>
                    </div>
                </div>
            </div>
            <div
                x-data
                class="flex items-center gap-2 justify-end px-4 py-2.5 border-t border-neutral-300 rounded-b">
                <button
                    wire:target="{{ $processTargetLoading }}"
                    wire:loading.attr="disabled"
                    x-on:click="{{ $modalKey }} = false;"
                    class="py-2 px-3.5 text-xs bg-white border border-[#CBD5E1] text-danger-500 rounded-[4px] hover:bg-danger-50 transition-all duration-200 ease-in disabled:cursor-default"
                >
                    Batal
                </button>
                <button
                    wire:loading.attr="disabled"
                    x-on:click="{{ $processTarget }}.then(() => {
                            {{ $modalKey }} = false;
                        })"
                    class="flex gap-1 py-2 px-3.5 text-xs border border-brand-500 text-white bg-brand-500 rounded-[4px] hover:bg-brand-700 hover:border-brand-700 transition-all duration-200 ease-in"
                >
                    <div
                        wire:target="{{ $processTargetLoading }}"
                        wire:loading
                        class="w-full">
                        <x-loader.button-loader></x-loader.button-loader>
                    </div>
                    <span
                        wire:target="{{ $processTargetLoading }}"
                        wire:loading.remove
                        class="w-full">
                            Ya, Hapus
                        </span>
                </button>
            </div>
        </div>
    </div>
</div>
