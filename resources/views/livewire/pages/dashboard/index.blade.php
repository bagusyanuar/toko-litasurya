<div>
    <x-gxui.toast.toast></x-gxui.toast.toast>
    <div class="mb-5">
        <x-gxui.typography.page-title text="Dashboard"></x-gxui.typography.page-title>
        <x-gxui.typography.page-sub-title
            text="Welcome to dashboard page. You can see some summary of transaction or master data."></x-gxui.typography.page-sub-title>
    </div>
    <livewire:features.dashboard.widget />
    <div class="w-full grid grid-cols-3 gap-3 mt-5">
        <div class="col-span-2 flex flex-col gap-3">
            <livewire:features.dashboard.selling-chart />
            <div class="flex gap-3">
                <div class="w-full bg-white p-4 rounded-md"></div>
                <div class="w-full bg-white p-4 rounded-md"></div>
            </div>
        </div>
        <div class="col-span-1 flex flex-col gap-3">
            <livewire:features.dashboard.purchasing />
            <livewire:features.dashboard.store-visit />
        </div>
    </div>
</div>
