<section id="section-table-categories">
    <x-table.table
        x-init="$nextTick(() => {
                $wire.getDataCategories();
            })"
        @fetch-categories.window="$wire.set('onLoading', true)"
    >
        <x-slot name="header">
            <tr class="bg-brand-50">
                <th class="py-4 px-3 text-center text-xs font-semibold w-[50px]">No</th>
                <th class="py-4 px-3 text-center text-xs font-semibold w-[8rem]">Gambar</th>
                <th class="py-4 px-3 text-start text-xs font-semibold">Nama Kategori</th>
                <th class="py-4 px-3 text-center text-xs font-semibold w-[120px]">Aksi</th>
            </tr>
        </x-slot>
        <x-slot name="rows">
            @foreach($data as $datum)
                <tr class="border-b border-neutral-300">
                    <td class="text-xs py-3 px-3 text-center">
                        {{ $loop->index + 1 }}
                    </td>
                    <td class="text-xs py-3 px-3 text-center w-[4rem]">
                        <div class="w-full flex items-center justify-center">
                            <div
                                class="w-12 aspect-[1/1] border border-neutral-300 rounded-sm p-1 flex items-center justify-center">
                                <img
                                    src="{{ asset($datum->image) }}"
                                    alt=""
                                    class="w-full h-full object-cover object-center cursor-pointer"
                                >
                            </div>
                        </div>
                    </td>
                    <td class="text-xs py-3 px-3 text-start">
                        {{ $datum->name }}
                    </td>
                    <td class="text-xs py-3 px-3 text-center">
                        <livewire:features.category.table-action
                            :idx="$loop->index"
                            :category="$datum"
                            wire:key="{{ uniqid('table-action-') }}"
                        />
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-table.table>
</section>
