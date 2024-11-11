<div>
    <div class="flex items-center justify-between mb-3">
        <div class="flex items-center">
            <span class="text-xs text-neutral-500 me-2">Menampilkan</span>
            <select
                class="border w-[3.5rem] border-neutral-500 rounded-[4px] text-xs px-1 py-1 outline-none focus:outline-none focus:ring-0 focus:border-neutral-500"
            >
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
            <span class="text-xs text-neutral-500 ms-2">Data</span>
        </div>
    </div>
    <div class="custom-table-wrapper border border-neutral-300 rounded-md overflow-x-auto striped">
        <table class="custom-table w-full">
            <thead>
            @if(isset($header))
                {{ $header }}
            @endif
            </thead>
            <tbody>
            @if(isset($rows))
                {{ $rows }}
            @endif
            </tbody>
        </table>
    </div>
    <div class="flex justify-end w-full mt-1">
        <div class="flex items-center gap-1 py-1.5 px-1.5" x-data="{page: 1}">
            <a href="#" x-on:click.prevent=""
               class="text-brand-500 cursor-pointer h-6 w-6 rounded-[4px] flex items-center justify-center hover:text-white hover:bg-brand-500 transition-all duration-300 ease-in-out">
                <span class="material-symbols-outlined text-[1em]">
                    first_page
                </span>
            </a>
            <a href="#" x-on:click.prevent=""
               class="text-brand-500 cursor-pointer h-6 w-6 rounded-[4px] flex items-center justify-center hover:text-white hover:bg-brand-500 transition-all duration-300 ease-in-out">
                <span class="material-symbols-outlined text-[1em]">
                    chevron_left
                </span>
            </a>
            <a href="#" x-on:click.prevent=""
               class="bg-brand-500 cursor-pointer text-white h-6 w-6 rounded-[4px] flex items-center justify-center">
                <span class="text-[0.8em]">
                    1
                </span>
            </a>
            <a href="#" x-on:click.prevent=""
               class="text-brand-500 cursor-pointer h-6 w-6 rounded-[4px] flex items-center justify-center hover:text-white hover:bg-brand-500 transition-all duration-300 ease-in-out">
                <span class="material-symbols-outlined text-[1em]">
                    chevron_right
                </span>
            </a>
            <a href="#" x-on:click.prevent=""
               class="text-brand-500 cursor-pointer h-6 w-6 rounded-[4px] flex items-center justify-center hover:text-white hover:bg-brand-500 transition-all duration-300 ease-in-out">
                <span class="material-symbols-outlined text-[1em]">
                    last_page
                </span>
            </a>
        </div>
    </div>
</div>
