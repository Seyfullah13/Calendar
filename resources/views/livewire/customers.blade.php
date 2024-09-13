<main class="wrapper w-full mx-auto py-5 px-3">
            <div>
                <h1 class="text-3xl font-medium text-gray-950 dark:text-white pb-16">Clients</h1>
            </div>
        <header class="flex justify-between">
        
            
        </header>

        <style>
            
            .fi-ta-cell .fi-btn:first-of-type, .fi-icon-btn-badge-ctn{
                background-color: white !important;
                color: #004F5C !important; 
                border: 1px solid #004F5C; 
            }


            .fi-ta-cell .fi-btn:first-of-type:hover, .fi-icon-btn-badge-ctn:hover {
                background-color: #004F5C !important;
                color: white !important;
                border: 1px solid white;
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
                color: white !important;
            }

            .fi-ta-cell .fi-ac-btn-action:hover svg {
                color: white !important;
            }

            .fi-ta-header-ctn {
                display: flex;
                justify-content: space-between; 
                background-color: rgb(249, 250, 251); 
            }

            .fi-ta-header-toolbar{
                display: flex;
            }
            .fi-ta-header-toolbar > * {
                width: auto;
            }


            /* Changer l'ordre des éléments */
            .fi-ta-header-ctn > :first-child {
                order: 2; /* Déplace le premier élément en deuxième position */
            }

            .fi-ta-header-ctn > :last-child {
                order: 1; /* Déplace le deuxième élément en première position */
            }  
            


            .fi-ta-header-toolbar .fi-btn {
                color: red !important;
                background-color: white !important;
                border: 1px solid red;
            }

            .fi-ta-header-toolbar .fi-btn svg {
                color: red !important;
            }

            .fi-ta-header-toolbar .fi-btn:hover {
                background-color: red !important;
                color: white !important;
            }

            .fi-ta-header-toolbar .fi-btn:hover svg {
                color: white !important;
            }



            .fi-ta-header-toolbar .fi-btn:first-of-type {
                color: #004F5C !important;
                background-color: white !important;
                border: 1px solid #004F5C;
            }

            .fi-ta-header-toolbar .fi-btn:first-of-type svg {
                color: #004F5C !important;
            }

            .fi-ta-header-toolbar .fi-btn:first-of-type:hover {
                background-color: #004F5C !important;
                color: white !important;
            }

            .fi-ta-header-toolbar .fi-btn:first-of-type:hover svg {
                color: white !important;
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

        <!-- Notifications -->
        @if (session()->has('message'))
        <div class="text-green-500 p-4 bg-green-100 rounded mb-4">
            {{ session('message') }}
        </div>
        @endif

        @if (session()->has('error'))
        <div class="text-red-500 p-4 bg-red-100 rounded mb-4">
            {{ session('error') }}
        </div>
        @endif

        <section class="my-ta pt-4 wrapper w-full md:max-w-5xl">
            {{ $this->table }}
        </section>
        
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Duration for how long the message should be displayed (in milliseconds)
                var displayDuration = 1000; // 10 seconds

                // Success message
                var successMessage = document.getElementById('success-message');
                if (successMessage) {
                    setTimeout(function () {
                        successMessage.style.display = 'none';
                    }, displayDuration);
                }

                // Error message
                var errorMessage = document.getElementById('error-message');
                if (errorMessage) {
                    setTimeout(function () {
                        errorMessage.style.display = 'none';
                    }, displayDuration);
                }
            });
        </script>


    </main>
<!-- </div> -->
