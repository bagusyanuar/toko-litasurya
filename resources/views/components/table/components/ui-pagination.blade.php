<div class="flex justify-between items-center w-full mt-1">
    <div>
        <span class="text-xs text-neutral-500">Total data</span>
    </div>
    <div class="flex items-center gap-1 py-1.5 px-1.5">
        <a href="#" x-on:click.prevent="{{ $onFirstPageChange }}"
           class="text-brand-500 cursor-pointer h-6 w-6 rounded-[4px] flex items-center justify-center hover:text-white hover:bg-brand-500 transition-all duration-300 ease-in-out">
            <span class="material-symbols-outlined text-[1rem]">
                first_page
            </span>
        </a>
        <a href="#" x-on:click.prevent="{{ $onPreviousPageChange }}"
           class="text-brand-500 cursor-pointer h-6 w-6 rounded-[4px] flex items-center justify-center hover:text-white hover:bg-brand-500 transition-all duration-300 ease-in-out">
            <span class="material-symbols-outlined text-[1rem]">
                chevron_left
            </span>
        </a>
        <a href="#"
           x-on:click.prevent="{{ $onPageChange }}"
           class="bg-white cursor-pointer text-brand-500 h-6 w-6 rounded-[4px] flex items-center justify-center hover:text-white hover:bg-brand-500 transition-all duration-300 ease-in-out">
            <span class="text-[0.8rem]">
                1
            </span>
        </a>
    </div>
</div>
