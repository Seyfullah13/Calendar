@extends('theme::layouts.base')

@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@24.0.1/build/css/intlTelInput.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css" />
    <link rel="stylesheet" href="{{ asset('css/mini-calendar.css') }}">
    <style>
        .fi-pagination-overview {
            /* display: none !important; */
        }

        .fi-pagination-items {
            border-radius: 3.5px !important;
        }

        .text-primary-600 {
            color: #D22C42 !important;
        }

        .fi-ta-header-cell-label {
            text-transform: uppercase;
            color: #666565 !important;
        }

        .fi-ta-table thead {
            /* background-color: #F2F1F1; */
            height: 53px !important;
        }

        .fi-ta-text-item-label {
            color: #666565 !important;
            font-weight: 600;
            font-size: 14px !important;
        }

        .active {
            opacity: 1 !important;
            border-bottom: 2px solid #D22C42 !important;
        }

        /* ----------- */
        div.iti.iti--allow-dropdown.iti--show-flags.iti--inline-dropdown {
            width: 100%;
        }

        svg {
            width: unset !important;
        }
    </style>
@endsection

@section('content')
    <div class="px-3 py-5">
        @include('theme::partials.section-title', ['title' => 'Dashboard'])
        <div class="flex justify-between my-4">
            <h3 style="font-size: 20px" class="font-bold text-gray-900">Overview</h3>
            {{-- ! Months drop menu --}}
            {{-- <livewire:month-select :months="$months" /> --}}
        </div>
        <!-- Stats Cards-->
        <div class="flex flex-wrap gap-4 justify-center">
            {{--  ! Total Bookings --}}
            <livewire:dashboard-stats-card title="Total Bookings" icon="./themes/tailwind/images/dashboard_top/group.svg"
                :statistic="$total_booking" />

            {{-- ! Total Guests --}}
            <livewire:dashboard-stats-card title="Total Guests" icon="./themes/tailwind/images/dashboard_top/check.svg"
                :statistic="$total_guest" />

            {{-- ! Check-in --}}
            <livewire:dashboard-stats-card title="Check-in" icon="./themes/tailwind/images/dashboard_top/right-arrow.svg"
                :statistic="$check_in" />

            {{-- ! Check-out --}}
            <livewire:dashboard-stats-card title="Check-out" icon="./themes/tailwind/images/dashboard_top/left-arrow.svg"
                :statistic="$check_out" />

            {{-- ! Canceled --}}
            <livewire:dashboard-stats-card title="Canceled" icon="./themes/tailwind/images/dashboard_top/cross.svg"
                :statistic="$canceled" />

        </div>


        <!--Calendar-->
        <h3 style="font-size: 20px" class="font-bold text-gray-900 mt-4">Calendar</h3>
        <div>
            {{-- <h1 class="text-3xl">Calendar will be Here ...</h1> --}}
            <livewire:mini-calendar />
        </div>
        {{-- Check in/out Tables  -------------------------------------- --}}
        <div x-data="{ openIn: true, openOut: false }" class="my-4">

            <div x-data="{ activeTab: 'check-in' }" class="w-fit">
                <button @click="openIn = true; openOut = false;" :class="{ active: openIn }"
                    class="p-3 text-lg text-red-600 font-bold opacity-70 border-b-2">Check-in</button>
                <button @click="openOut = true; openIn = false;" :class="{ active: openOut }"
                    class="p-3 text-lg text-red-600 font-bold opacity-70 border-b-2">Check-out</button>
            </div>

            {{-- Tables --}}
            <div>

                <div x-show="openIn" class="my-4" x-transition>
                    @livewire('check.check-in')
                </div>
                <div x-show="openOut" class="my-4" x-transition>
                    @livewire('check.check-out')
                </div>

            </div>
        </div>

    </div>
@endsection
