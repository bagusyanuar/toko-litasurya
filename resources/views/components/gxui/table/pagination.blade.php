<div class="flex items-center justify-between gap-3">
    <div x-show="$store.{{ $store }}.loading" class="flex items-center gap-1">
        <x-gxui.loader.shimmer class="!w-24"></x-gxui.loader.shimmer>
        <x-gxui.loader.shimmer class="!w-8"></x-gxui.loader.shimmer>
    </div>
    <div x-show="!$store.{{ $store }}.loading" class="text-sm text-neutral-500">Total Data : <span
            class="font-semibold text-neutral-700" x-text="$store.{{ $store }}.totalRows"></span></div>

    <div class="flex items-center">
        <div x-show="$store.{{ $store }}.loading" class="flex gap-2 items-center">
            <x-gxui.loader.shimmer></x-gxui.loader.shimmer>
            <x-gxui.loader.shimmer class="!w-8 !h-6"></x-gxui.loader.shimmer>
        </div>
        <div x-show="$store.{{ $store }}.loading" class="flex gap-1 items-center ms-2">
            <template x-for="i in 3">
                <x-gxui.loader.shimmer class="!h-4 !w-4"></x-gxui.loader.shimmer>
            </template>
        </div>
        <div x-show="!$store.{{ $store }}.loading" class="flex gap-2 items-center text-sm text-neutral-500">
            <span>Lines per page</span>
            <select
                class="border border-neutral-500 w-fit appearance-none rounded-[4px] text-sm pl-2 !pr-[1.5rem] py-1 outline-none focus:outline-none focus:ring-0 focus:border-neutral-500 cursor-pointer"
                style="
                        background-position: right 0.5rem center;
                        background-image: url('data:image/svg+xml,%3csvg aria-hidden=%27true%27 xmlns=%27http://www.w3.org/2000/svg%27 fill=%27none%27 viewBox=%270 0 16 16%27%3e%3cpath stroke=%27%236B7280%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27 stroke-width=%272%27 d=%27m2 6 6-6 6 6 m-12 4 6 6 6-6%27/%3e%3c/svg%3e');
                        "
                x-on:change="
                   Alpine.store('{{$store}}').perPage = $event.currentTarget.value;
                   Alpine.store('{{$store}}').{{ $dispatcher }}();
                "
            >
                <template x-for="value in $store.{{ $store }}.perPageOptions">
                    <option :value="value" x-text="value"></option>
                </template>
            </select>
        </div>
        <div x-show="!$store.{{ $store }}.loading" class="flex items-center gap-1 py-1.5 px-1.5" wire:ignore>
            <button
                class="h-6 aspect-[1/1] rounded-full flex items-center justify-center text-brand-500 cursor-pointer hover:bg-brand-50 transition-all ease-in duration-200 disabled:text-neutral-300 disabled:cursor-default disabled:hover:bg-transparent"
                x-bind:disabled="($store.{{ $store }}.page == 1 || $store.{{ $store }}.totalPages <= 0)"
                x-on:click="
                   Alpine.store('{{$store}}').page -= 1;
                   Alpine.store('{{$store}}').{{ $dispatcher }}();
                "
            >
                <i data-lucide="chevron-left"
                   class="h-4 aspect-[1/1]">
                </i>
            </button>
            <template x-for="value in $store.{{ $store }}.shownPages">
                <a href="#"
                   x-on:click.prevent=""
                   x-on:click="
                       Alpine.store('{{$store}}').page = value;
                       Alpine.store('{{$store}}').{{ $dispatcher }}();
                    "
                   class="text-xs cursor-pointer h-6 aspect-[1/1] rounded-full flex items-center justify-center"
                   x-bind:class="value === $store.{{ $store }}.page ? 'bg-brand-500 text-white' : 'bg-transparent text-brand-500 hover:bg-brand-50 transition-all ease-in duration-200'"
                   x-text="value"
                ></a>
            </template>
            <button
                x-on:click="
                   Alpine.store('{{$store}}').page += 1;
                   Alpine.store('{{$store}}').{{ $dispatcher }}();
                "
                class="h-6 aspect-[1/1] rounded-full flex items-center justify-center text-brand-500 cursor-pointer hover:bg-brand-50 transition-all ease-in duration-200 disabled:text-neutral-300 disabled:cursor-default disabled:hover:bg-transparent"
                x-bind:disabled="($store.{{ $store }}.page == $store.{{ $store }}.totalPages || $store.{{ $store }}.totalPages <= 0)"
            >
                <i data-lucide="chevron-right"
                   class="h-4 aspect-[1/1]">
                </i>
            </button>
        </div>
    </div>
</div>
