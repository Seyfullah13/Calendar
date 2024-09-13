<div>
<form wire:submit.prevent="generalCreate" class="space-y-4">
                    {{ $this->generalForm }}

                    <div class="flex justify-end space-x-2 mr-6">
                        <button type="submit" class="bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-opacity-75">
                            Save
                        </button>
                        
                        <button type="button" class="bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-opacity-75" id="nextButton" onclick="navigateSection('next')">
                            Next
                        </button>
                    </div>
                </form>

                <x-filament-actions::modals />
</div>
