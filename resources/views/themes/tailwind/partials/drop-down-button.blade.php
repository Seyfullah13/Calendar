<div class="ms-2 me-2">

    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown-{{ $id }}"
        class="bg-white text-gray-700 border border-gray-300 rounded-lg text-sm font-medium leading-6 px-4 py-2 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 shadow-sm inline-flex items-center "
        type="button">{{ $name }} <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 4 4 4-4" />
        </svg>
    </button>

    <!-- Dropdown menu -->
    <div id="dropdown-{{ $id }}"
        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700">
        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" style="width: min-content"
            aria-labelledby="dropdownDefaultButton">
            @if (!isset($menus))
                <li>
                    <a href="#"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">No
                        menu</a>
                </li>
            @else
                @foreach ($menus as $menu)
                    <li id="{{ $name . '-' . $id }}" data-value="{{ $menu->value }}"
                        class=" px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white cursor-pointer">
                        {{ $menu->name }}
                    </li>
                @endforeach
            @endif
        </ul>
    </div>

</div>
