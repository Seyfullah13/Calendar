<main class="wrapper w-full ">
    {{-- <section class="pt-4"> --}}

    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Booking Settings</h3>
    <form wire:submit="updateBooking" class="space-y-4">

        {{ $this->form }}


        <div class="flex justify-end space-x-2 mr-6">


            <button type="button"
            wire:click = "cancel"
                class="resetbt-color hover:bg-[#BF283C] text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-opacity-75"
                >
                Cancel
            </button>

            <button type="submit"
                class="btcolor hover:bg-[#003841] text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-opacity-75">
                Save
            </button>

        </div>
    </form>
    <x-filament-actions::modals />
    {{-- </section> --}}
</main>
