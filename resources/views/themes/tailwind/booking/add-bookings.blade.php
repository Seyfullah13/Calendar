@extends('theme::layouts.base2')

@section('content')
    <main class="wrapper w-full py-5 px-3 ml-2 ">
        <header class="flex justify-between mb-4 ml-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-950 dark:text-white">Add Booking</h1>
                <p style="color: gray">To add a reservation, follow the steps below. Simplify management and ensure all
                    necessary information is recorded.</p>
            </div>
        </header>


        <style>
            .tab-link {
                color: gray;
                font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
                font-size: 20px;
                padding: 0.75rem 1rem;
                margin-bottom: 0.25rem;
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                border-radius: 0.5rem;
                transition: background-color 0.3s, color 0.3s;
            }

            .btcolor {
                background-color: #004F5C
            }

            .resetbt-color {
                background-color: #D22C42
            }

            .tab-link.active {
                color: white;
                background-color: #004F5C;
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
                background-color: none;
                font-size: 14px;
                /* color: rgb(2, 2, 2); */
                margin-top: 0.25rem;
            }

            .description.hover {
                color: white
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
                /* Ajustez cette valeur selon vos besoins */
                height: 122%;
                /* Ajustez cette valeur selon vos besoins */
                text-align: center;
            }

            .text-gray-500 {
                color: #6B7280;
                /* Couleur grise */
            }

            .cursor-not-allowed {
                cursor: not-allowed;
            }
        </style>
        <div class="flex-grow flex overflow-hidden ml-24 mr-10">
            <div class="w-1/4 flex-shrink-0 sidebar">
                <ul class="flex flex-col space-y-4 text-lg font-medium text-gray-500 dark:text-gray-400">
                    <li class="tab-item">
                        <a href="#booking-settings" onclick="showSection('booking-settings', this); return false;"
                            class="tab-link inline-flex items-start rounded-lg w-full active">
                            {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                            </svg> --}}

                            Booking Settings
                            <p class="description active">Configure your reservation</p>
                        </a>
                    </li>
                    <li class="tab-item">
                        <a href="#guest" onclick="return false;"
                            class="tab-link inline-flex items-start rounded-lg w-full">
                            Guest Information
                            <p class="description">Provide essential guest details</p>
                        </a>
                    </li>
                    <li class="tab-item">
                        <a href="#pricing" onclick="return false;"
                            class="tab-link inline-flex items-start rounded-lg w-full">
                            Pricing
                            <p class="description">Review current pricing</p>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="flex-grow px-4 top-0 overflow-y-auto">
                {{-- Section side bar --}}
                <div id="booking-settings"
                    class="section p-6 bg-gray-50 text-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 rounded-lg"
                    style="display: block;">

                    @livewire('bookings.bookingForms.bookingSettings-form')
                </div>
                {{-- Section guest information --}}
                <div id="guest"
                    class="section p-6 bg-gray-50 text-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 rounded-lg"
                    style="display: none;">

                    @livewire('bookings.bookingForms.guestInformation-form')

                </div>

                {{-- Section de pricing --}}
                <div id="pricing"
                    class="section p-6 bg-gray-50 text-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 rounded-lg"
                    style="display: none;">
                    @livewire('bookings.bookingForms.pricing-form')
                </div>

                {{-- Page de résumé de la réservation --}}
                <div id="resume"
                    class="section p-6 bg-gray-50 text-medium  dark:text-gray-400 dark:bg-gray-800 rounded-lg"
                    style="display: none;">
                    @livewire('bookings.bookingForms.reviewBookings')

                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Add active class to the first tab link (Property Details)
                const hash = window.location.hash.substring(1);
                showSection('booking-settings', document.querySelector('a[onclick*="booking-settings"]'));
            });

            let isSaved = false;

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
                const saveButton = document.getElementById(`${sectionId}saveButton`);

            }

            function navigateSection(direction, sectionId) {

                const sections = ['booking-settings', 'guest', 'pricing', 'resume'];
                let currentIndex = sections.findIndex(sectionId => document.getElementById(sectionId).style.display ===
                'block');

                if (direction === 'next' && currentIndex < sections.length - 1) {
                    isSaved = false;
                    showSection(sections[currentIndex + 1], document.querySelector(`a[href="#${sections[currentIndex + 1]}"]`));
                    // Reset isSaved flag after navigating to the next section
                } else if (direction === 'previous' && currentIndex > 0) {
                    isSaved = false;
                    showSection(sections[currentIndex - 1], document.querySelector(`a[href="#${sections[currentIndex - 1]}"]`));

                }
            }

            document.addEventListener('livewire:load', function() {
                window.addEventListener('sectionUpdated', function(event) {
                    const sectionId = event.detail.sectionId;
                    showSection(sectionId, document.querySelector(`a[href="#${sectionId}"]`));
                });
            });
        </script>

    </main>
@endsection
