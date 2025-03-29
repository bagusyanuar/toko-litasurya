<div class="w-64 bg-white rounded-lg shadow-md px-4 py-3 flex flex-col">
    <div class="w-full mb-3">
        <p class="text-neutral-700 text-sm font-bold mb-3">Sales Team List</p>
        <hr class="mb-3" />
        <x-gxui.table.dynamic.search
            store="scheduleTeamStore"
            dispatcher="onFindAll"
        ></x-gxui.table.dynamic.search>
    </div>
    <div class="w-full h-56 overflow-y-auto">
        <div class="w-full flex justify-between items-center py-2.5 border-b rounded cursor-pointer">
            <div class="flex-1">
                <p class="text-xs font-semibold text-neutral-700">Jono</p>
            </div>
            <div
                wire:ignore
                class="text-neutral-700"
            >
                <i data-lucide="chevron-right" class="h-3" style="width: fit-content;"></i>
            </div>
        </div>
        <div class="w-full flex justify-between items-center py-2.5 border-b rounded cursor-pointer">
            <div class="flex-1">
                <p class="text-xs font-semibold text-neutral-700">Jono</p>
            </div>
            <div
                wire:ignore
                class="text-neutral-700"
            >
                <i data-lucide="chevron-right" class="h-3" style="width: fit-content;"></i>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('scheduleTeamStore', {
                onFindAll() {}
            });
        });
    </script>
@endpush
