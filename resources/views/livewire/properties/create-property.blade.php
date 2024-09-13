<main class="wrapper w-full mx-auto py-5 px-3 flex flex-col">
    <header class="flex justify-between mb-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-950 dark:text-white">Add Property</h1>
        </div>
    </header>

    <style>

        .tab-link {
            color: black;
            padding: 0.75rem 1rem;
            margin-bottom: 0.25rem;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            border-radius: 0.5rem;
        }

        .tab-link:hover {
            background-color: lightblue;
            color: white;
        }

        .tab-link.active {
            color: white;
            background-color: #004f5c;
            position: relative;
        }

        .tab-link.active::after {
            content: '';
            width: 24px;
            height: 24px;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="white" d="M13.025 1l-2.847 2.828 6.176 6.176h-16.354v3.992h16.354l-6.176 6.176 2.847 2.828 10.975-11z"/></svg>') center center no-repeat;
        }

        .description {
            background-color: inherit;
            font-size: 12px;
            margin-top: 0.25rem;
        }

        .tab-item {
            margin-bottom: 1rem;
        }

        .sidebar {
            height: 100%;
            padding-top: 1rem;
        }

        .hidden {
            display: none;
        }

        .custom-input-style {
            position: relative;
            top: 100%; 
            height: 122%;
            text-align: center;
        }
        .back-link {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            color: black;
            text-decoration: none;
        }

        .back-link svg {
            margin-right: 0.5rem;
            width: 24px;
            height: 24px;
            fill: currentColor;
        }

        /* Définir la couleur personnalisée */
        :root {
            --custom-color: #004F5C;
        }

        /* Lorsqu'un élément radio est sélectionné */
        input.peer:checked ~ .fi-color-custom {
            background-color: var(--custom-color) !important; /* Couleur de fond lorsque sélectionné */
            border-color: var(--custom-color) !important; /* Couleur de bordure lorsque sélectionné */
        }

        /* Bordure de l'icône en blanc lorsque l'élément radio est sélectionné */
        input.peer:checked ~ .fi-color-custom svg {
            stroke: white !important; /* Bordure blanche pour l'icône lorsque sélectionné */
        }

        /* Texte blanc pour le <span> lorsque l'élément radio est sélectionné */
        input.peer:checked ~ .fi-color-custom .place-items-start .font-medium {
            color: white !important; /* Couleur du texte blanche lorsque sélectionné */
        }

        /* Couleur de la bordure lorsque l'élément radio n'est pas sélectionné */
        label.flex.cursor-pointer.gap-x-3 {
            border-color: var(--custom-color) !important; /* Bordure de couleur personnalisée */
        }

        /* Couleur de l'icône lorsque l'élément n'est pas sélectionné */
        .fi-color-custom svg {
            stroke: var(--custom-color) !important; /* Bordure personnalisée pour l'icône lorsque non sélectionné */
        }

        /* Couleur du texte lorsque l'élément radio n'est pas sélectionné */
        .fi-color-custom .place-items-start .font-medium {
            color: var(--custom-color) !important; /* Couleur du texte personnalisée lorsque non sélectionné */
        }


    </style>

    <div class="flex-grow flex overflow-hidden">
        <div class="w-1/4 flex-shrink-0 sidebar">
            <a href="/properties" class="back-link">
                <svg width="24" height="12" viewBox="0 0 24 12" xmlns="http://www.w3.org/2000/svg">
                    <path fill="black" d="M10.975 1l2.847 2.828-6.176 6.176h16.354v-3.992H10.2l6.197 6.197-2.999 -2.828L-2 10z"/>
                </svg>

                Back to Properties
            </a>
            <ul class="flex flex-col space-y-4 text-lg font-medium text-gray-500 dark:text-gray-400">
                <li class="tab-item">
                    <a href="#details" onclick="showSection('details', this); return false;" class="tab-link inline-flex items-start rounded-lg w-full active">
                        Property Details
                        <p class="description">Property type and address</p>
                    </a>
                </li>
                <li class="tab-item">
                    <a href="#attribute" onclick="showSection('attribute', this); return false;" class="tab-link inline-flex items-start rounded-lg w-full">
                        Property Attributes
                        <p class="description">Room, currency and other details</p>
                    </a>
                </li>
                <li class="tab-item">
                    <a href="#picture" onclick="showSection('picture', this); return false;" class="tab-link inline-flex items-start rounded-lg w-full">
                        Pictures and description
                        <p class="description">Add photos and description</p>
                    </a>
                </li>
                <li class="tab-item">
                    <a href="#rule" onclick="showSection('rule', this); return false;" class="tab-link inline-flex items-start rounded-lg w-full">
                        Property Rules
                        <p class="description">Rules for the property.</p>
                    </a>
                </li>
                <li class="tab-item">
                    <a href="#platform" onclick="showSection('platform', this); return false;" class="tab-link inline-flex items-start rounded-lg w-full">
                        Platforms
                        <p class="description">Platforms the property is listed on.</p>
                    </a>
                </li>
            </ul>
        </div>

        <div class="flex-grow px-4 top-0 overflow-y-auto">
            <div id="details" class="section p-6 bg-gray-50 text-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 rounded-lg" style="display: block;">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">General</h3>
                <form wire:submit.prevent="generalCreate" class="space-y-4">
                    {{ $this->generalForm }}

                    <div class="flex justify-end space-x-2 mr-6">
                        <button type="submit" class="bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-opacity-75">
                            Save
                        </button>
                        <button type="submit" class="bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-opacity-75" id="nextButton" onclick="navigateSection('next')">
                            Next
                        </button>
                    </div>
                </form>

                <x-filament-actions::modals />
            </div>

            <div id="attribute" class="section p-6 bg-gray-50 text-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 rounded-lg" style="display: none;">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Attribute Tab</h3>
    
                <form wire:submit.prevent="attributeCreate">
                    {{ $this->attributeForm }}

                    <div class="flex justify-end space-x-2 mr-6 p-4">
                        <button type="submit" class="bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-opacity-75" >
                            Save
                        </button>
                        <button type="button" class="bg-secondary-500 hover:bg-secondary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-secondary-400 focus:ring-opacity-75" id="previousButton" onclick="navigateSection('previous')">
                            Back
                        </button>
                        <button type="button" class="bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-opacity-75" id="nextButton" onclick="navigateSection('next')">
                            Next
                        </button>
                    </div>
                </form>

                <x-filament-actions::modals />
            </div>

            <div id="picture" class="section p-6 bg-gray-50 text-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 rounded-lg" style="display: none;">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Picture</h3>
                <p class="mb-6">Ceci est une description du formulaire. Veuillez utiliser les commutateurs pour activer ou désactiver les options.</p>
                
                <form wire:submit="photoCreate">
                    {{ $this->photoForm }}
                    <div class="flex justify-end space-x-2 mr-6 p-4">
                        <button type="submit" class="bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-opacity-75" >
                            Save
                        </button>
                        <button type="button" class="bg-secondary-500 hover:bg-secondary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-secondary-400 focus:ring-opacity-75" id="previousButton" onclick="navigateSection('previous')">
                            Back
                        </button>
                        <button type="button" class="bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-opacity-75" id="nextButton" onclick="navigateSection('next')">
                            Next
                        </button>
                    </div>
                </form>
            </div>

            <div id="rule" class="section p-6 bg-gray-50 text-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 rounded-lg" style="display: none;">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">House rules</h3>
                <p class="mb-6">Ceci est une description du formulaire. Veuillez utiliser les commutateurs pour activer ou désactiver les options.</p>
                <form wire:submit.prevent="ruleCreate">
                    {{ $this->ruleForm }}

                    <div class="flex justify-end space-x-2 mr-6 p-4">
                        <button type="submit" class="bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-opacity-75">
                            Save
                        </button>
                        <button type="button" class="bg-secondary-500 hover:bg-secondary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-secondary-400 focus:ring-opacity-75" id="previousButton" onclick="navigateSection('previous')">
                            Back
                        </button>
                        <button type="button" class="bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-opacity-75" id="nextButton" onclick="navigateSection('next')">
                            Next
                        </button>
                    </div>
                </form>

                <x-filament-actions::modals />
            </div>

            <div id="platform" class="section p-6 bg-gray-50 text-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 rounded-lg" style="display: none;">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Platforms</h3>
                <p class="mb-6">Ceci est une description du formulaire. Veuillez utiliser les commutateurs pour activer ou désactiver les options.</p>
                <hr class="my-4">

                <form wire:submit.prevent="platformCreate">
                    {{ $this->platformForm }}

                    <div class="flex justify-end space-x-2 mr-6 p-4">
                        
                        <button type="button" class="bg-secondary-500 hover:bg-secondary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-secondary-400 focus:ring-opacity-75" id="previousButton" onclick="navigateSection('previous')">
                            Back
                        </button>
                        <button type="submit" class="bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-opacity-75">
                            Save
                        </button>
                    </div>
                </form>

                <x-filament-actions::modals />
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add active class to the first tab link (Property Details)
            const hash = window.location.hash.substring(1);
            if (hash) {
                showSection(hash, document.querySelector(`a[href="#${hash}"]`));
            } else {
                showSection('details', document.querySelector('a[href="#details"]'));
            }
            updateButtonsVisibility();
        });

        function showSection(sectionId, element) {
            // Hide all sections
            document.querySelectorAll('.section').forEach(function(section) {
                section.style.display = 'none';
            });

            // Show the selected section
            document.getElementById(sectionId).style.display = 'block';

            // Remove active class from all links
            document.querySelectorAll('.tab-link').forEach(function(link) {
                link.classList.remove('active');
            });

            // Add active class to the clicked link
            element.classList.add('active');

            updateButtonsVisibility();
        }

        function navigateSection(direction) {
            const sections = ['details', 'attribute', 'picture', 'rule', 'platform'];
            let currentIndex = sections.findIndex(sectionId => document.getElementById(sectionId).style.display === 'block');

            if (direction === 'next' && currentIndex < sections.length - 1) {
                showSection(sections[currentIndex + 1], document.querySelector(`a[href="#${sections[currentIndex + 1]}"]`));
            } else if (direction === 'previous' && currentIndex > 0) {
                showSection(sections[currentIndex - 1], document.querySelector(`a[href="#${sections[currentIndex - 1]}"]`));
            }
        }

        function updateButtonsVisibility() {
            const sections = ['details', 'attribute', 'picture', 'rule', 'platform'];
            let currentIndex = sections.findIndex(sectionId => document.getElementById(sectionId).style.display === 'block');

            document.getElementById('previousButton').classList.toggle('hidden', currentIndex === 0);
            document.getElementById('nextButton').classList.toggle('hidden', currentIndex === sections.length - 1);
        }

        document.addEventListener('livewire:load', function () {
            window.addEventListener('sectionUpdated', function (event) {
                const sectionId = event.detail.sectionId;
                showSection(sectionId, document.querySelector(`a[href="#${sectionId}"]`));
                updateButtonsVisibility();
            });
        });

        
    </script>
</main>
