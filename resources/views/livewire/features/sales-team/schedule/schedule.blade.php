<section
    id="section-sales-team-schedule"
    data-component-id="sales-team-schedule"
    class="flex-1"
>
    <div class="w-full">
        <p class="text-neutral-700 font-bold text-sm mb-3">Schedule List</p>
        <div class="w-full grid grid-cols-3 gap-3">
            <div class="w-full h-32 border border-neutral-300 rounded-md"></div>
            <div class="w-full h-24 border border-neutral-300 rounded-md"></div>
            <div class="w-full h-24 border border-neutral-300 rounded-md"></div>
        </div>
    </div>
</section>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('salesTeamScheduleStore', {
                component: null,
                loading: true,
                data: [],
                selectedSales: '',
                availableSchedule: [
                    {key: 0, label: 'Sunday'},
                    {key: 1, label: 'Monday'},
                    {key: 2, label: 'Tuesday'},
                    {key: 3, label: 'Wednesday'},
                    {key: 4, label: 'Thursday'},
                    {key: 5, label: 'Friday'},
                    {key: 6, label: 'Saturday'},
                ],
                init: function () {
                    const componentID = document.querySelector('[data-component-id="sales-team-list"]')?.getAttribute('wire:id');
                    Livewire.hook('component.init', ({component}) => {
                        if (component.id === componentID) {
                            this.component = component;
                        }
                    })
                },

            });
        });
    </script>
@endpush
