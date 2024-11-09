<div
    class="w-full rounded-md flex items-center gap-2 text-xs font-light {{ $active ? 'text-white bg-brand-500' : 'text-neutral-400' }}  p-3 cursor-pointer transition-all ease-in duration-200 hover:bg-brand-500 hover:text-white">
    <i data-lucide="{{ $icon }}" class="h-4 aspect-[1/1]"></i>
    <a href="{{ $to }}" class="w-full flex items-center">
        {{ $title }}
    </a>
</div>
