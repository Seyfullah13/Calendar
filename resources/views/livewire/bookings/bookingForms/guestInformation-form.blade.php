<main class="wrapper w-full">
    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Guest Information</h3>

    <form wire:submit="" class="space-y-4">

        {{ $this->guestInformationForm }}

        <div id="guestError" class="text-red-500 font-bold hidden">
            Please save your changes before proceeding to the next step.
        </div>

        <div class="flex justify-end space-x-2 mr-6">
            <button type="button" wire:click="sendData"
                class="btcolor hover:bg-[#003841] mt-6 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-opacity-75"
                id="guestsaveButton">
                save
            </button>

            <button type="button"
                class="resetbt-color hover:bg-[#BF283C] mt-6 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-secondary-400 focus:ring-opacity-75"
                id="previousButton" onclick="navigateSection('previous', 'guest')">
                Back
            </button>

            <button type="button"
                class="btcolor hover:bg-[#003841] mt-6 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-opacity-75"
                id="nextButton" onclick="checkIfQuestSaved()">
                Next
            </button>

        </div>
    </form>
</main>

<script>
    function checkIfQuestSaved() {

        if (@this.get('isSaved')) {
            navigateSection('next', 'guest');
        } else {
            document.getElementById('guestError').classList.remove('hidden');
        }
    }
</script>
