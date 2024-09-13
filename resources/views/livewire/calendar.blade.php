<div class="wrapper w-full mx-auto py-5 px-3 h-full">
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.7/build/css/intlTelInput.css">


    <h1 class="text-3xl font-medium text-gray-950 dark:text-white pb-16">Calendar</h1>


    <div class="flex flex-wrap justify-between items-center h-full px-5">

        @if (!$hasProperties)
            <p>Aucune propriété disponible.</p>
        @else

                <div class=" flex flex-wrap  py-5 ">

                    <!-- Bouton de recherche -->

                    <div class="relative ms-4  w-96">
                        <div class="absolute  inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class=" w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        
                        <input type="text" id="searchInput"
                            class="w-96 p-3 ps-10 text-sm text-gray-500 border border-gray-300 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Search" />

                        <div class="absolute inset-y-0 end-0 flex items-center pe-3">
                            <button type="button" id="clearSearch" class="text-gray-500 dark:text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                    </div>

                    <!-- Bouton de filtre -->
                    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                        class="ms-4 text-gray-500 border border-gray-300 bg-white hover:bg-red-700 focus:ring-4 focus:outline-none focus:bg-red-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button">Filter <svg class=" ms-3  w-4 h-4 text-gray-500 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M5.05 3C3.291 3 2.352 5.024 3.51 6.317l5.422 6.059v4.874c0 .472.227.917.613 1.2l3.069 2.25c1.01.742 2.454.036 2.454-1.2v-7.124l5.422-6.059C21.647 5.024 20.708 3 18.95 3H5.05Z" />
                        </svg>

                    </button>

                    <!-- Dropdown menu -->

                    <div id="dropdown"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-100 dark:bg-gray-700 justify-center">
                        <ul class="items-center  py-2 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownDefaultButton">
                            <li>
                                <p class="text-center">Date</p>
                            </li>
                            <li class="text-center">
                                du <input type="date" id="checkinDate" class="border border-gray-300 rounded-lg "
                                    placeholder="Date de check-in"> au <input type="date" id="checkoutDate"
                                    class="border border-gray-300 rounded-lg " placeholder="Date de check-out">
                                </lic>
                            <li>
                                <p class="text-center">Prix</p>
                            </li>
                            <li>

                                <input type="number" id="priceFilterMin" class="border border-gray-300 rounded-lg "
                                    placeholder="Prix minimum"> / <input type="number" id="priceFilter"
                                    class="border border-gray-300 rounded-lg " placeholder="Prix maximum">
                            </li>
                            <li>
                                <input type="number" class="  border border-gray-300 rounded-lg " id="guestFilter"
                                    placeholder="nombre de guest max">
                            </li>
                        </ul>
                    </div>


                    <!-- Bouton de reglages -->
                    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown2"
                        class="ms-4 text-gray-500 border border-gray-300 bg-white hover:bg-red-400 focus:ring-4 focus:outline-none focus:bg-red-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button">Table setings <svg class=" ms-3 w-4 h-4 text-gray-500  dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M9.586 2.586A2 2 0 0 1 11 2h2a2 2 0 0 1 2 2v.089l.473.196.063-.063a2.002 2.002 0 0 1 2.828 0l1.414 1.414a2 2 0 0 1 0 2.827l-.063.064.196.473H20a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-.089l-.196.473.063.063a2.002 2.002 0 0 1 0 2.828l-1.414 1.414a2 2 0 0 1-2.828 0l-.063-.063-.473.196V20a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2v-.089l-.473-.196-.063.063a2.002 2.002 0 0 1-2.828 0l-1.414-1.414a2 2 0 0 1 0-2.827l.063-.064L4.089 15H4a2 2 0 0 1-2-2v-2a2 2 0 0 1 2-2h.09l.195-.473-.063-.063a2 2 0 0 1 0-2.828l1.414-1.414a2 2 0 0 1 2.827 0l.064.063L9 4.089V4a2 2 0 0 1 .586-1.414ZM8 12a4 4 0 1 1 8 0 4 4 0 0 1-8 0Z"
                                clip-rule="evenodd" />
                        </svg>


                    </button>

                    <!-- Dropdown menu -->

                    <div id="dropdown2"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-100 dark:bg-gray-700">
                        <ul class="items-center py-2 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownDefaultButton">
                            <li>
                                <label>
                                    <input type="checkbox" id="showPayoutFilter">
                                    Afficher le prix
                                </label>
                            </li>
                            <li>
                                <button type="button"
                                    class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                                    id="toggleResourceWidth">Masquer les ressources</button>

                            </li>
                        </ul>
                    </div>

                </div>
                <!-- Ajouter un booking -->

                <!-- Modal toggle -->

                <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                    class="ms:left-2 h-12  ms-10 block text-white bg-teal-500 hover:bg-teal-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button">
                    Add Booking <svg class="w-8 h-8 text-white dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 12h14m-7 7V5" />
                    </svg>

                </button>

                <!-- Main modal -->
                <div id="crud-modal" tabindex="-1" aria-hidden="true"
                     class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full">


                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    Add Booking
                                </h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-toggle="crud-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <form class="p-4 md:p-5">
                                <div class="grid gap-4 mb-4 grid-cols-2">
                                    <div class="col-span-2">
                                        <label for="name"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                        <input type="text" name="name" id="name"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Type product name" required="">
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="price"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                                        <input type="number" name="price" id="price"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="$2999" required="">
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="category"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                        <select id="category"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            <option selected="">Select category</option>
                                            <option value="TV">TV/Monitors</option>
                                            <option value="PC">PC</option>
                                            <option value="GA">Gaming/Console</option>
                                            <option value="PH">Phones</option>
                                        </select>
                                    </div>
                                    <div class="col-span-2">
                                        <label for="description"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                                            Description</label>
                                        <textarea id="description" rows="4"
                                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Write product description here"></textarea>
                                    </div>
                                </div>
                                <button type="submit"
                                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Add new product
                                </button>
                            </form>
                        </div>
                    </div>
                </div>


    </div>

            <span id="emailError"></span>
            <!-- Modal -->
            <!-- Main modal -->
            <div id="eventModal" data-modal-placement="top-right" tabindex="-1" aria-hidden="true"
                class="hidden fixed top-6 right-0 z-50 justify-center items-center w-auto bg-white shadow-lg" style="height: 150%;">
                <div class="relative w-full max-w-full max-h-full">

                    <!-- Modal content -->
                    <!-- Modal header -->
                    <div class="relative flex flex-col border-b rounded-t" style="margin: 0.25em 1.5em">
                        <div class="flex items-center justify-between w-full">
                            <h3 class="text-lg font-semibold text-gray-900 w-64">
                                <span id="modalProperty"></span>
                            </h3>
                            <img id="modalPartnerIcon" alt="Partner Icon" class="w-12 h-12 mt-5">
                            <button id="closeButton" type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 inline-flex justify-center items-center">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <p class="text-xs font-normal text-gray-500 dark:text-gray-400">Booking ID : <span
                                id="modalExternal"></span></p>
                        <div class="flex mt-3 ">
                            <h3 class="text-lg font-semibold text-gray-900 text-left mb-2  mr-2">
                                <span id="modalGuestName"></span>
                            </h3>
                            <svg id="iconMessage" class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M3 5.983C3 4.888 3.895 4 5 4h14c1.105 0 2 .888 2 1.983v8.923a1.992 1.992 0 0 1-2 1.983h-6.6l-2.867 2.7c-.955.899-2.533.228-2.533-1.08v-1.62H5c-1.105 0-2-.888-2-1.983V5.983Zm5.706 3.809a1 1 0 1 0-1.412 1.417 1 1 0 1 0 1.412-1.417Zm2.585.002a1 1 0 1 1 .003 1.414 1 1 0 0 1-.003-1.414Zm5.415-.002a1 1 0 1 0-1.412 1.417 1 1 0 1 0 1.412-1.417Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>

                    </div>

                    <!-- Modal body -->
                    <div class="px-6 md:px-6">
                        <h3 class="text-lg font-semibold text-gray-900">Personal Info</h3>
                        <ul class="space-y-3 flex-col items-center">

                            <p id="labelInput" class="mt-1">Phone</p>
                            <li>
                                <span id="Phone" class="text-sm text-gray-500 dark:text-gray-400""><span id=" phoneSpan"
                                    class="
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            flex items-center justify-between p-2 text-base font-bold text-gray-900 rounded-lg
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            bg-gray-100 ">
                                    <span
                                        class="
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            flex items-center "><svg
                                            xmlns=" http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                                        </svg>
                                        <input type="text" id="phoneValue" class="flex-grow p-2 " />
                                    </span>
                                    <span class="flex items-center">
                                        <button><svg id="whatsappButton" fill="#26d046"
                                                class="w-6 h-6 rounded-lg hover:bg-gray-200" version="1.1" id="Layer_1"
                                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                                viewBox="0 0 308 308" xml:space="preserve">

                                                <g id="SVGRepo_bgCarrier" stroke-width="0" />

                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

                                                <g id="SVGRepo_iconCarrier">
                                                    <g id="XMLID_468_">
                                                        <path id="XMLID_469_"
                                                            d="M227.904,176.981c-0.6-0.288-23.054-11.345-27.044-12.781c-1.629-0.585-3.374-1.156-5.23-1.156 c-3.032,0-5.579,1.511-7.563,4.479c-2.243,3.334-9.033,11.271-11.131,13.642c-0.274,0.313-0.648,0.687-0.872,0.687 c-0.201,0-3.676-1.431-4.728-1.888c-24.087-10.463-42.37-35.624-44.877-39.867c-0.358-0.61-0.373-0.887-0.376-0.887 c0.088-0.323,0.898-1.135,1.316-1.554c1.223-1.21,2.548-2.805,3.83-4.348c0.607-0.731,1.215-1.463,1.812-2.153 c1.86-2.164,2.688-3.844,3.648-5.79l0.503-1.011c2.344-4.657,0.342-8.587-0.305-9.856c-0.531-1.062-10.012-23.944-11.02-26.348 c-2.424-5.801-5.627-8.502-10.078-8.502c-0.413,0,0,0-1.732,0.073c-2.109,0.089-13.594,1.601-18.672,4.802 c-5.385,3.395-14.495,14.217-14.495,33.249c0,17.129,10.87,33.302,15.537,39.453c0.116,0.155,0.329,0.47,0.638,0.922 c17.873,26.102,40.154,45.446,62.741,54.469c21.745,8.686,32.042,9.69,37.896,9.69c0.001,0,0.001,0,0.001,0 c2.46,0,4.429-0.193,6.166-0.364l1.102-0.105c7.512-0.666,24.02-9.22,27.775-19.655c2.958-8.219,3.738-17.199,1.77-20.458 C233.168,179.508,230.845,178.393,227.904,176.981z" />
                                                        <path id="XMLID_470_"
                                                            d="M156.734,0C73.318,0,5.454,67.354,5.454,150.143c0,26.777,7.166,52.988,20.741,75.928L0.212,302.716 c-0.484,1.429-0.124,3.009,0.933,4.085C1.908,307.58,2.943,308,4,308c0.405,0,0.813-0.061,1.211-0.188l79.92-25.396 c21.87,11.685,46.588,17.853,71.604,17.853C240.143,300.27,308,232.923,308,150.143C308,67.354,240.143,0,156.734,0z M156.734,268.994c-23.539,0-46.338-6.797-65.936-19.657c-0.659-0.433-1.424-0.655-2.194-0.655c-0.407,0-0.815,0.062-1.212,0.188 l-40.035,12.726l12.924-38.129c0.418-1.234,0.209-2.595-0.561-3.647c-14.924-20.392-22.813-44.485-22.813-69.677 c0-65.543,53.754-118.867,119.826-118.867c66.064,0,119.812,53.324,119.812,118.867 C276.546,215.678,222.799,268.994,156.734,268.994z" />
                                                    </g>
                                                </g>

                                            </svg>
                                        </button>

                                        <button><svg id="updatePhoneBtn" class="ml-2 w-6 h-6 text-gray-800 dark:text-white"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                            </svg>

                                        </button>
                                    </span>

                                </span>
                                </span>

                            </li>
                            <li>
                                <div id="phoneInputContainer"
                                    class=" hidden  p-1 border-2 border-gray-300 rounded-lg h-6  flex justify-between items-center">
                                    <input type="text" id="phoneInputValue" class="flex-grow p-2 border-0  rounded" />



                                    <div class="flex justify-end items-center">
                                        <a href="" id="cancelPhoneButton"><svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                height="42" viewBox="0 0 16 18" fill="none">
                                                <path
                                                    d="M3 18C2.45 18 1.97934 17.8043 1.588 17.413C1.19667 17.0217 1.00067 16.5507 1 16V3C0.71667 3 0.479337 2.904 0.288004 2.712C0.0966702 2.52 0.000670115 2.28267 3.44827e-06 2C-0.000663218 1.71733 0.0953369 1.48 0.288004 1.288C0.48067 1.096 0.718003 1 1 1H5C5 0.716667 5.096 0.479333 5.288 0.288C5.48 0.0966668 5.71734 0.000666667 6 0H10C10.2833 0 10.521 0.0960001 10.713 0.288C10.905 0.48 11.0007 0.717333 11 1H15C15.2833 1 15.521 1.096 15.713 1.288C15.905 1.48 16.0007 1.71733 16 2C15.9993 2.28267 15.9033 2.52033 15.712 2.713C15.5207 2.90567 15.2833 3.00133 15 3V16C15 16.55 14.8043 17.021 14.413 17.413C14.0217 17.805 13.5507 18.0007 13 18H3ZM13 3H3V16H13V3ZM8 10.9L9.9 12.8C10.0833 12.9833 10.3167 13.075 10.6 13.075C10.8833 13.075 11.1167 12.9833 11.3 12.8C11.4833 12.6167 11.575 12.3833 11.575 12.1C11.575 11.8167 11.4833 11.5833 11.3 11.4L9.4 9.5L11.3 7.6C11.4833 7.41667 11.575 7.18333 11.575 6.9C11.575 6.61667 11.4833 6.38333 11.3 6.2C11.1167 6.01667 10.8833 5.925 10.6 5.925C10.3167 5.925 10.0833 6.01667 9.9 6.2L8 8.1L6.1 6.2C5.91667 6.01667 5.68334 5.925 5.4 5.925C5.11667 5.925 4.88334 6.01667 4.7 6.2C4.51667 6.38333 4.425 6.61667 4.425 6.9C4.425 7.18333 4.51667 7.41667 4.7 7.6L6.6 9.5L4.7 11.4C4.51667 11.5833 4.425 11.8167 4.425 12.1C4.425 12.3833 4.51667 12.6167 4.7 12.8C4.88334 12.9833 5.11667 13.075 5.4 13.075C5.68334 13.075 5.91667 12.9833 6.1 12.8L8 10.9Z"
                                                    fill="#D22C42" />
                                            </svg>
                                        </a>
                                        <button id="validatePhoneButton" type="button" style="background: #2fb7c2;"
                                            class="text-white w-7 h-7 ml-3 hover:bg-green-700 focus:ring-4  focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm  text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            <svg class=" w-5 h-5 ml-1 text-white dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                                viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <span id="phoneError"></span>
                            </li>
                            <p id="labelInput">Mail</p>

                            <li id="Email">
                                <span class="text-sm text-gray-500 dark:text-gray-400""><span  class=" flex items-center
                                    justify-between p-2 text-base font-bold text-gray-900 rounded-lg
                                    bg-gray-100 ">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <span id="
                                    emailSpanStyle" class=" flex items-center "><svg class="mr-2"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="18" viewBox="0 0 16 13"
                                        fill="none">
                                        <path
                                            d="M9.30377 8.87874L9.31474 8.87036L9.32522 8.86138L15.5 3.57365V10.9C15.5 11.1917 15.3841 11.4715 15.1778 11.6778C14.9715 11.8841 14.6917 12 14.4 12H1.6C1.30826 12 1.02847 11.8841 0.822183 11.6778C0.615892 11.4715 0.5 11.1917 0.5 10.9V3.57337L6.71405 8.89264L6.72611 8.90296L6.73879 8.9125C7.09877 9.18305 7.53711 9.32892 7.98742 9.328L7.98922 9.32799C8.46462 9.32531 8.92617 9.16757 9.30377 8.87874ZM14.5019 1.00551L8 6.57294L1.49812 1.00551C1.53229 1.00205 1.56673 1.0002 1.60132 1H14.3987C14.4333 1.0002 14.4677 1.00205 14.5019 1.00551Z"
                                            fill="#ACABAB" stroke="#ACABAB" />
                                    </svg>
                                    <span id="emailValue"></span>
                                    <div id="popover" class="hidden absolute bg-white p-4 rounded shadow-lg">
                                        <p>Copy</p>
                                    </div>

                                </span>



                                <button>
                                    <svg id="updateEmailBtn" class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                    </svg>

                                </button>

                                </span>
                                </span>

                            </li>

                            <li>
                                <div id="emailInputContainer"
                                    class=" hidden p-2  border-2 border-gray-300 rounded-lg w-full flex items-center">
                                    <input type="text" id="emailInputValue"
                                        class="flex-grow p-2 border-0 border-gray-300 rounded" />


                                    <div class="flex justify-end items-center">
                                        <a href="" id="cancelButton"><svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                height="42" viewBox="0 0 16 18" fill="none">
                                                <path
                                                    d="M3 18C2.45 18 1.97934 17.8043 1.588 17.413C1.19667 17.0217 1.00067 16.5507 1 16V3C0.71667 3 0.479337 2.904 0.288004 2.712C0.0966702 2.52 0.000670115 2.28267 3.44827e-06 2C-0.000663218 1.71733 0.0953369 1.48 0.288004 1.288C0.48067 1.096 0.718003 1 1 1H5C5 0.716667 5.096 0.479333 5.288 0.288C5.48 0.0966668 5.71734 0.000666667 6 0H10C10.2833 0 10.521 0.0960001 10.713 0.288C10.905 0.48 11.0007 0.717333 11 1H15C15.2833 1 15.521 1.096 15.713 1.288C15.905 1.48 16.0007 1.71733 16 2C15.9993 2.28267 15.9033 2.52033 15.712 2.713C15.5207 2.90567 15.2833 3.00133 15 3V16C15 16.55 14.8043 17.021 14.413 17.413C14.0217 17.805 13.5507 18.0007 13 18H3ZM13 3H3V16H13V3ZM8 10.9L9.9 12.8C10.0833 12.9833 10.3167 13.075 10.6 13.075C10.8833 13.075 11.1167 12.9833 11.3 12.8C11.4833 12.6167 11.575 12.3833 11.575 12.1C11.575 11.8167 11.4833 11.5833 11.3 11.4L9.4 9.5L11.3 7.6C11.4833 7.41667 11.575 7.18333 11.575 6.9C11.575 6.61667 11.4833 6.38333 11.3 6.2C11.1167 6.01667 10.8833 5.925 10.6 5.925C10.3167 5.925 10.0833 6.01667 9.9 6.2L8 8.1L6.1 6.2C5.91667 6.01667 5.68334 5.925 5.4 5.925C5.11667 5.925 4.88334 6.01667 4.7 6.2C4.51667 6.38333 4.425 6.61667 4.425 6.9C4.425 7.18333 4.51667 7.41667 4.7 7.6L6.6 9.5L4.7 11.4C4.51667 11.5833 4.425 11.8167 4.425 12.1C4.425 12.3833 4.51667 12.6167 4.7 12.8C4.88334 12.9833 5.11667 13.075 5.4 13.075C5.68334 13.075 5.91667 12.9833 6.1 12.8L8 10.9Z"
                                                    fill="#D22C42" />
                                            </svg>
                                        </a>
                                        <button id="validateButton" type="button" style="background: #2fb7c2;"
                                            class="text-white w-7 h-7 ml-3 hover:bg-green-700 focus:ring-4  focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm  text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            <svg class=" w-5 h-5 ml-1 text-white dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                                viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                            </li>
                            <input type="hidden" id="guestId">
                            <input type="hidden" id="bookingId">


                            <a type="button" href="#" id="buttonSidebar"
                                class="text-white bg-blue-500 hover:bg-blue-700 rounded-lg h-10 w-full inline-flex justify-center items-center">
                                <span class="flex items-center whitespace-nowrap">Client Info</span>
                            </a>
                        </ul>

                        <h3 class="text-lg font-semibold text-gray-900 mt-2">Booking Info</h3>
                        <ul class="space-y-3">
                            <div class="flex items-center justify-between rounded-t">
                                <li>

                                    <span class="text-sm text-gray-500 dark:text-gray-400">Arrival</span>
                                    <span id="arrivalContainer"
                                        class="arrivalDeparture flex items-center  flex-grow p-2 text-lg font-bold text-gray-900 rounded-lg bg-gray-100  px-16 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                                        </svg>
                                        <span class="ms-3 whitespace-nowrap" id="modalStartDate"></span>
                                    </span>
                                    <span id="arrivalDateInputSpan"
                                        class="flex arrivalDeparture border border-gray-300 rounded mt-1 hidden">
                                        <input type="date" id="inputArrivalDate" class="border-0">
                                        <button id="validateButtonArrivalDate"
                                            class="ml-2 text-white bg-green-500 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 text-center"><svg
                                                class="w-6 h-6 text-white dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                                viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                                            </svg>
                                        </button>
                                        <button id="cancelButtonArrivalDate"
                                            class=" ml-2 text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 text-center"><svg
                                                class="w-6  h-6 text-white dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                                viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                                            </svg>
                                        </button>

                                    </span>
                                </li>
                                <li class=" timeStyle flex justify-center items-center">

                                    <div id="selectArivalTime" class=" flex-col  mt-6">

                                        <select id="timeSlot" name="timeSlot" class="rounded-lg">
                                            @for ($hour = 0; $hour < 24; $hour++)
                                                                        @for ($minute = 0; $minute < 60; $minute += 30)
                                                                                                    @php
                                                                                                        $formattedTime = sprintf('%02d:%02d', $hour, $minute);
                                                                                                    @endphp
                                                                                                    <option value="{{ $formattedTime }}">{{ $formattedTime }}</option>
                                                                        @endfor
                                            @endfor
                                        </select>

                                    </div>
                                </li>
                            </div>

                            <div class="flex items-center justify-between rounded-t">
                                <li>
                                    <span class="text-sm text-gray-500 dark:text-gray-400">Departure</span>
                                    <span id="departureContainer" href="#"
                                        class=" arrivalDeparture flex items-center flex-grow p-2 text-lg font-bold text-gray-900 rounded-lg bg-gray-100 px-16 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                                        </svg>
                                        <span class="ms-3 whitespace-nowrap" id="modalEndDate"></span>
                                    </span>
                                    <span id="departureDateInputSpan"
                                        class="flex arrivalDeparture border border-gray-300 rounded mt-1 hidden">
                                        <input type="date" id="inputDepartureDate" class="border-0">
                                        <button id="validateButtonDepartureDate"
                                            class="ml-2 text-white bg-green-500 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 text-center"><svg
                                                class="w-6 h-6 text-white dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                                viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                                            </svg>
                                        </button>
                                        <button id="cancelButtonDepartureDate"
                                            class=" ml-2 text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 text-center"><svg
                                                class="w-6  h-6 text-white dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                                viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                                            </svg>
                                        </button>

                                    </span>
                                </li>
                                <li class="timeStyle">

                                    <div id="selectDepartureTime" class=" flex-col  mt-6">

                                        <select id="timeSlotDep" name="timeSlotDep" class="rounded-lg">
                                            @for ($hour = 0; $hour < 24; $hour++)
                                                                        @for ($minute = 0; $minute < 60; $minute += 30)
                                                                                                    @php
                                                                                                        $formattedTime = sprintf('%02d:%02d', $hour, $minute);
                                                                                                    @endphp
                                                                                                    <option value="{{ $formattedTime }}">{{ $formattedTime }}</option>
                                                                        @endfor
                                            @endfor
                                        </select>

                                    </div>

                                </li>
                            </div>

                            <li>
                                <div class="flex items-center justify-between rounded-t">
                                    <div class="grid grid-rows w-full mr-4">
                                        <span class="text-sm text-gray-500 dark:text-gray-400 mb-1">Night</span>
                                        <a href="#"
                                            class="flex items-center p-2 text-lg font-bold text-gray-900 rounded-lg bg-gray-100 hover:bg-gray-200 group hover:shadow">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                            </svg>
                                            <span id="modalNuit" class="flex-1 ms-3 whitespace-nowrap"></span>
                                            <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg> -->
                                        </a>
                                    </div>
                                    <div class="grid grid-rows w-full">
                                        <span class="text-sm text-gray-500 dark:text-gray-400 mb-1">Prices</span>
                                        <a href="#"
                                            class="flex items-center justify-center p-2 text-lg font-bold text-gray-900 rounded-lg bg-gray-100 hover:bg-gray-200 group hover:shadow">
                                            <span id="modalPaiement" class="whitespace-nowrap"></span>
                                            <p id="modalCurrency" class="ml-2"></p>
                                            <!-- Ajout d'un espace entre les éléments -->
                                        </a>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="flex items-center justify-between rounded-t">
                                    <div class="grid grid-rows w-full">
                                        <span class="text-sm text-gray-500 dark:text-gray-400 mb-1">Adults</span>
                                        <a href="#"
                                            class="flex items-center p-2 text-lg font-bold text-gray-900 rounded-lg bg-gray-100 hover:bg-gray-200 group hover:shadow">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                            </svg>
                                            <span id="modalAdult" class="flex-1 ms-3 whitespace-nowrap">Adults</span>
                                        </a>
                                    </div>
                                    <div class="grid grid-rows w-full mx-4">
                                        <span class="text-sm text-gray-500 dark:text-gray-400 mb-1">Children</span>
                                        <a href="#"
                                            class="flex items-center p-2 text-lg font-bold text-gray-900 rounded-lg bg-gray-100 hover:bg-gray-200 group hover:shadow">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                            <span id="modalEnfant" class="flex-1 ms-3 whitespace-nowrap">Children</span>
                                        </a>
                                    </div>
                                    <div class="grid grid-rows w-full">
                                        <span class="text-sm text-gray-500 dark:text-gray-400 mb-1">Animals</span>
                                        <a href="#"
                                            class="flex items-center p-2 text-lg font-bold text-gray-900 rounded-lg bg-gray-100 hover:bg-gray-200 group hover:shadow">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 12.75c1.148 0 2.278.08 3.383.237 1.037.146 1.866.966 1.866 2.013 0 3.728-2.35 6.75-5.25 6.75S6.75 18.728 6.75 15c0-1.046.83-1.867 1.866-2.013A24.204 24.204 0 0 1 12 12.75Zm0 0c2.883 0 5.647.508 8.207 1.44a23.91 23.91 0 0 1-1.152 6.06M12 12.75c-2.883 0-5.647.508-8.208 1.44.125 2.104.52 4.136 1.153 6.06M12 12.75a2.25 2.25 0 0 0 2.248-2.354M12 12.75a2.25 2.25 0 0 1-2.248-2.354M12 8.25c.995 0 1.971-.08 2.922-.236.403-.066.74-.358.795-.762a3.778 3.778 0 0 0-.399-2.25M12 8.25c-.995 0-1.97-.08-2.922-.236-.402-.066-.74-.358-.795-.762a3.734 3.734 0 0 1 .4-2.253M12 8.25a2.25 2.25 0 0 0-2.248 2.146M12 8.25a2.25 2.25 0 0 1 2.248 2.146M8.683 5a6.032 6.032 0 0 1-1.155-1.002c.07-.63.27-1.222.574-1.747m.581 2.749A3.75 3.75 0 0 1 15.318 5m0 0c.427-.283.815-.62 1.155-.999a4.471 4.471 0 0 0-.575-1.752M4.921 6a24.048 24.048 0 0 0-.392 3.314c1.668.546 3.416.914 5.223 1.082M19.08 6c.205 1.08.337 2.187.392 3.314a23.882 23.882 0 0 1-5.223 1.082" />
                                            </svg>
                                            <span id="modalAnimal" class="flex-1 ms-3 whitespace-nowrap">Pets</span>
                                        </a>
                                    </div>
                                <div>
                            </li>
                            <li>
                                <a type="button" href="#" id="buttonSidebar"
                                    class="text-white bg-blue-500 hover:bg-blue-700 rounded-lg h-10 w-full inline-flex justify-center items-center">
                                    <span class="flex items-center whitespace-nowrap">Booking Details</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                </div>
            </div>

            <div id="selectDiv" class="flex justify-start">
                <select class="mr-3 hidden text-sm text-gray-500 border border-gray-300 rounded-lg bg-white"
                    id="resourceSelect"></select>

                <select name="timelineChoice" id="timelineChoice"
                    class="text-sm text-gray-500 border border-gray-300 rounded-lg bg-white">
                    <option value="dayGridMonth">Property view</option>
                    <option value="resourceTimelineThreeMonth">Month</option>
                    <option value="resourceTimelineTwoWeek">Two week</option>
                </select>
            </div>

            <div>
                <div id='container' wire:ignore>
                    <div id='calendar'></div>
                </div>
            </div>

            @push('scripts')

                <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.js'></script>
                <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.10/build/js/intlTelInput.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.11/index.global.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {

                        //reglages du calendrier const
                        showPayoutFilter = document.getElementById('showPayoutFilter');
                        showPayoutFilter.addEventListener('change',
                            function () {
                                calendar.render();
                            });

                        document.getElementById('toggleResourceWidth').addEventListener('click', function () {
                            // Modification de la largeur de resources
                            if (calendar.getOption('resourceAreaWidth') === 0) {
                                // Rétablir la largeur par défaut et afficher les ressources
                                calendar.setOption('resourceAreaWidth', 200);
                                document.getElementById('toggleResourceWidth').innerText = "Masquer les ressources";
                                // Afficher les éléments avec la classe fc-resource-timeline-divider
                                var elements = document.getElementsByClassName('fc-resource-timeline-divider');
                                for (var i = 0; i < elements.length; i++) {
                                    elements[i].style.visibility = "visible"; // Réduire l'opacité à 0 pour les masquer
                                }

                            } else {
                                // Réduire la largeur à 0 et masquer les ressources
                                calendar.setOption('resourceAreaWidth', 0);
                                document.getElementById('toggleResourceWidth').innerText = "Afficher les ressources";
                                // Masquer les éléments avec la classe fc-resource-timeline-divider
                                var elements = document.getElementsByClassName('fc-resource-timeline-divider');
                                for (var i = 0; i < elements.length; i++) {
                                    elements[i].style.visibility = "hidden"; // Réduire l'opacité à 0 pour les masquer
                                }
                            }
                        });

                        const Calendar = FullCalendar.Calendar;
                        const calendarEl = document.getElementById('calendar');
                        var date = new Date();
                        // Définir la date de début pour que aujourd'hui soit le 4ème jour

                        date.setDate(date.getDate() - 3);

                        const calendar = new Calendar(calendarEl, {
                            slotLabelFormat: [ //Format TimeLine
                                {
                                    day: '2-digit',
                                    month: 'short',
                                },
                            ],
                            slotLabelContent: function (arg) {
                                var date = arg.date;
                                // var day = date.getDate();
                                var day = date.toLocaleString('default', {
                                    day: '2-digit'
                                });
                                var month = date.toLocaleString('default', {
                                    month: 'short'
                                });

                                return {
                                    html: day + '<br/>' + month
                                };
                            },
                            nowIndicator: true, //Affiche le temps actuel
                            initialDate: date.toISOString().split('T')[0], // Utiliser la date calculée
                            resourceAreaWidth: 200, //Largeur Resources
                            locale: 'fr', //Langue française
                            headerToolbar: {
                                left: "prev,next today",
                                center: "title",
                                right: "resourceTimelineTwoWeek,resourceTimelineThreeMonth,dayGridMonth"
                            },
                            buttonText: { // Traduction des textes
                                today: 'Aujourd\'hui',
                                resourceTimelineTwoWeek: 'Semaine',
                                resourceTimelineThreeMonth: 'Mois',
                                dayGridMonth: 'par propriété',
                            },
                            initialView: 'resourceTimelineTwoWeek', // Page par défaut
                            views: { // Modifier les vues
                                resourceTimelineTwoWeek: {
                                    type: 'resourceTimeline',
                                    duration: {
                                        days: 14
                                    } // Vue sur un mois
                                },
                                resourceTimelineThreeMonth: {
                                    type: 'resourceTimeline',
                                    duration: {
                                        months: 3
                                    } // Vue sur trois mois
                                },
                                dayGridMonth: {
                                    type: 'dayGridMonth',

                                }
                            },
                            slotDuration: {
                                hours: 24
                            }, //Jour en 24heures
                            editable: false, //Drag & Drop
                            selectable: true, //Jour clicable
                            aspectRatio: 1.6,
                            resourceAreaColumns: [
                                {
                                    headerContent: 'Properties'
                                },
                            ],

                            customButtons: {
                                customDropdownButton: {
                                    text: 'Choisir',
                                    click: function () {
                                        // The dropdown behavior is handled by CSS
                                    }
                                }
                            },

                            resources: @json($resources),

                            events: [],

                            resourceLabelDidMount: function (info) {
                                var imageElement = document.createElement('img');

                                // Définissez les attributs de l'image
                                imageElement.src = "./storage/avatars/defaultHome.jpg"; // Remplacez par le chemin de votre image
                                imageElement.alt = 'Description de l\'image'; // Texte alternatif pour l'image
                                imageElement.style.width = '36px'; // Définir la largeur de l'image
                                imageElement.style.height = '36px'; // Définir la hauteur de l'image
                                imageElement.style.marginRight = '5px'; // Définir la marge droite de l'image
                                imageElement.id = "propertyImage";

                                // Ajoutez l'image à l'endroit souhaité dans votre document
                                info.el.querySelector('.fc-datagrid-cell-main')
                                    .appendChild(imageElement);


                            },


                            eventContent: function (arg) {

                                // Récupérer les métadonnées d'événement
                                var guest = arg.event.extendedProps.guest;
                                var partnerIcon = arg.event.extendedProps.partnerIcon;
                                var guestImage = arg.event.extendedProps.picture;
                                const defaultImage = "./storage/avatars/default.jpg";
                                const imagePath = guestImage ? guestImage : defaultImage;

                                if (arg.event.extendedProps.partnerName === "withoutBooking") {
                                    var html = '<div class="fc-content">';
                                    html += '<span style="flex: 1;">' + arg.event.extendedProps.total_payout + ' ' + arg.event.extendedProps.currency + '</span>';
                                }
                                else {

                                    // Construire le contenu de l'événement avec les informations supplémentaires
                                    var html = '<div class="fc-content">';
                                    html += '<div class="fc-title flex " style="color: black; padding-top: 3px; font-size: 100%; margin-left: 10px; display: flex; align-items: center;">';
                                    html += '<img src="' + imagePath + '" class="rounded-full" alt="" style="width: 16px; height: 16px; margin-right: 5px;">';
                                    html += '<span style="flex: 1;">' + arg.event.title + '</span>'; // Utiliser flex pour que le titre occupe tout l'espace disponible
                                    if (showPayoutFilter.checked) {
                                        html += '<span style="flex: 1;">' + arg.event.extendedProps.total_payout + ' ' + arg.event.extendedProps.currency + '</span>';
                                    }
                                    html += '<img src="' + partnerIcon + '" alt="" style="width: 16px; height: 16px; margin-left: 5px; margin-right: 10px;">'; // Supprimer les marges pour le partnerIcon
                                    html += '</div>';
                                    html += '</div>';
                                }

                                return {
                                    html: html
                                };
                            },



                            eventClick: function (info) {



                                // Récupérer les informations de l'événement cliqué
                                var eventObj = info.event;
                                var eventId = eventObj.id; // Récupérer l'ID de l'événement



                                // Initialiser intl-tel-input une seule fois

                                const phoneContainer = document.getElementById('Phone');
                                const phoneInputContainer = document.getElementById('phoneInputContainer');
                                const phoneValue = document.getElementById('phoneValue');
                                const phoneInputValue = document.getElementById('phoneInputValue');
                                const whatsappButton = document.getElementById('whatsappButton');


                                const phoneError = document.getElementById('phoneError');
                                const emailInput = document.getElementById('emailInputContainer');
                                const emailSpan = document.getElementById('Email');
                                const emailValue = document.getElementById('emailValue');
                                const emailInputValue = document.getElementById('emailInputValue');



                                // Récupérer le numéro de téléphone depuis l'objet événement ou directement de la base de données
                                const initialPhoneNumber = eventObj.extendedProps.phone;
                                //Fermer l'input en cas de changement d'event
                                if (emailSpan.classList.contains('hidden')) {
                                    emailSpan.classList.remove('hidden');
                                    emailInput.classList.add('hidden');
                                }
                                if (phoneContainer.classList.contains('hidden')) {
                                    phoneContainer.classList.remove('hidden');
                                    phoneInputContainer.classList.add('hidden');
                                }

                                const iti = window.intlTelInput(phoneInputValue, {
                                    initialCountry: "auto", // Détecter automatiquement le pays initial
                                    utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.7/build/js/utils.js",
                                });
                                const span = window.intlTelInput(phoneValue, {
                                    initialCountry: "auto", // Détecter automatiquement le pays initial
                                    utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.7/build/js/utils.js",
                                });
                                phoneInputValue.addEventListener('change', function () {
                                    iti.setNumber(phoneInputValue);
                                    span.setNumber(phoneInputValue);
                                });


                                // Tableaux de noms de mois et de jours
                                var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                                    "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
                                ];
                                var dayNames = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

                                // Formatter la date en conséquence
                                var formattedDateStart = dayNames[eventObj.start.getDay()] + ', ' +
                                    monthNames[eventObj.start.getMonth()] + ' ' +
                                    eventObj.start.getDate() + ', ' +
                                    eventObj.start.getFullYear();

                                var formattedDateEnd = dayNames[eventObj.end.getDay()] + ', ' +
                                    monthNames[eventObj.end.getMonth()] + ' ' +
                                    eventObj.end.getDate() + ', ' +
                                    eventObj.end.getFullYear();

                                // Extraire les heures et les minutes
                                var hoursStart = eventObj.start.getHours();
                                var minutesStart = eventObj.start.getMinutes();


                                // Extraire les heures et les minutes
                                var hoursEnd = eventObj.end.getHours();
                                var minutesEnd = eventObj.end.getMinutes();


                                // Ajouter un zéro devant les minutes si nécessaire
                                minutesStart = minutesStart < 10 ? '0' + minutesStart : minutesStart;
                                minutesEnd = minutesEnd < 10 ? '0' + minutesEnd : minutesEnd;


                                // Ajouter un zéro devant les minutes si nécessaire
                                hoursStart = hoursStart < 10 ? '0' + hoursStart : hoursStart;
                                hoursEnd = hoursEnd < 10 ? '0' + hoursEnd : hoursEnd;

                                // Formater l'heure en HH:MM
                                var formattedStartTime = hoursStart + ':' + minutesStart;
                                var formattedEndTime = hoursEnd + ':' + minutesEnd;

                                // Mettre à jour le contenu du modal avec les informations de l'événement
                                document.getElementById('modalGuestName').innerText = eventObj.extendedProps.guest;
                                document.getElementById('modalStartDate').innerText = formattedDateStart;
                                document.getElementById('timeSlot').value = formattedStartTime;

                                document.getElementById('modalEndDate').innerText = formattedDateEnd;
                                document.getElementById('timeSlotDep').value = formattedEndTime;
                                const partnerName = eventObj.extendedProps.partnerName;
                                document.getElementById('modalPartnerIcon').src = eventObj.extendedProps.partnerIcon;
                                document.getElementById('modalNuit').innerText = eventObj.extendedProps.number_of_nights;
                                document.getElementById('modalAdult').innerText = eventObj.extendedProps.number_of_adults;
                                document.getElementById('modalEnfant').innerText = eventObj.extendedProps.number_of_children;
                                document.getElementById('modalProperty').innerText = eventObj.extendedProps.property;
                                document.getElementById('modalPaiement').innerText = eventObj.extendedProps.total_payout;
                                document.getElementById('modalCurrency').innerText = eventObj.extendedProps.currency;
                                document.getElementById('emailValue').innerText = eventObj.extendedProps.email;
                                document.getElementById('phoneValue').value = eventObj.extendedProps.phone;
                                document.getElementById('modalAnimal').innerText = eventObj.extendedProps.number_of_animals;
                                document.getElementById('modalExternal').innerText = eventObj.extendedProps.external;
                                document.getElementById('guestId').value = eventObj.extendedProps.guestId;
                                document.getElementById('bookingId').value = eventObj.id;



                                eventObj.extendedProps.phone = iti.getNumber();
                                // initialiser le lien de whatsappButton
                                whatsappButton.addEventListener('click', function () {
                                    const phone = iti.getNumber();
                                    const url = `https://wa.me/${phone}`;
                                    window.open(url, '_blank');
                                });






                                // Retrieve filter fields
                                const searchInput = document.getElementById('searchInput');
                                const checkinDate = document.getElementById('checkinDate');
                                const checkoutDate = document.getElementById('checkoutDate');
                                const minPrice = document.getElementById('priceFilterMin');
                                const maxPrice = document.getElementById('priceFilter');
                                const maxGuest = document.getElementById('guestFilter');
                                const clearSearch = document.getElementById('clearSearch');

                                // Filter events based on the input criteria
                                function filterEvents(events) {




                                    const searchTerm = searchInput.value.toLowerCase();
                                    const checkin = new Date(checkinDate.value);
                                    const checkout = new Date(checkoutDate.value);
                                    const priceMax = parseFloat(maxPrice.value);
                                    const priceMin = parseFloat(minPrice.value);
                                    const guestMax = parseFloat(maxGuest.value);

                                    const filteredEvents = events.filter(event => {
                                        const eventStart = new Date(event.start);
                                        const eventEnd = new Date(event.end);

                                        const matchesSearchTerm = event.title.toLowerCase().includes(searchTerm) ||
                                            (event.extendedProps.guest && event.extendedProps.guest.toLowerCase().includes(searchTerm)) ||
                                            (event.extendedProps.property && event.extendedProps.property.toLowerCase().includes(searchTerm)) ||
                                            (event.extendedProps.partnerName && event.extendedProps.partnerName.toLowerCase().includes(searchTerm));

                                        const matchesCheckin = isNaN(checkin.getTime()) || eventStart >= checkin;
                                        const matchesCheckout = isNaN(checkout.getTime()) || eventEnd <= checkout;
                                        const matchesMaxPrice = isNaN(priceMax) || priceMax === '' || event.extendedProps.total_payout <= priceMax;
                                        const matchesMinPrice = isNaN(priceMin) || priceMin === '' || event.extendedProps.total_payout >= priceMin;
                                        const matchesMaxGuest = isNaN(guestMax) || guestMax === '' || event.extendedProps.number_of_guests <= guestMax;

                                        return matchesSearchTerm && matchesCheckin && matchesCheckout && matchesMaxPrice && matchesMinPrice && matchesMaxGuest;
                                    });

                                    calendar.removeAllEvents();
                                    calendar.addEventSource(filteredEvents);
                                }




                                // Afficher le modal
                                document.getElementById('eventModal').classList.remove('hidden');

                                //section de modification des dates
                                //recuperation des ellements du DOM a modifiers
                                const arrivalDateContainer = document.getElementById('arrivalContainer');
                                const arrivalDateInputSpan = document.getElementById('arrivalDateInputSpan');
                                const validateButtonArrivalDate = document.getElementById('validateButtonArrivalDate');
                                const cancelButtonArrivalDate = document.getElementById('cancelButtonArrivalDate');
                                const departureDateContainer = document.getElementById('departureContainer');
                                const departureDateInputSpan = document.getElementById('departureDateInputSpan');
                                const validateButtonDepartureDate = document.getElementById('validateButtonDepartureDate');
                                const cancelButtonDepartureDate = document.getElementById('cancelButtonDepartureDate');
                                const inputArrivalDate = document.getElementById('inputArrivalDate');
                                const inputDepartureDate = document.getElementById('inputDepartureDate');

                                var year = eventObj.start.getFullYear();
                                var month = eventObj.start.getMonth() + 1;  // Les mois sont de 0 à 11, donc il faut ajouter 1
                                var day = eventObj.start.getDate();

                                var formattedMonth = month < 10 ? '0' + month : month;
                                var formattedDay = day < 10 ? '0' + day : day;

                                var arrivalDateEvent = year + "-" + formattedMonth + "-" + formattedDay;

                                year = eventObj.end.getFullYear();
                                month = eventObj.end.getMonth() + 1;  // Les mois sont de 0 à 11, donc il faut ajouter 1
                                day = eventObj.end.getDate();

                                formattedMonth = month < 10 ? '0' + month : month;
                                formattedDay = day < 10 ? '0' + day : day;

                                var departureDateEvent = year + "-" + formattedMonth + "-" + formattedDay;

                                //innitialiser les elements du DOM
                                arrivalDateContainer.classList.remove('hidden');
                                arrivalDateInputSpan.classList.add('hidden');
                                departureDateContainer.classList.remove('hidden');
                                departureDateInputSpan.classList.add('hidden');

                                //initialiser les input date

                                inputArrivalDate.value = arrivalDateEvent;  // Format YYYY-MM-DD
                                inputDepartureDate.value = departureDateEvent;

                                arrivalDateContainer.addEventListener("mouseover", function () {
                                    //Condition pour pouvoir modifier la date seulement des booking créés sur innov rental
                                    if (partnerName === "inovRental") {
                                        arrivalDateContainer.style.cursor = "pointer";
                                        arrivalDateContainer.classList.add('hover:bg-gray-200');



                                    }
                                    else {
                                        arrivalDateContainer.style.cursor = "default";
                                        arrivalDateContainer.classList.remove('hover:bg-gray-200');
                                    }
                                });

                                departureDateContainer.addEventListener("mouseover", function () {
                                    //Condition pour pouvoir modifier la date seulement des booking créés sur innov rental
                                    if (partnerName === "inovRental") {
                                        departureDateContainer.style.cursor = "pointer";
                                        departureDateContainer.classList.add('hover:bg-gray-200');



                                    }
                                    else {
                                        departureDateContainer.style.cursor = "default";
                                        departureDateContainer.classList.remove('hover:bg-gray-200');
                                    }
                                });





                                arrivalDateContainer.addEventListener("click", function () {
                                    if (partnerName === "inovRental") {
                                        arrivalDateContainer.classList.add('hidden');
                                        arrivalDateInputSpan.classList.remove('hidden');
                                    }

                                });

                                departureDateContainer.addEventListener("click", function () {
                                    if (partnerName === "inovRental") {
                                        departureDateContainer.classList.add('hidden');
                                        departureDateInputSpan.classList.remove('hidden');
                                    }

                                });

                                cancelButtonArrivalDate.addEventListener("click", function () {
                                    arrivalDateContainer.classList.remove('hidden');
                                    arrivalDateInputSpan.classList.add('hidden');
                                });


                                cancelButtonDepartureDate.addEventListener("click", function () {
                                    departureDateContainer.classList.remove('hidden');
                                    departureDateInputSpan.classList.add('hidden');
                                });

                                validateButtonArrivalDate.addEventListener("click", function () {

                                    //boucle pour eviter le bug de repetition
                                    var nbTry = 1;
                                    while (nbTry <= 1) {
                                        nbTry = nbTry + 1;
                                        updateArrivalDate(eventId, inputArrivalDate.value);
                                        fetch('/get-events')
                                            .then(response => response.json())
                                            .then(events => {
                                                // Ajouter les événements au calendrier
                                                calendar.addEventSource(events);



                                                filterEvents(events);



                                            });
                                        const dateArrival = new Date(inputArrivalDate.value);
                                        const dayArrival = dateArrival.getDate();
                                        const monthArrival = dateArrival.getMonth();

                                        formattedDateStart = dayNames[dateArrival.getDay()] + ', ' +
                                            monthNames[month] + ' ' +
                                            dayArrival + ', ' +
                                            dateArrival.getFullYear();
                                        document.getElementById('modalStartDate').innerText = formattedDateStart;
                                        alert(formattedDateStart);

                                    }

                                    arrivalDateContainer.classList.remove('hidden');
                                    arrivalDateInputSpan.classList.add('hidden');
                                });


                                validateButtonDepartureDate.addEventListener("click", function () {
                                    //boucle pour eviter le bug de repetition
                                    var nbTry = 1;
                                    while (nbTry <= 1) {
                                        nbTry = nbTry + 1;
                                        updateDepartureDate(eventId, inputDepartureDate.value);
                                        fetch('/get-events')
                                            .then(response => response.json())
                                            .then(events => {
                                                // Ajouter les événements au calendrier
                                                calendar.addEventSource(events);



                                                filterEvents(events);



                                            });
                                        const dateDeparture = new Date(inputDepartureDate.value);
                                        const dayDeparture = dateDeparture.getDate();
                                        const monthDeparture = dateDeparture.getMonth();

                                        formattedDateEnd = dayNames[dateDeparture.getDay()] + ', ' +
                                            monthNames[month - 1] + ' ' +
                                            dayDeparture + ', ' +
                                            dateDeparture.getFullYear();
                                        document.getElementById('modalEndDate').innerText = formattedDateEnd;

                                    }


                                    departureDateContainer.classList.remove('hidden');
                                    departureDateInputSpan.classList.add('hidden');
                                });


                                function updateArrivalDate(eventId, inputArrivalDate) {
                                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                                    fetch('/update-arrival-date', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': token
                                        },
                                        body: JSON.stringify({
                                            id: eventId,
                                            arrivalDate: inputArrivalDate
                                        }),
                                    })
                                        .then(response => {
                                            if (!response.ok) {
                                                throw new Error('Network response was not ok');
                                            }
                                            return response.json();
                                        })
                                        .then(data => {
                                            if (data.success) {
                                                console.log("Arrival Date updated successfully");
                                                // Optionally update the UI with the new arrival time
                                            } else {
                                                console.error('Failed to update arrival time:', data.message);
                                            }
                                        })
                                        .catch(error => {
                                            console.error('Error:', error);
                                        });
                                }

                                function updateDepartureDate(eventId, inputDepartureDate) {
                                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                                    fetch('/update-departure-date', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': token
                                        },
                                        body: JSON.stringify({
                                            id: eventId,
                                            departureDate: inputDepartureDate
                                        }),
                                    })
                                        .then(response => {
                                            if (!response.ok) {
                                                throw new Error('Network response was not ok');
                                            }
                                            return response.json();
                                        })
                                        .then(data => {
                                            if (data.success) {
                                                console.log("Arrival Date updated successfully");
                                                // Optionally update the UI with the new arrival time
                                            } else {
                                                console.error('Failed to update arrival time:', data.message);
                                            }
                                        })
                                        .catch(error => {
                                            console.error('Error:', error);
                                        });
                                }

                                // Add event listener to the email link

                                document.getElementById('updateEmailBtn').addEventListener('click', function (event) {
                                    event.preventDefault();
                                    // Show the input field and hide the span
                                    emailInputValue.value = emailValue.innerText;
                                    emailSpan.classList.add('hidden');
                                    emailInput.classList.remove('hidden');
                                    emailError.style.display = 'none'; // Hide the error message
                                    emailInput.focus();
                                });

                                // cliquer sur le bouton annuler
                                document.getElementById('cancelButton').addEventListener('click', function (event) {
                                    event.preventDefault();


                                    emailSpan.classList.remove('hidden');
                                    emailInput.classList.add('hidden');

                                });

                                //cliquer sur le bouton "valider"

                                document.getElementById('validateButton').addEventListener('click', function (event) {
                                    event.preventDefault();

                                    //boucle pour eviter le bug de repetition
                                    var nbTry = 1;
                                    while (nbTry <= 1) {
                                        nbTry = nbTry + 1;
                                        updateEmail();
                                        fetch('/get-events')
                                            .then(response => response.json())
                                            .then(events => {
                                                // Ajouter les événements au calendrier
                                                calendar.addEventSource(events);

                                                filterEvents(events);

                                            });

                                    }

                                    emailSpan.classList.remove('hidden');
                                    emailInput.classList.add('hidden');

                                });

                                function updateEmail() {
                                    if (validateEmail(emailInputValue.value)) {
                                        emailValue.innerText = emailInputValue.value;

                                        updateEmailInDatabase(guestId.value, emailInputValue.value);
                                        emailError.style.display = 'none'; // Hide the error message

                                    } else {
                                        emailError.style.display = 'block'; // Show the error message
                                        emailError.innerText = "Invalid email address.";
                                    }
                                }

                                // Fonction de validation de l'email
                                function validateEmail(email) {
                                    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                                    return re.test(email);
                                }

                                // Fonction pour mettre à jour l'email dans la base de données
                                function updateEmailInDatabase(guestId, newEmail) {

                                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                                    fetch('/update-email', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': token
                                        },
                                        body: JSON.stringify({
                                            id: guestId,
                                            email: newEmail
                                        }),

                                    })
                                        .then(response => {
                                            if (!response.ok) {
                                                throw new Error('Network response was not ok');
                                            }
                                            return response.json();
                                        })
                                        .then(data => {
                                            if (data.success) {

                                                console.log('Email updated successfully');


                                            } else {
                                                console.log('Failed to update email');
                                            }
                                        })
                                        .catch(error => {
                                            console.log('Error:', error);
                                        });


                                }

                                //Phone place

                                // Mettre à jour le champ input avec le numéro de téléphone initial
                                console.log("Validate button clicked");
                                span.setNumber(initialPhoneNumber);
                                iti.setNumber(initialPhoneNumber);
                                var elements = document.getElementsByClassName('iti__arrow');
                                var flagElements2 = document.querySelectorAll('.iti__selected-country');
                                var flagElements = document.querySelectorAll('.iti__selected-country-primary');
                                var flagElements3 = document.querySelectorAll('.iti__country-container ');
                                // Itère sur la collection et ajoute la classe 'hidden' à chaque élément
                                for (var i = 0; i < elements.length; i++) {
                                    elements[i].classList.add('hidden');
                                }

                                flagElements3.forEach(function (element) {

                                    element.style.cursor = 'default';

                                });
                                // Itère sur la NodeList et ajoute le style à chaque élément
                                flagElements.forEach(function (element) {
                                    element.style.pointerEvents = 'none';
                                    element.style.cursor = 'default';

                                });

                                // Itère sur la NodeList et ajoute le style à chaque élément
                                flagElements2.forEach(function (element) {
                                    element.style.pointerEvents = 'none';
                                    element.style.cursor = 'default';


                                });

                                // Add event listener to the link
                                document.getElementById('updatePhoneBtn').addEventListener('click', function (event) {
                                    event.preventDefault();
                                    // Show the input field and hide the span
                                    // Itère sur la NodeList et ajoute le style à chaque élément
                                    flagElements.forEach(function (element) {
                                        element.style.pointerEvents = '';
                                        element.style.cursor = '';

                                    });
                                    flagElements3.forEach(function (element) {

                                        element.style.cursor = '';

                                    });
                                    // Itère sur la NodeList et ajoute le style à chaque élément
                                    flagElements2.forEach(function (element) {
                                        element.style.pointerEvents = '';
                                        element.style.cursor = '';


                                    });
                                    for (var i = 0; i < elements.length; i++) {
                                        elements[i].classList.remove('hidden');
                                    }
                                    phoneInputValue.value = phoneValue.value;
                                    phoneContainer.classList.add('hidden');
                                    phoneInputContainer.classList.remove('hidden');
                                    phoneError.style.display = 'none'; // Hide the error message


                                });

                                // cliquer sur le bouton annuler
                                document.getElementById('cancelPhoneButton').addEventListener('click', function (event) {
                                    event.preventDefault();


                                    phoneContainer.classList.remove('hidden');
                                    phoneInputContainer.classList.add('hidden');
                                    for (var i = 0; i < elements.length; i++) {
                                        elements[i].classList.add('hidden');
                                    }
                                    flagElements.forEach(function (element) {
                                        element.style.pointerEvents = 'none';
                                        element.style.cursor = 'default';

                                    });

                                    flagElements3.forEach(function (element) {

                                        element.style.cursor = 'default';

                                    });

                                    // Itère sur la NodeList et ajoute le style à chaque élément
                                    flagElements2.forEach(function (element) {
                                        element.style.pointerEvents = 'none';
                                        element.style.cursor = 'default';

                                    });

                                });

                                //cliquer sur le bouton "valider"

                                document.getElementById('validatePhoneButton').addEventListener('click', function (event) {
                                    event.preventDefault();
                                    window.selectedEvent = eventObj;

                                    //boucle pour eviter le bug de repetition
                                    var nbTry = 1;
                                    while (nbTry <= 1) {
                                        nbTry = nbTry + 1;
                                        updatePhoneNumber();
                                        fetch('/get-events')
                                            .then(response => response.json())
                                            .then(events => {
                                                // Ajouter les événements au calendrier
                                                calendar.addEventSource(events);

                                                filterEvents(events);

                                            });

                                    }

                                    phoneContainer.classList.remove('hidden');
                                    phoneInputContainer.classList.add('hidden');
                                    for (var i = 0; i < elements.length; i++) {
                                        elements[i].classList.add('hidden');
                                    }
                                    flagElements.forEach(function (element) {
                                        element.style.pointerEvents = 'none';
                                        element.style.cursor = 'default';

                                    });
                                    flagElements3.forEach(function (element) {

                                        element.style.cursor = 'default';

                                    });

                                    // Itère sur la NodeList et ajoute le style à chaque élément
                                    flagElements2.forEach(function (element) {
                                        element.style.pointerEvents = 'none';
                                        element.style.cursor = 'default';


                                    });

                                });

                                // Update the phone number in the event object and the database
                                function updatePhoneNumber() {
                                    if (iti.isValidNumber()) {

                                        phoneValue.value = iti.getNumber();
                                        // Utiliser intl-tel-input pour obtenir le numéro formaté
                                        updatePhoneInDatabase(guestId.value, iti.getNumber()); // Utiliser intl-tel-input pour obtenir le numéro formaté
                                        phoneError.style.display = 'none'; // Hide the error message
                                        phoneInputValue.classList.remove('border-red-800');
                                    } else {
                                        phoneInputValue.classList.add('border-red-800');
                                        phoneError.style.display = 'block'; // Show the error message
                                        phoneError.innerText = getValidationErrorMessage(iti.getValidationError());
                                    }
                                }

                                // Get validation error message
                                function getValidationErrorMessage(errorCode) {
                                    switch (errorCode) {
                                        case intlTelInputUtils.validationError.TOO_SHORT:
                                            return "The phone number is too short.";
                                        case intlTelInputUtils.validationError.TOO_LONG:
                                            return "The phone number is too long.";
                                        case intlTelInputUtils.validationError.INVALID_NUMBER:
                                            return "The phone number is invalid.";
                                        default:
                                            return "Invalid phone number.";
                                    }
                                }
                            },

                            eventClassNames: 'custom-event-class',
                        });

                        calendar.render();

                        var selectElement = document.getElementById('timelineChoice');

                        // Écouter les changements dans le <select>
                        selectElement.addEventListener('change', function () {
                            var selectedValue = selectElement.value;

                            // Mettre à jour la vue dans FullCalendar
                            calendar.changeView(selectedValue);

                            // Mettre à jour la valeur par défaut du <select>
                            selectElement.value = selectedValue;
                            filterEvents2();

                            resizeView(selectedValue);

                        });

                        // Sélectionner la valeur par défaut dans le <select>
                        selectElement.value = 'resourceTimelineTwoWeek';

                        // Sélectionner le <select> par son ID

                        var propertySelect = document.getElementById('resourceSelect');
                        const defaultImagePath = './storage/avatars/defaultHome.jpg'; // Default image path

                        // Ajouter chaque ressource comme une option dans le select
                        calendar.getResources().forEach(function (resource) {
                            var option = document.createElement('option');
                            option.value = resource.id; // Valeur de l'option (peut être l'ID ou autre chose)

                            // Check if the image is null, use default image path if so
                            const imagePath = resource.image ? resource.image : defaultImagePath;
                            console.log(imagePath);

                            // Utiliser les éléments span pour contenir les images et les titres
                            option.innerHTML = `<span><img src="${imagePath}" alt="${resource.title}" style="width: 16px; height: 16px; margin-right: 5px; ">${resource.title}</span>`;
                            propertySelect.appendChild(option);
                        });

                        // Sélectionner la première ressource par défaut
                        propertySelect.selectedIndex = 0;

                        resizeView('resourceTimelineTwoWeek');

                        var modal = document.getElementById('eventModal');
                        var closeButton = document.getElementById('closeButton');

                        // Fonction pour fermer le modal
                        function closeModal() {
                            modal.classList.add('hidden');
                        }

                        // Fermer le modal en cliquant sur la croix
                        closeButton.addEventListener('click', closeModal);

                        // Fonction pour mettre à jour l'email dans la base de données
                        console.log('OK')
                        // Fonction pour mettre à jour le phone dans la base de données

                        function updatePhoneInDatabase(guestId, newPhone) {
                            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                            var eventObj = window.selectedEvent;

                            fetch('/update-phone', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': token
                                },
                                body: JSON.stringify({
                                    id: guestId,
                                    phone: newPhone
                                }),
                            })
                                .then(response => {
                                    if (!response.ok) {
                                        throw new Error(newPhone);
                                    }

                                    return response.json();
                                })
                                .then(data => {
                                    if (data.success) {

                                    } else {
                                        console.error('Failed to update phone');
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                });

                        };

                        //gestion des horaires
                        const hourDeparturModal = document.getElementById("modalEndTime");

                        const selectArivalModal = document.getElementById("selectArivalTime");

                        const timeSlot = document.getElementById("timeSlot");

                        const bookingId = document.getElementById("bookingId");
                        const validateButtonTimeDep = document.getElementById("validateButtonTimeDep");
                        const cancelButtonTimeDep = document.getElementById("cancelButtonTimeDep");
                        const timeSlotDep = document.getElementById("timeSlotDep");
                        const selectDeparturModal = document.getElementById("selectDepartureTime");

                        //fonction de tri
                        //creation des constantes pour recuperer les champs des filtres
                        const searchInput = document.getElementById('searchInput');
                        const checkinDate = document.getElementById('checkinDate');
                        const checkoutDate = document.getElementById('checkoutDate');
                        const minPrice = document.getElementById('priceFilterMin');
                        const maxPrice = document.getElementById('priceFilter');
                        const maxGuest = document.getElementById('guestFilter');
                        const clearSearch = document.getElementById('clearSearch');

                        filterEvents2();
                        //creation des evenements
                        propertySelect.addEventListener('change', function () {

                            filterEvents2();
                        });

                        clearSearch.addEventListener('click', function () {
                            searchInput.value = null;
                            filterEvents2();
                        });

                        searchInput.addEventListener('input', function () {
                            filterEvents2();
                        });

                        checkinDate.addEventListener('change', function () {
                            filterEvents2();
                        });

                        checkoutDate.addEventListener('change', function () {
                            filterEvents2();
                        });
                        maxPrice.addEventListener('input', function () {
                            filterEvents2();
                        });
                        minPrice.addEventListener('input', function () {
                            filterEvents2();
                        });
                        maxGuest.addEventListener('input', function () {
                            filterEvents2();
                        });

                        //creation du filtre sur $events sans paramettres
                        function filterEvents2() {
                            const searchTerm = searchInput.value.toLowerCase();
                            const checkin = new Date(checkinDate.value);
                            const checkout = new Date(checkoutDate.value);
                            const priceMax = parseFloat(maxPrice.value);
                            const priceMin = parseFloat(minPrice.value);
                            const guestMax = parseFloat(maxGuest.value);
                            const selectedOptionText = propertySelect.options[propertySelect.selectedIndex].textContent.trim().toLowerCase();
                            const selectedView = selectElement.value;

                            const filteredEvents = @json($events).filter(event => {
                                const eventStart = new Date(event.start);
                                const eventEnd = new Date(event.end);

                                const matchesSearchTerm = event.title.toLowerCase().includes(searchTerm) ||
                                    (event.extendedProps.guest && event.extendedProps.guest.toLowerCase().includes(searchTerm)) ||
                                    (event.extendedProps.property && event.extendedProps.property.toLowerCase().includes(searchTerm)) ||
                                    (event.extendedProps.partnerName && event.extendedProps.partnerName.toLowerCase().includes(searchTerm));

                                const matchesCheckin = isNaN(checkin.getTime()) || eventStart >= checkin;
                                const matchesCheckout = isNaN(checkout.getTime()) || eventEnd <= checkout;
                                const matchesMaxPrice = isNaN(priceMax) || priceMax === '' || event.extendedProps.total_payout <= priceMax;
                                const matchesMinPrice = isNaN(priceMin) || priceMin === '' || event.extendedProps.total_payout >= priceMin;
                                const matchesMaxGuest = isNaN(guestMax) || guestMax === '' || event.extendedProps.number_of_guests <= guestMax;

                                let propertySelected = true;
                                if (selectedView === "dayGridMonth") {
                                    propertySelected = event.extendedProps.property && event.extendedProps.property.toLowerCase().includes(selectedOptionText);
                                }

                                return propertySelected && matchesSearchTerm && matchesCheckin && matchesCheckout && matchesMaxPrice && matchesMinPrice && matchesMaxGuest;
                            });

                            calendar.removeAllEvents();
                            calendar.addEventSource(filteredEvents);
                        };

                        //creation du filtre sur $events
                        function filterEvents(events) {

                            const searchTerm = searchInput.value.toLowerCase();
                            const checkin = new Date(checkinDate.value);
                            const checkout = new Date(checkoutDate.value);
                            const priceMax = maxPrice.value;
                            const priceMin = minPrice.value;
                            const guestMax = maxGuest.value;

                            const filteredEvents = events.filter(event => {
                                const eventStart = new Date(event.start);
                                const eventEnd = new Date(event.end);


                                const matchesSearchTerm = event.title.toLowerCase().includes(searchTerm) ||
                                    event.extendedProps.guest.toLowerCase().includes(searchTerm) ||
                                    event.extendedProps.property.toLowerCase().includes(searchTerm) ||
                                    event.extendedProps.partnerName.toLowerCase().includes(searchTerm);

                                const matchesCheckin = isNaN(checkin.getTime()) || eventStart >= checkin;
                                const matchesCheckout = isNaN(checkout.getTime()) || eventEnd <= checkout; const matchesMaxPrice = isNaN(priceMax) ||
                                    priceMax === '' || event.extendedProps.total_payout <= priceMax; const matchesMinPrice = isNaN(priceMin) || priceMin === ''
                                        || event.extendedProps.total_payout >= priceMin;
                                const matchesMaxGuest = isNaN(guestMax) || guestMax === '' || event.extendedProps.number_of_guests <= guestMax;
                                return matchesSearchTerm && matchesCheckin && matchesCheckout && matchesMaxPrice && matchesMinPrice &&
                                    matchesMaxGuest;
                            });

                            calendar.removeAllEvents();
                            calendar.addEventSource(filteredEvents);

                        };

                        timeSlot.addEventListener('change', function () {

                            var nbTry = 1;
                            while (nbTry <= 1) {
                                nbTry = nbTry + 1;
                                updateArivalTime(bookingId.value, timeSlot.value);
                                fetch('/get-events')
                                    .then(response => response.json())
                                    .then(events => {

                                        // Ajouter les événements au calendrier
                                        calendar.addEventSource(events);



                                        filterEvents(events);



                                    });

                            };



                        });

                        timeSlotDep.addEventListener('change', function () {

                            //boucle pour eviter le bug de repetition
                            var nbTry = 1;
                            while (nbTry <= 1) {
                                nbTry = nbTry + 1;
                                updateDeparturTime(bookingId.value, timeSlotDep.value);
                                fetch('/get-events')
                                    .then(response => response.json())
                                    .then(events => {

                                        // Ajouter les événements au calendrier
                                        calendar.addEventSource(events);



                                        filterEvents(events);



                                    });

                            };


                            hourDeparturModal.innerText = timeSlotDep.value;

                        });
                    });

                    function updateArivalTime(eventId, timeSlotValue) {
                        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                        fetch('/update-arival', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token
                            },
                            body: JSON.stringify({
                                id: eventId,
                                arivalTime: timeSlotValue
                            }),
                        })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                if (data.success) {
                                    console.log("Arrival time updated successfully");
                                    // Optionally update the UI with the new arrival time
                                } else {
                                    console.error('Failed to update arrival time:', data.message);
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                            });
                    }
                    function updateDeparturTime(eventId, timeSlotValue) {
                        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                        fetch('/update-departur', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token
                            },
                            body: JSON.stringify({
                                id: eventId,
                                departurTime: timeSlotValue
                            }),
                        })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                if (data.success) {
                                    console.log("Arrival time updated successfully");
                                    // Optionally update the UI with the new arrival time
                                } else {
                                    console.error('Failed to update arrival time:', data.message);
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                            });
                    }

                    const textToCopy = document.getElementById('emailValue');
                    const popover = document.getElementById('popover');

                    textToCopy.addEventListener('click', function () {
                        const text = textToCopy.innerText;
                        navigator.clipboard.writeText(text)
                            .then(() => {
                                // Afficher le popover
                                popover.classList.remove('hidden');
                                popover.classList.add('flex', 'items-center', 'justify-center');

                                // Masquer le popover après 5 secondes
                                setTimeout(() => {
                                    popover.classList.add('hidden');
                                    popover.classList.remove('flex', 'items-center', 'justify-center');
                                }, 3000);
                            })
                            .catch(err => {
                                console.error('Erreur lors de la copie du texte : ', err);
                            });
                    });

                    function resizeView(view) {

                        var resources = @json($resources);
                        var initialHeight = 58;
                        var additionalHeightPerProperty = 58;
                        var totalHeight = initialHeight + resources.length * additionalHeightPerProperty;
                        var selectProperty = document.getElementById("resourceSelect");
                        console.log('Calculated totalHeight:', totalHeight);



                        // Récupérer l'élément
                        var element = document.querySelector('.fc-view-harness.fc-view-harness-active');
                        if (view === 'resourceTimelineTwoWeek' || view === 'resourceTimelineThreeMonth') {
                            if (element) {

                                selectProperty.classList.add('hidden');


                                // Changer la taille de l'élément
                                element.style.height = totalHeight + 'px'; // Nouvelle hauteur

                            }
                        }
                        else {
                            element.style.height = '690px'; // Nouvelle hauteur
                            selectProperty.classList.remove('hidden');
                            // Example object with reservation prices
                            var reservationPrices = {
                                '2024-07-19': 100,
                                '2024-07-20': 150,
                                // Add more dates and prices as needed
                            };

                            $('#calendar').fullCalendar({
                                dayRender: function (date, cell) {
                                    var formattedDate = date.format('YYYY-MM-DD');
                                    var price = reservationPrices[formattedDate];

                                    if (price !== undefined) {
                                        cell.append('<div style="text-align:center; background-color:blue; color:#fff;padding:2px 0;margin-top:20px;">Price: $' + price + '</div>');
                                    } else {
                                        cell.append('<div style="text-align:center; background-color:blue; color:#fff;padding:2px 0;margin-top:20px;">No Price</div>');
                                    }
                                }
                            });

                        }
                    }

                    window.addEventListener('resize', function () {
                        var ViewButtonContent = document.querySelector('.main-dropdown-button-content').innerText;
                        var view;

                        if (ViewButtonContent) {
                            switch (ViewButtonContent.textContent.trim()) {
                                case 'Property View':

                                    break;
                                case 'Month':
                                    view = 'resourceTimelineThreeMonth';
                                    break;
                                case 'Two week':
                                    view = 'resourceTimelineTwoWeek';
                                    break;

                            }

                            // Utilisation de setTimeout pour introduire un délai avant l'appel de resizeView
                            setTimeout(function () {
                                resizeView(view);
                            }, 200); // Délai de 100 ms
                        }
                    });



                </script>
                <!-- <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.css' rel='stylesheet' /> -->

            @endpush

        @endif
</div>