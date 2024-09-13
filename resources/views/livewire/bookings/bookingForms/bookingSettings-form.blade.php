<main class="wrapper w-full">
    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Booking Settings</h3>
    <form wire:submit.prevent="create">

        {{ $this->bookingSettingsForm }}

        <div id="booking-settingsError" class="text-red-500 font-bold hidden">
            Please save your changes before proceeding to the next step.
        </div>
        <div class="flex justify-end space-x-2 mr-6">

            @if (!$block)
                <button type="button" wire:click.prevent="sendData"
                    class="btcolor hover:bg-[#003841] text-white font-bold mt-6 py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-opacity-75"
                    id="booking-settingssaveButton">
                    Save
                </button>

                <button type="button"
                    class="btcolor bg-[#003841] hover:bg-[#003841] text-white font-bold mt-6 py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-opacity-75"
                    id="nextButton"
                    onclick="checkIfSaved()">
                    Next
                </button>
            @else
                <button type="submit"
                    class="btcolor hover:bg-[#003841] text-white font-bold mt-6 py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-opacity-75">
                    Create
                </button>
            @endif

        </div>
    </form>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    let propertyField = document.getElementById('settingData.property_id');

    if (propertyField) {
        propertyField.addEventListener('change', function () {
            // Réinitialiser la valeur à null immédiatement
            @this.set('settingData.property_id', null);

            setTimeout(function () {
                // Obtenir la nouvelle valeur sélectionnée
                let newValue = propertyField.value;
                @this.set('settingData.property_id', newValue);
            }, 1);
        });
    }
});

    function checkIfSaved() {

        if (@this.get('isSaved')) {
            navigateSection('next', 'booking-settings');
        } else {
            document.getElementById('booking-settingsError').classList.remove('hidden');
        }
    }
</script>