<section
    id="section-cashier-cart"
    data-component-id="cashier-cart"
    class="flex-1"
>
    <div class="w-full flex justify-end mb-3">
        <div class="flex gap-1">
            <div class="relative group">
                <div wire:ignore class="h-full flex items-center px-[0.5rem] absolute inset-y-0 start-0">
                    <i data-lucide="scan-barcode"
                       class="text-neutral-500 group-focus-within:text-neutral-900 h-4 aspect-[1/1]"></i>
                </div>
                <input
                    placeholder="scan barcode"
                    class="w-full text-sm ps-[2.05rem] pe-[0.825rem] py-[0.5rem] rounded text-neutral-700 border border-neutral-300 outline-none focus:outline-none focus:ring-0 focus:border-neutral-500 transition duration-300 ease-in"/>
            </div>
            <x-gxui.button.button
                wire:ignore
                x-on:click=""
                class="!w-fit"
                x-bind:disabled="false"
            >
                <div wire:ignore>
                    <i data-lucide="box"
                       class="text-white h-4 aspect-[1/1]"></i>
                </div>
            </x-gxui.button.button>
        </div>
    </div>
    <div class="w-full grid grid-cols-2 gap-3">
        <div class="w-full flex gap-3 bg-white rounded-md shadow-md p-3">
            <img
                src="{{ asset('/assets/images/category/494676e2-dae8-4705-83ce-882be4205b06.png') }}"
                class="h-20 w-20 rounded-md border border-neutral-300 p-1"
                alt="product-image" />
            <div class="flex-1 flex-col gap-1">
                <div class="flex-1">
                    <p class="font-bold text-neutral-700 mb-0 leading-none">Product1</p>
                    <p class="text-xs text-neutral-500 mb-0 leading-none">(PCS)</p>
                    <p class="font-bold text-brand-500">Rp. 50.000</p>
                </div>
                <div class="w-full flex justify-between items-center">
                    <div class="flex items-center">
                        <div>+</div>
                        <div>-</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full bg-white rounded-md shadow-md p-3"></div>
        <div class="w-full bg-white rounded-md shadow-md p-3"></div>
    </div>
</section>
