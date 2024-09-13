<div class="flex">
    <div id="datepicker-custom" class="flex space-x-2">
        <select id="start-month"
            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
            @foreach ($months as $month)
                <option data-days={{ $month->days }} value="{{ $month->value }}"
                    {{ $month->value === $currentMonth ? 'selected' : '' }}>
                    {{ $month->name }}</option>
            @endforeach
        </select>
        <select id="start-year"
            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
            @foreach ($years as $year)
                <option value="{{ $year }}" {{ $year == $currentYear ? 'selected' : '' }}>{{ $year }}
                </option>
            @endforeach
        </select>
    </div>
    {{-- !  --}}
    <svg class="h-5 mx-3 self-center" xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
        <path
            d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l370.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128z" />
    </svg>
    {{-- ! --}}
    <div id="datepicker-custom" class="flex space-x-2">
        <select id="end-month"
            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
            @foreach ($months as $month)
                <option data-days={{ $month->days }} value="{{ $month->value }}"
                    {{ $month->value == $currentMonth ? 'selected' : '' }}>
                    {{ $month->name }}</option>
            @endforeach
        </select>
        <select id="end-year"
            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
            @foreach ($years as $year)
                <option value="{{ $year }}" {{ $year == $currentYear ? 'selected' : '' }}>{{ $year }}
                </option>
            @endforeach
        </select>
    </div>


    {{-- ! Properties drop-menu --}}
    <div class="ms-2 me-2">
        <select id="propertySelect"
            class="bg-white text-gray-700 border border-gray-300 rounded-lg text-sm font-medium leading-6 px-4 py-2 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 shadow-sm inline-flex items-center">

            <option class=" px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white cursor-pointer"
                value="0" selected>Property</option>
            @foreach ($properties_types as $type)
                <option class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white cursor-pointer"
                    value="{{ $type->id }}">{{ $type->name }}</option>
            @endforeach
        </select>
    </div>

</div>

{{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> --}}

@script
    <script>
        const propertySelect = document.querySelector('#propertySelect');
        const startMonth = document.querySelector('#start-month');
        const startYear = document.querySelector('#start-year');
        const endMonth = document.querySelector('#end-month');
        const endYear = document.querySelector('#end-year');

        let start, end;

        function handleSelectChange() {
            let days = endMonth[endMonth.selectedIndex].getAttribute('data-days');
            console.log('start :', startMonth.value, startYear.value);
            console.log('end :', endMonth.value, endYear.value);
            console.log('Selected Property:', propertySelect.value);
            start = `${startYear.value}-${startMonth.value}-01`;
            end = `${endYear.value}-${endMonth.value}-${days}`;


            // {
            //     month: startMonth.value,
            //     year: startYear.value
            // };
            // end = {
            //     month: endMonth.value,
            //     year: endYear.value
            // };

            $wire.call('filter_dispache', start, end, propertySelect.value);
        }

        startMonth.addEventListener('change', handleSelectChange);
        startYear.addEventListener('change', handleSelectChange);
        endMonth.addEventListener('change', handleSelectChange);
        endYear.addEventListener('change', handleSelectChange);
        propertySelect.addEventListener('change', handleSelectChange);
    </script>
@endscript
