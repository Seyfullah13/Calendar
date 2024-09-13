<div>
    <h2 class="mb-2">{{ $label }}</h2>
    <div class="flex gap-2 text-xs font-semibold">
        <div class="radio_container px-4 py-1 border border-gray-950 rounded-lg flex items-center justify-center gap-4">
            <label for="{{ $name . '_radio_1' }}">1</label>
            <input type="radio" name="{{ $name }}" id="{{ $name . '_radio_1' }}" value="1">
        </div>
        <div class="radio_container px-4 py-1 border border-gray-950 rounded-lg flex items-center justify-center gap-4">
            <label for="{{ $name . '_radio_2' }}">2</label>
            <input type="radio" name="{{ $name }}" id="{{ $name . '_radio_2' }}" value="2">
        </div>
        <div class="radio_container px-4 py-1 border border-gray-950 rounded-lg flex items-center justify-center gap-4">
            <label for="{{ $name . '_radio_3' }}">3</label>
            <input type="radio" name="{{ $name }}" id="{{ $name . '_radio_3' }}" value="3">
        </div>
        <div class="radio_container px-4 py-1 border border-gray-950 rounded-lg flex items-center justify-center gap-4">
            <label for="{{ $name . '_radio_4' }}">4</label>
            <input type="radio" name="{{ $name }}" id="{{ $name . '_radio_4' }}" value="4">
        </div>
        <div class="radio_container px-2 py-1 border border-gray-950 rounded-lg flex items-center justify-center gap-4">
            <label for="{{ $name . '_radio_more' }}" class="relative">
                <input 
                    type="number" 
                    name="{{ $name . '_more' }}" 
                    id="{{ $name . '_input_more' }}" 
                    placeholder="More"
                    min="5"
                    class="border-none text-xs w-24"
                >
                <div class="arrows absolute top-1/2 right-0 -translate-y-1/2 flex flex-col h-4/5">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="chevron-up w-4 h-4 hover:bg-gray-200"><polyline points="18 15 12 9 6 15"></polyline></svg>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="chevron-down w-4 h-4 hover:bg-gray-200"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </div>
            </label>
        </div>
    </div>

    <style>
        input[type='number'] {
            -moz-appearance: textfield;
            -webkit-appearance: textfield;
            appearance: textfield;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let name = "{{ $name }}";
            let more_input_btn_ + name = document.getElementById(name + '_input_more');
            let more_radio_btn_ + name = document.getElementById(name + '_radio_more');   

            more_input_btn.addEventListener('focus', function() {
                more_radio_btn.click();
            });

            more_input_btn.addEventListener('change', function() {
                more_radio_btn.click();

                if (more_input_btn.value < 1) {
                    document.getElementById(name + '_radio_1').click();
                    more_input_btn.value = '';
                } else if (more_input_btn.value < 5) {
                    document.getElementById(name + '_radio_' + more_input_btn.value).click();
                    more_input_btn.value = '';
                }
            });

            more_radio_btn.addEventListener('change', function() {
                if (!more_radio_btn.checked) {
                    more_input_btn.value = '';
                }
            });

            document.querySelector('.chevron-up').addEventListener('click', function() {
                if (more_input_btn.value === '') {
                    more_input_btn.value = 5;
                } else {
                    more_input_btn.value++;
                }
            });

            document.querySelector('.chevron-down').addEventListener('click', function() {
                if (more_input_btn.value > 5) {
                    more_input_btn.value--;
                }
            });
        });
    </script>
</div>
