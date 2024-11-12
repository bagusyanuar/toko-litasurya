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
            <th class="py-4 px-3 text-start text-xs font-semibold">Category Name</th>
            <th class="py-4 px-3 text-center text-xs font-semibold w-[120px]">Aksi</th>
        </tr>
    </x-slot>
    <x-slot name="rows">
        @foreach($data as $datum)
            <tr>
                <td class="text-xs py-3 px-3 text-center">
                    {{ $loop->index + 1 }}
                </td>
                <td class="text-xs py-3 px-3 text-center w-[4rem]">
                    -
                </td>
                <td class="text-xs py-3 px-3 text-start">
                    {{ $datum->name }}
                </td>
                <td class="text-xs py-3 px-3 text-center">
                    -
                </td>
            </tr>
        @endforeach
    </x-slot>
</x-table.table>
