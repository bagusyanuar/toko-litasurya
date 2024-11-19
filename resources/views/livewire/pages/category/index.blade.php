<div>
    <x-alert.success
        message="{{ $sessionMessage }}"
    ></x-alert.success>
    <x-alert.error
        message="{{ $sessionMessage }}"
    ></x-alert.error>
    <x-typography.page-title
        title="Halaman Kategori"
        class="mb-3"
    ></x-typography.page-title>
    <x-container.card>
        <div class="flex items-center justify-between mb-3">
            <x-typography.section-title
                title="Data Kategori"
            ></x-typography.section-title>
            <livewire:features.category.create/>
        </div>
        <x-spacer.divider class="mb-3"></x-spacer.divider>
        <livewire:features.category.lists/>
    </x-container.card>

{{--    <div class="overflow-x-auto">--}}
{{--        <table class="min-w-full">--}}
{{--            <thead>--}}
{{--            <tr>--}}
{{--                <th class="px-4 py-2">Item</th>--}}
{{--                <th class="px-4 py-2">Actions</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody>--}}
{{--            <tr>--}}
{{--                <td class="border px-4 py-2">Sample Item</td>--}}
{{--                <td class="border px-4 py-2">--}}
{{--                    <div x-data="{ open: false }" class="relative inline-block">--}}
{{--                        <button @click="open = !open" class="bg-blue-500 text-white px-4 py-2 rounded">--}}
{{--                            Options--}}
{{--                        </button>--}}
{{--                        <ul x-show="open" @click.outside="open = false" class="absolute bg-white border mt-1 rounded shadow-lg z-[150]">--}}
{{--                            <li><button class="block px-4 py-2 text-left" wire:click="archive">Archive</button></li>--}}
{{--                            <li><button class="block px-4 py-2 text-left" wire:click="delete">Delete</button></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--            </tbody>--}}
{{--        </table>--}}
{{--    </div>--}}
</div>
