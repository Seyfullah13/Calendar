<main class="wrapper w-full">
    {{-- Page de résumé de la réservation --}}
    <form wire:submit.prevent="create">
        <div class="p-6 border rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4">Review & Confirm</h2>
            <div class="flex ">
                <img src="/storage/{{$property_display_photo}}" alt="Apartment Image" class="w-1/3 rounded">
                <div class="items-center mb-2 ml-6">

                    <h3 class="text-2xl font-medium mt-5 mb-8">
                        @if ($property_display_name)
                            {{$property_display_name}}
                        @else 
                            {{ $property_name }}
                        @endif
                    </h3>
                    <span class="text-3xl mb-8">{{ \Carbon\Carbon::parse($check_in)->locale('fr')->translatedFormat('F d, Y') }} - {{ \Carbon\Carbon::parse($check_out)->locale('fr')->translatedFormat('F d, Y') }}</span>
                    <div class="flex items-center space-x-2 justify-start mt-8">
                        <div class="items-center text-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-6 ml-6 mb-4">
                                <path fill-rule="evenodd"
                                    d="M9.528 1.718a.75.75 0 0 1 .162.819A8.97 8.97 0 0 0 9 6a9 9 0 0 0 9 9 8.97 8.97 0 0 0 3.463-.69.75.75 0 0 1 .981.98 10.503 10.503 0 0 1-9.694 6.46c-5.799 0-10.5-4.7-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 0 1 .818.162Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="ml-1">{{ $number_of_nights }} nights</span>
                        </div>
                        <div class="items-center text-xl ml-6">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-6 ml-6 mb-4">
                                <path fill-rule="evenodd"
                                    d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z"
                                    clip-rule="evenodd" />
                                <path
                                    d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                            </svg>
                            <span class="ml-1">{{ $number_of_guest }} guests</span>
                        </div>
                        <div class="items-center text-xl ml-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-6 ml-6 mb-4" fill="currentColor"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6.256 18.428l1.429-4.285A2.5 2.5 0 0110.28 13h3.439a2.5 2.5 0 012.595 1.143l1.43 4.285A2.5 2.5 0 0116.745 21H7.255a2.5 2.5 0 01-1.257-2.572zM6 10a2 2 0 114 0 2 2 0 01-4 0zm8 0a2 2 0 114 0 2 2 0 01-4 0z" />
                            </svg>
                            <span class="ml-1">{{ $number_of_animals }} animals</span>
                        </div>
                    </div>
                </div>
            </div>

            <p class="text-xl mt-5 mb-8">Guest will receive a link to complete booking and pay.</p>
            <div class="border-gray-200 pt-4">
                <div class="border-t border-gray-200 mt-4 pt-4">
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-medium">Total</span>
                        <span class="text-lg font-semibold">${{ $total_cost }}</span>
                    </div>
                    <p class="text-sm text-gray-500 mt-2">If the guest does not complete the payment in
                        {{ $hold_booking }} hours the dates will be unblocked.</p>
                </div>
            </div>
        </div>

        <div class="flex justify-end space-x-2 mr-6">
            <button type="button"
                class="resetbt-color hover:bg-[#BF283C] mt-6 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-opacity-75"
                id="nextButton" onclick="navigateSection('previous', 'resume')">
                Go back
            </button>

            <button type="submit"
                class="btcolor hover:bg-[#003841] mt-6 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-opacity-75">
                Create quote and notify guest
            </button>

        </div>
    </form>
</main>
