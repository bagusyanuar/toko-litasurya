<div
    x-show="$store.alertStore.open"
    x-transition:enter="transition ease-out duration-300 transform"
    x-transition:enter-start="translate-x-full opacity-0"
    x-transition:enter-end="translate-x-0 opacity-100"
    x-transition:leave="transition ease-in duration-300 transform"
    x-transition:leave-start="translate-x-0 opacity-100"
    x-transition:leave-end="translate-x-full opacity-0"
    class="fixed top-5 right-5 bg-white h-16 w-72 flex rounded shadow-lg z-[300]"
    style="display: none;"
    x-init="
        $watch('$store.alertStore.open', value => {
            if(value) {
                setTimeout(() =>  { $store.alertStore.close() }, {{ $timeToClose }})
            }
        })
    "
>
    <div x-cloak x-show="$store.alertStore.type === 'success'"
        class="w-1.5 h-full bg-green-500 rounded-tl rounded-bl"
    ></div>
    <div x-cloak x-show="$store.alertStore.type === 'error'"
        class="w-1.5 h-full bg-red-500 rounded-tl rounded-bl"
    ></div>
    <div class="flex-1 flex p-2 gap-2">
        <div
            wire:ignore
        >
            <i data-lucide="circle-check" x-show="$store.alertStore.type === 'success'" x-cloak class="text-green-500 h-6 aspect-[1/1]"></i>
            <i data-lucide="circle-x" x-show="$store.alertStore.type === 'error'" x-cloak class="text-red-500 h-6 aspect-[1/1]"></i>
        </div>
        <div class="flex-1 flex flex-col">
            <template x-if="$store.alertStore.type === 'success'">
                <span class="block font-semibold text-sm">Success</span>
            </template>
            <template x-if="$store.alertStore.type === 'error'">
                <span class="block font-semibold text-sm">Error</span>
            </template>

            <span class="text-xs text-neutral-700" x-text="$store.alertStore.message"></span>
        </div>
        <div
            wire:ignore
            class="cursor-pointer text-neutral-500 hover:text-neutral-700 transition ease-out duration-300"
            x-on:click="$store.alertStore.closeAlert()"
        >
            <i data-lucide="x" class="h-4 aspect-[1/1]"></i>
        </div>
    </div>
</div>
