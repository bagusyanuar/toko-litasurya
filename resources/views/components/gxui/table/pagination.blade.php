<div class="flex items-center justify-between gap-3">
    <div class="text-sm text-neutral-500">Total Rows : <span
            class="font-semibold text-neutral-700">{{ $totalRows }}</span></div>
    <div class="flex items-center">
        <div class="flex gap-2 items-center text-sm text-neutral-500">
            <span>Lines per page</span>
            <select
                class="border border-neutral-500 w-fit appearance-none rounded-[4px] text-sm pl-2 !pr-[1.5rem] py-1 outline-none focus:outline-none focus:ring-0 focus:border-neutral-500 cursor-pointer"
                style="
                        background-position: right 0.5rem center;
                        background-image: url('data:image/svg+xml,%3csvg aria-hidden=%27true%27 xmlns=%27http://www.w3.org/2000/svg%27 fill=%27none%27 viewBox=%270 0 16 16%27%3e%3cpath stroke=%27%236B7280%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27 stroke-width=%272%27 d=%27m2 6 6-6 6 6 m-12 4 6 6 6-6%27/%3e%3c/svg%3e');
                        "
            >
                <template x-for="value in {{ $perPageOptions }}">
                    <option :value="value" x-text="value"></option>
                </template>
            </select>
        </div>
        <div class="flex items-center gap-1 py-1.5 px-1.5" wire:ignore>
            <a href="#" x-on:click.prevent=""
               class="text-brand-500 cursor-pointer h-6 aspect-[1/1] rounded-full flex items-center justify-center hover:bg-brand-50 transition-all ease-in duration-200">
                <i data-lucide="chevron-left"
                   class="text-neutral-500 group-focus-within:text-neutral-900 h-4 aspect-[1/1]">
                </i>
            </a>
            <template x-for="value in {{ $shownPages }}">
                <a href="#" x-on:click.prevent=""
                   class="text-xs cursor-pointer h-6 aspect-[1/1] rounded-full flex items-center justify-center"
                   x-bind:class="value === {{ $currentPage }} ? 'bg-brand-500 text-white' : 'bg-transparent text-brand-500 hover:bg-brand-50 transition-all ease-in duration-200'"
                   x-text="value"
                ></a>
            </template>
            <a href="#" x-on:click.prevent=""
               class="text-brand-500 cursor-pointer h-6 aspect-[1/1] rounded-full flex items-center justify-center hover:bg-brand-50 transition-all ease-in duration-200">
                <i data-lucide="chevron-right"
                   class="text-neutral-500 group-focus-within:text-neutral-900 h-4 aspect-[1/1]">
                </i>
            </a>
        </div>
    </div>
</div>
