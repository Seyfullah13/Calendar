<div>
<form wire:submit.prevent="platformCreate">
                    {{ $this->platformForm }}

                    <div class="flex justify-end space-x-2 mr-6 p-4">
                        
                        <button type="button" class="bg-secondary-500 hover:bg-secondary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-secondary-400 focus:ring-opacity-75" id="previousButton" onclick="navigateSection('previous')">
                            Previous
                        </button>
                        
                        <button type="submit" class="bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-opacity-75">
                            Save
                        </button>
                        
                    </div>
                </form>

                <x-filament-actions::modals />
</div>
