<section
    id="patient-discharge-diagnoses"
    class="mb-3"
    x-data="{ loading: $wire.entangle('onLoading') }"
    x-init="$nextTick(() => {
        $wire.getDataCategories();
    })"
    @fetch-categories.window="$wire.set('onLoading', true)"
>
    <div class="w-full" x-show="loading">Loading</div>
    <div class="w-full"
         x-show="!loading"
         x-cloak
    >
        <x-table.table>
            <x-slot name="header">
                <tr class="bg-brand-50">
                    <th class="py-4 px-3 text-center text-xs font-semibold min-w-[50px]">No</th>
                    <th class="py-4 px-3 text-center text-xs font-semibold min-w-[120px]">Category Name</th>
                    <th class="py-4 px-3 text-center text-xs font-semibold min-w-[120px]">Aksi</th>
                </tr>
            </x-slot>
            <x-slot name="rows">
                <tr>
                    <td class="text-xs py-3 px-3 text-center">
                        1
                    </td>
                    <td class="text-xs py-3 px-3 text-center">
                        Kategori 1
                    </td>
                    <td class="text-xs py-3 px-3 text-center">
                       -
                    </td>
                </tr>
            </x-slot>
        </x-table.table>
    </div>
</section>
