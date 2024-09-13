<div class="flex flex-col flex-1  bg-white rounded-lg shadow p-4 justify-between">

    <!-- <div class="w-full bg-gray-200 rounded-lg shadow p-4"> -->
    <div class="flex flex-row justify-between items-center w-full min-w-min mt-2 mb-3">
        <h5 class="text-left text-6xl font-bold text-gray-90">{{ $statistic }}</h5>
        <img src="{{ $icon }}" alt="">
    </div>

    <h5 class="text-lg leading-none text-gray-400 pt-3 pr-3 pb-3">{{ $title }}</h5>

    <div class="flex justify-center items-center w-16 h-6 rounded-lg">
        <h6 class="text-sm font-medium leading-none  hidden">
            {{-- @if ($change >= 0)
              + @endif  --}}

        </h6>
    </div>
</div>
