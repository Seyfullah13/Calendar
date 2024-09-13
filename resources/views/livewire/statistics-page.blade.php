<div class="wrapper w-full mx-auto py-5 px-3">
    <div class="text-3xl font-medium text-gray-950 dark:text-white pb-16">
        @include('theme::partials.section-title', ['title' => 'Statistics'])
        <div class="flex justify-end">
            {{-- ! Months drop menu --}}

            <livewire:month-picker :months="$months" :properties_types="$properties_types" />
        </div>

        <!-- Stats tables-->
        <div class="flex flex-wrap gap-4 justify-center pt-5">
            {{--  ! Total Bookings --}}
            <livewire:stats-card title="Total Bookings" icon="./themes/tailwind/images/dashboard_top/group.svg"
                stat_type="total_booking" />

            {{-- ! Total Guests --}}
            <livewire:stats-card title="Total Guests" icon="./themes/tailwind/images/dashboard_top/check.svg"
                stat_type="total_guest" />

            {{-- ! Check-in --}}
            <livewire:stats-card title="Check-in" icon="./themes/tailwind/images/dashboard_top/right-arrow.svg"
                stat_type="check_in" />

            {{-- ! Check-out --}}
            <livewire:stats-card title="Check-out" icon="./themes/tailwind/images/dashboard_top/left-arrow.svg"
                stat_type="check_out" />

            {{-- ! Canceled --}}
            <livewire:stats-card title="Canceled" icon="./themes/tailwind/images/dashboard_top/cross.svg"
                stat_type="canceled" />

        </div>
        {{-- ! Charts  --}}
        <div class="flex gap-4 my-5 ">
            <div class="flex-1">
                <livewire:radial-bar-chart :data="$radialChart" />
            </div>
            <div class="flex-1">
                <livewire:donut-chart :data="$donutChart" />
            </div>
        </div>
        <div>
            <livewire:heat-map-chart :data="$heatmap" />
        </div>
    </div>

</div>


<script>
    // const monthSelect = document.getElementById('monthSelect');
    // const propertySelect = document.getElementById('propertySelect');

    // function handleSelectChange() {
    //     const selectedMonth = monthSelect.value;
    //     const selectedProperty = propertySelect.value;
    //     console.log('Selected Month:', selectedMonth);
    //     console.log('Selected Property:', selectedProperty);

    //     // Trigger your desired function here
    //     // For example, you can send the values to a Livewire component
    //     // @this.call('handleSelectChange', selectedMonth, selectedProperty);
    //     $wire.call('filter', selectedMonth, selectedProperty);
    // }

    // monthSelect.addEventListener('change', handleSelectChange);
    // propertySelect.addEventListener('change', handleSelectChange);
</script>
