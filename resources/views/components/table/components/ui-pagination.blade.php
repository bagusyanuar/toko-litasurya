<div class="flex justify-between items-center w-full mt-1"
     x-data="{
            currentPage: {{ $currentPage }},
            shownPages: {{ $shownPages }},
            totalPage: {{ $totalPage }},
            initialWatch() {
                $watch('{{ $shownPages }}', value => {
                    this.shownPages = value;
                });
                $watch('{{ $currentPage }}', value => {
                    this.currentPage = value;
                });
            }
         }"
     x-init="initialWatch()"
>
    <div>
        <span class="text-xs text-neutral-500">Total data <span x-text="currentPage"></span></span>
    </div>
    <div class="flex items-center gap-1 py-1.5 px-1.5">
        <a href="#" x-on:click.prevent="currentPage = 1; {{ $onFirstPageChange }}"
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
        <template
            x-for="page in shownPages"
        >
            <div>
                <a
                    href="#"
                    x-on:click.prevent="currentPage = page; {{ $onPageChange }}; "
                    x-bind:class="{
                       'bg-brand-500 cursor-pointer text-white h-6 w-6 rounded-[4px] flex items-center justify-center': currentPage === page,
                       'bg-white cursor-pointer text-brand-500 h-6 w-6 rounded-[4px] flex items-center justify-center hover:text-white hover:bg-brand-500 transition-all duration-300 ease-in-out': currentPage !== page
                    }"
                >
                    <span class="text-[0.8rem]" x-text="page"></span>
                </a>
            </div>
        </template>
        <a href="#" x-on:click.prevent="{{ $onNextPageChange }}"
           class="text-brand-500 cursor-pointer h-6 w-6 rounded-[4px] flex items-center justify-center hover:text-white hover:bg-brand-500 transition-all duration-300 ease-in-out">
            <span class="material-symbols-outlined text-[1em]">
                chevron_right
            </span>
        </a>
        <a href="#" x-on:click.prevent="{{ $onLastPageChange }}"
           class="text-brand-500 cursor-pointer h-6 w-6 rounded-[4px] flex items-center justify-center hover:text-white hover:bg-brand-500 transition-all duration-300 ease-in-out">
            <span class="material-symbols-outlined text-[1em]">
                last_page
            </span>
        </a>
    </div>
</div>
