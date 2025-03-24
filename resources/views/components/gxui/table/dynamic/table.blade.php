<div class="w-full rounded-lg border border-neutral-300 overflow-x-auto">
    <!--    header   -->
    @if(isset($header))
        <div class="flex items-center rounded-t-lg bg-brand-50 w-full text-xs">
            {{ $header }}
        </div>
    @endif

    <!--   rows   -->
    @if(isset($rows))
        <div class="w-full" x-cloak x-show="!$store.sellingReportTableStore.loading">
            <template x-for="(data, index) in $store.sellingReportTableStore.data" :key="index">
                {{ $rows }}
            </template>
        </div>
    @endif

    @if(isset($footer))
        <div class="flex items-center rounded-t-lg bg-brand-50 w-full text-xs">
            {{ $footer }}
        </div>
    @endif
</div>
