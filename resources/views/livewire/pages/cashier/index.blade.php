<div>
    <x-gxui.toast.toast></x-gxui.toast.toast>
    <div class="mb-5">
        <x-gxui.typography.page-title text="Cashier"></x-gxui.typography.page-title>
        <x-gxui.typography.page-sub-title
            text="Welcome to cashier page. You can create transaction on this page."></x-gxui.typography.page-sub-title>
    </div>
    <div class="w-full flex gap-3">
        <livewire:features.cashier.cart/>
        <livewire:features.cashier.billing/>
    </div>
</div>
