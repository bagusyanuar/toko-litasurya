<div
    class="w-full flex items-center gap-3 rounded-md px-4 py-3.5 cursor-pointer {{ $active ? 'text-brand-500 bg-brand-50' : 'text-neutral-500' }} hover:text-brand-500 hover:bg-brand-50 transition-all ease-in duration-200"
>
    <i data-lucide="{{ $icon }}" class="h-6 aspect-[1/1]"></i>
    <a href="{{ $to }}" class="">
        {{ $title }}
    </a>
</div>
