    <main class="wrapper w-full mx-auto py-5 px-3">
            <div>
                <h1 class="text-3xl font-medium text-gray-950 dark:text-white pb-16">Properties</h1>
            </div>
        <header class="flex justify-between">
            <div>
                <h1 class="text-xl font-medium">Import Property <span class="text-sm">This will allow you to automatically import a property</span></h1>
            </div>
        
            
            <a type="button" href="{{ route('properties.import') }}" 
            class="ms:left-2 h-12  ms-10 block text-white bg-secondary-600 hover:bg-secondary-900 focus:ring-4 focus:outline-none focus:ring-secondary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-secondary-600 dark:hover:bg-secondary-700 dark:focus:ring-secondary-800"
            type="button">
            Add Portal 

            </a>
            
        </header>
        <style>
            .fi-ta-cell a.fi-btn, .fi-icon-btn-badge-ctn{
                background-color: white !important;
                color: #004F5C !important; 
                border: 1px solid #004F5C; 
            }
            .fi-ta-cell .fi-ac-btn-action {
                color: red !important;
                background-color: white !important;
                border: 1px solid red;
            }

            .fi-ta-cell .fi-ac-btn-action svg {
                color: red !important;
            }

            .fi-ta-cell .fi-ac-btn-action:hover {
                background-color: red !important;
                color: white !important; /* Assurez-vous que le texte change de couleur si nécessaire */
            }

            .fi-ta-cell .fi-ac-btn-action:hover svg {
                color: white !important;
            }


            .fi-ta-cell a.fi-btn:hover, .fi-icon-btn-badge-ctn:hover {
                background-color: #004F5C !important;
                color: white !important;
                border: 1px solid white;
            }

            .fi-ta-header-ctn {
                display: flex;
                justify-content: space-between; 
                background-color: rgb(249, 250, 251); 
            }

            .fi-ta-header-ctn > * {
                border-top-width: 0 !important; 
                display: inline-block;
                width: auto; 
            }

            /* Changer l'ordre des éléments */
            .fi-ta-header-ctn > :first-child {
                order: 2; /* Déplace le premier élément en deuxième position */
            }

            .fi-ta-header-ctn > :last-child {
                order: 1; /* Déplace le deuxième élément en première position */
            }   

            .my-ta {
                max-width: 100%; 
            }

            .my-ta .fi-ta {
                width: 100%; /* Utilise toute la largeur disponible */
                border-collapse: collapse; /* Pour une bordure plus uniforme */
            }   
            
            .fi-modal-footer-actions .fi-btn[type="button"] {
                color: white !important;
                background-color: red !important;
                border-color: red !important;
            }


        </style>

        <section class="my-ta pt-4 wrapper w-full md:max-w-5xl">
            {{ $this->table }}
        </section>
        

    </main>
<!-- </div> -->
