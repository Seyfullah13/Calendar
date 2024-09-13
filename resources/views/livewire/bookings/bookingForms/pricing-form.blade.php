<main class="wrapper w-full">
    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Pricing</h3>

    <form wire:submit.prevent="create" class="space-y-4">
        {{ $this->pricingForm }}

        <div id="pricingError" class="text-red-500 font-bold hidden">
            Please save your changes before proceeding to the next step.
        </div>

        <div class="flex justify-end space-x-2 mr-6">
            <button type="button" wire:click="resetRate"
                class="resetbt-color hover:bg-[#BF283C] mt-6 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-opacity-75">
                Reset rates
            </button>

            @if ($priceData['type_of_payement'] != 'manualprice')
                <button type="button" wire:click="sendData"
                    class="btcolor hover:bg-[#003841] mt-6 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-opacity-75"
                    id="pricingsaveButton">
                    save
                </button>

                <button type="button"
                    class="resetbt-color hover:bg-[#BF283C] mt-6 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-opacity-75"
                    id="previousButton" onclick="navigateSection('previous', 'pricing')">
                    Back
                </button>

                <button type="button" id="nextButton" onclick="checkIfPricingSaved()"
                    class="btcolor hover:bg-[#003841] mt-6 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-opacity-75">
                    Continue
                </button>
            @else
                <button type="button"
                    class="resetbt-color hover:bg-[#BF283C] mt-6 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-opacity-75"
                    id="previousButton" onclick="navigateSection('previous', 'pricing')">
                    Back
                </button>
                <button type="submit"
                    class="btcolor hover:bg-[#003841] mt-6 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-opacity-75">
                    Create booking
                </button>
            @endif

        </div>
    </form>

</main>

<script>
    function checkIfPricingSaved() {
        if (@this.get('isSaved')) {
            navigateSection('next', 'pricing');
        } else {
            document.getElementById('pricingError').classList.remove('hidden');
        }
    }
</script>
