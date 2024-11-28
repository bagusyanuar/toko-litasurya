<section id="section-table-categories">
    <x-table.table
        x-init="$nextTick(() => {
                $wire.getDataCategories();
            })"
        @fetch-categories.window="$wire.set('onLoading', true)"
        :pageLength="$pageLength"
        :totalRows="$totalRows"
        :currentPage="$currentPage"
        :perPage="$perPage"
        perPageModel="perPage"
        currentPageModel="currentPage"
        onPerPageChange="$wire.onPerPageChange()"
        onPageChange="$wire.onPageChange()"
        onNextPageChange="$wire.onNextPage()"
        onLastPageChange="$wire.onLastPage(lastPage)"
        onPreviousPageChange="$wire.onPreviousPage()"
        onFirstPageChange="$wire.onFirstPage()"
    >
        <x-slot name="extensions">
            <x-table.components.search
                paramModel="param"
                dispatcher="onSearch"
                placeholder="cari..."
            ></x-table.components.search>
        </x-slot>
        <x-slot name="header">
            <tr class="bg-brand-50">
                <th class="py-4 px-3 text-center text-xs font-semibold w-[50px]">No</th>
                <th class="py-4 px-3 text-center text-xs font-semibold w-[8rem]">Gambar</th>
                <th class="py-4 px-3 text-start text-xs font-semibold">Nama Kategori</th>
                <th class="py-4 px-3 text-center text-xs font-semibold w-[120px]">Aksi</th>
            </tr>
        </x-slot>
        <x-slot name="rows">
            @forelse($data as $datum)
                <tr class="border-b border-neutral-300">
                    <td class="text-xs py-3 px-3 text-center">
                        {{ ($currentPage - 1) * $perPage + ($loop->index + 1) }}
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
                            wire:key="{{ uniqid('diagnosis-icd10-'. $loop->index) }}"
                        />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">
                        <x-table.components.empty-table></x-table.components.empty-table>
                    </td>
                </tr>
            @endforelse
        </x-slot>
    </x-table.table>
</section>
