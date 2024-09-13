<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-900 rounded-lg sm:hidden hover:bg-secondary-700 active:bg-secondary-500 focus:outline-none focus:ring-2 focus:ring-gray-200">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                    </svg>
                    {{--nom et logo--}}
                </button>
                <a href="{{ route('wave.home') }}" class="flex ms-2 md:me-24">
                    <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 me-3" alt="FlowBite Logo" />
                    <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap">InnovRental</span>
                </a>
            </div>
            <div class="flex items-center">
                <div class="flex items-center ms-3">
                    <div class="flex sm:ml-6 sm:items-center">
                        @if( auth()->user()->onTrial() )
                            <div class="relative items-center justify-center hidden h-full md:flex">
                                <span class="px-3 py-1 text-xs text-red-600 bg-red-100 border border-gray-200 rounded-md">You have {{ auth()->user()->daysLeftOnTrial() }} @if(auth()->user()->daysLeftOnTrial() > 1){{ 'Days' }}@else{{ 'Day' }}@endif left on your Trial</span>
                            </div>
                        @endif
                
                        @include('theme::partials.notifications')
                
                        <!-- Profile dropdown -->
                        <div @click.away="open = false" class="relative flex items-center h-full ml-3" x-data="{ open: false }">
                            <div>
                                <button @click="open = !open" class="flex text-sm transition duration-150 ease-in-out border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300" id="user-menu" aria-label="User menu" aria-haspopup="true" x-bind:aria-expanded="open" aria-expanded="true">
                                    <img class="w-8 h-8 rounded-full" src="{{ auth()->user()->avatar() . '?' . time() }}" alt="{{ auth()->user()->name }}'s Avatar">
                                </button>
                            </div>
                
                            <div
                                x-show="open"
                                x-transition:enter="duration-100 ease-out scale-95"
                                x-transition:enter-start="opacity-50 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition duration-50 ease-in scale-100"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                                class="absolute top-0 right-0 w-56 mt-20 origin-top-right transform rounded-xl" x-cloak>
                
                                <div class="bg-white border border-gray-100 shadow-md rounded-xl" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                                    <a href="{{ route('wave.profile', auth()->user()->username) }}" class="block px-4 py-3 text-gray-700 hover:text-gray-800">
                
                                        <span class="block text-sm font-medium leading-tight truncate">
                                            {{ auth()->user()->name }}
                                        </span>
                                        <span class="text-xs leading-5 text-gray-600">
                                            View Profile
                                        </span>
                                    </a>
                                    @impersonating
                                            <a href="{{ route('impersonate.leave') }}" class="block px-4 py-2 text-sm leading-5 text-blue-900 border-t border-gray-100 bg-blue-50 hover:bg-blue-100 focus:outline-none focus:bg-blue-200">Leave impersonation</a>
                                    @endImpersonating
                                    <div class="border-t border-gray-100"></div>
                                    <div class="py-1">
                                        <div class="block px-4 py-1">
                                            <span class="inline-block px-2 my-1 -ml-1 text-xs font-medium leading-5 text-gray-600 bg-gray-200 rounded">{{ auth()->user()->role->display_name }}</span>
                                        </div>
                                        @trial
                                            <a href="{{ route('wave.settings', 'plans') }}" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-secondary-700 active:bg-secondary-500 hover:text-white focus:outline-none focus:bg-secondary-700 focus:text-white">Upgrade My Account</a>
                                        @endtrial
                                        @if( !auth()->guest() && auth()->user()->can('browse_admin') )
                                            <a href="{{ route('voyager.dashboard') }}" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-secondary-700 active:bg-secondary-500 hover:text-white focus:outline-none focus:bg-secondary-700 focus:text-white"><i class="fa fa-bolt"></i> Admin</a>
                                        @endif
                                        <a href="{{ route('wave.settings') }}" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-secondary-700 active:bg-secondary-500 hover:text-white focus:outline-none focus:bg-secondary-700 focus:text-white">Settings</a>
                
                                    </div>
                                    <div class="border-t border-gray-100"></div>
                                    <div class="py-1">
                                        <a href="{{ route('wave.logout') }}" class="block w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 hover:bg-secondary-700 active:bg-secondary-500 hover:text-white focus:outline-none focus:bg-secondary-700 focus:text-white" role="menuitem">
                                            Sign out
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{ route('wave.dashboard') }}" class="flex items-center p-2 text-gray-900 rounded-lg {{ Request::is('dashboard*') ? 'bg-secondary-500 text-white' : 'hover:bg-secondary-700 active:bg-secondary-500' }} group" >
                    {{-- <svg class="flex-shrink-0 w-5 h-5 text-gray-900 transition duration-75 group-hover:text-white {{ Request::is('dashboard*') ? 'text-white' : 'group-hover:text-white' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                        <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                    </svg> --}}
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-900 transition duration-75 group-hover:text-white {{ Request::is('dashboard*') ? 'text-white' : 'group-hover:text-white' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M2.40002 12C2.40002 9.45395 3.41145 7.01215 5.2118 5.2118C7.01215 3.41145 9.45395 2.40002 12 2.40002V12H21.6C21.6 14.5461 20.5886 16.9879 18.7882 18.7882C16.9879 20.5886 14.5461 21.6 12 21.6C9.45395 21.6 7.01215 20.5886 5.2118 18.7882C3.41145 16.9879 2.40002 14.5461 2.40002 12Z"/>
                        <path d="M14.4 2.70239C16.0604 3.13255 17.5755 3.99893 18.7883 5.21174C20.0011 6.42454 20.8675 7.93964 21.2976 9.59999H14.4V2.70239Z"/>
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap {{ Request::is('dashboard*') ? 'text-white' : 'group-hover:text-white' }}">Dashboard</span>
                </a>
            </li>
            {{-- Booking link  --}}
            <li>
                <a href="{{ route('booking') }}" class="flex items-center p-2 text-gray-900 rounded-lg {{ Request::is('booking*') ? 'bg-secondary-500 text-white' : 'hover:bg-secondary-700 active:bg-secondary-500' }} group">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-900 transition duration-75 group-hover:text-white {{ Request::is('booking*') ? 'text-white' : 'group-hover:text-white' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                        <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap {{ Request::is('booking*') ? 'text-white' : 'group-hover:text-white' }}">Booking</span>
                    <span class="inline-flex items-center justify-center px-2 ms-3 text-sm font-medium text-gray-800 bg-gray-100 rounded-full">Pro</span>
                </a>
            </li>
            {{-- Calendar link --}}
            <li>
                <a href="{{ route('calendar') }}" class="flex items-center p-2 text-gray-900 rounded-lg {{ Request::is('calendar*') ? 'bg-secondary-500 text-white' : 'hover:bg-secondary-700 active:bg-secondary-500' }} group">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-900 transition duration-75 group-hover:text-white {{ Request::is('calendar*') ? 'text-white' : 'group-hover:text-white' }}" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.20002 2.40002C6.88176 2.40002 6.57654 2.52645 6.3515 2.7515C6.12645 2.97654 6.00002 3.28176 6.00002 3.60002V4.80002H4.80002C4.1635 4.80002 3.55306 5.05288 3.10297 5.50297C2.65288 5.95306 2.40002 6.56351 2.40002 7.20002V19.2C2.40002 19.8365 2.65288 20.447 3.10297 20.8971C3.55306 21.3472 4.1635 21.6 4.80002 21.6H19.2C19.8365 21.6 20.447 21.3472 20.8971 20.8971C21.3472 20.447 21.6 19.8365 21.6 19.2V7.20002C21.6 6.56351 21.3472 5.95306 20.8971 5.50297C20.447 5.05288 19.8365 4.80002 19.2 4.80002H18V3.60002C18 3.28176 17.8736 2.97654 17.6486 2.7515C17.4235 2.52645 17.1183 2.40002 16.8 2.40002C16.4818 2.40002 16.1765 2.52645 15.9515 2.7515C15.7265 2.97654 15.6 3.28176 15.6 3.60002V4.80002H8.40002V3.60002C8.40002 3.28176 8.2736 2.97654 8.04855 2.7515C7.82351 2.52645 7.51828 2.40002 7.20002 2.40002ZM7.20002 8.40002C6.88176 8.40002 6.57654 8.52645 6.3515 8.7515C6.12645 8.97654 6.00002 9.28176 6.00002 9.60002C6.00002 9.91828 6.12645 10.2235 6.3515 10.4486C6.57654 10.6736 6.88176 10.8 7.20002 10.8H16.8C17.1183 10.8 17.4235 10.6736 17.6486 10.4486C17.8736 10.2235 18 9.91828 18 9.60002C18 9.28176 17.8736 8.97654 17.6486 8.7515C17.4235 8.52645 17.1183 8.40002 16.8 8.40002H7.20002Z"/>
                    </svg>                        
                    <span class="flex-1 ms-3 whitespace-nowrap {{ Request::is('calendar*') ? 'text-white' : 'group-hover:text-white' }}">Calendar</span>
                </a>
            </li>
            {{-- Inbox link --}}
            <li>
                <a href="{{ route('inbox') }}" class="relative flex items-center p-2 text-gray-900 rounded-lg {{ Request::is('inbox*') ? 'bg-secondary-500 text-white' : 'hover:bg-secondary-700 active:bg-secondary-500' }} group">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-900 transition duration-75 group-hover:text-white {{ Request::is('inbox*') ? 'text-white' : 'group-hover:text-white' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M21.6 5.99998V15.6C21.6 16.2365 21.3472 16.8469 20.8971 17.297C20.447 17.7471 19.8365 18 19.2 18H13.2L7.20002 22.8V18H4.80002C4.1635 18 3.55306 17.7471 3.10297 17.297C2.65288 16.8469 2.40002 16.2365 2.40002 15.6V5.99998C2.40002 5.36346 2.65288 4.75301 3.10297 4.30292C3.55306 3.85283 4.1635 3.59998 4.80002 3.59998H19.2C19.8365 3.59998 20.447 3.85283 20.8971 4.30292C21.3472 4.75301 21.6 5.36346 21.6 5.99998ZM8.40002 9.59998H6.00002V12H8.40002V9.59998ZM10.8 9.59998H13.2V12H10.8V9.59998ZM18 9.59998H15.6V12H18V9.59998Z"/>
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap {{ Request::is('inbox*') ? 'text-white' : 'group-hover:text-white' }}">Inbox</span>

                    <div id="unread-conversations-counter">
                        <UnreadConversationsCounter />
                    </div>
                </a>
            </li>
            <li>
                <a href="{{ route('customers') }}" class="relative flex items-center p-2 text-gray-900 rounded-lg {{ Request::is('customers*') ? 'bg-secondary-500 text-white' : 'hover:bg-secondary-700 active:bg-secondary-500' }} group">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-900 transition duration-75 group-hover:text-white {{ Request::is('customers*') ? 'text-white' : 'group-hover:text-white' }}"  aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap {{ Request::is('customers*') ? 'text-white' : 'group-hover:text-white' }}">Clients</span>
                </a>
            </li>
            <li>
                <a href="{{ route('properties') }}" class="flex items-center p-2 text-gray-900 rounded-lg {{ Request::is('properties*') ? 'bg-secondary-500 text-white' : 'hover:bg-secondary-700 active:bg-secondary-500' }} group">
                    {{-- <svg class="flex-shrink-0 w-5 h-5 text-gray-900 transition duration-75 group-hover:text-white {{ Request::is('properties*') ? 'text-white' : 'group-hover:text-white' }}"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor"
                            viewBox="0 0 18 20">
                            <path fill-rule="evenodd"
                                d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z"
                                clip-rule="evenodd"/>
                    </svg> --}}
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-900 transition duration-75 group-hover:text-white {{ Request::is('properties*') ? 'text-white' : 'group-hover:text-white' }}" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.8484 2.75161C12.6234 2.52665 12.3182 2.40027 12 2.40027C11.6818 2.40027 11.3766 2.52665 11.1516 2.75161L2.75159 11.1516C2.533 11.3779 2.41205 11.6811 2.41478 11.9957C2.41751 12.3103 2.54372 12.6113 2.76621 12.8338C2.9887 13.0563 3.28967 13.1825 3.60431 13.1852C3.91894 13.188 4.22207 13.067 4.44839 12.8484L4.79999 12.4968V20.4C4.79999 20.7183 4.92642 21.0235 5.15146 21.2485C5.3765 21.4736 5.68173 21.6 5.99999 21.6H8.39999C8.71825 21.6 9.02347 21.4736 9.24852 21.2485C9.47356 21.0235 9.59999 20.7183 9.59999 20.4V18C9.59999 17.6818 9.72642 17.3765 9.95146 17.1515C10.1765 16.9264 10.4817 16.8 10.8 16.8H13.2C13.5182 16.8 13.8235 16.9264 14.0485 17.1515C14.2736 17.3765 14.4 17.6818 14.4 18V20.4C14.4 20.7183 14.5264 21.0235 14.7515 21.2485C14.9765 21.4736 15.2817 21.6 15.6 21.6H18C18.3182 21.6 18.6235 21.4736 18.8485 21.2485C19.0736 21.0235 19.2 20.7183 19.2 20.4V12.4968L19.5516 12.8484C19.7779 13.067 20.081 13.188 20.3957 13.1852C20.7103 13.1825 21.0113 13.0563 21.2338 12.8338C21.4563 12.6113 21.5825 12.3103 21.5852 11.9957C21.5879 11.6811 21.467 11.3779 21.2484 11.1516L12.8484 2.75161Z"/>
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap {{ Request::is('properties*') ? 'text-white' : 'group-hover:text-white' }}">My properties</span>
                </a>
            </li>
            {{-- Statistics link --}}
            <li>
                <a href="{{ route('statistics') }}" class="flex items-center p-2 text-gray-900 rounded-lg {{ Request::is('statistics*') ? 'bg-secondary-500 text-white' : 'hover:bg-secondary-700 active:bg-secondary-500' }} group">
                <svg class="flex-shrink-0 w-5 h-5 text-gray-900 transition duration-75 group-hover:text-white {{ Request::is('statistics*') ? 'text-white' : 'group-hover:text-white' }}" aria-hidden="true" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M3.60002 3.59998C3.28176 3.59998 2.97654 3.7264 2.7515 3.95145C2.52645 4.17649 2.40002 4.48172 2.40002 4.79998C2.40002 5.11824 2.52645 5.42346 2.7515 5.6485C2.97654 5.87355 3.28176 5.99998 3.60002 5.99998V15.6C3.60002 16.2365 3.85288 16.8469 4.30297 17.297C4.75306 17.7471 5.3635 18 6.00002 18H9.10322L7.55162 19.5516C7.43701 19.6623 7.34559 19.7947 7.2827 19.9411C7.21981 20.0875 7.18671 20.245 7.18532 20.4043C7.18394 20.5636 7.2143 20.7216 7.27464 20.8691C7.33498 21.0166 7.42408 21.1506 7.53675 21.2632C7.64942 21.3759 7.7834 21.465 7.93088 21.5254C8.07836 21.5857 8.23637 21.6161 8.39571 21.6147C8.55504 21.6133 8.7125 21.5802 8.85891 21.5173C9.00531 21.4544 9.13773 21.363 9.24842 21.2484L12 18.4968L14.7516 21.2484C14.9779 21.467 15.2811 21.5879 15.5957 21.5852C15.9103 21.5825 16.2113 21.4562 16.4338 21.2338C16.6563 21.0113 16.7825 20.7103 16.7852 20.3957C16.788 20.081 16.667 19.7779 16.4484 19.5516L14.8968 18H18C18.6365 18 19.247 17.7471 19.6971 17.297C20.1472 16.8469 20.4 16.2365 20.4 15.6V5.99998C20.7183 5.99998 21.0235 5.87355 21.2486 5.6485C21.4736 5.42346 21.6 5.11824 21.6 4.79998C21.6 4.48172 21.4736 4.17649 21.2486 3.95145C21.0235 3.7264 20.7183 3.59998 20.4 3.59998H3.60002ZM17.6484 9.24837C17.867 9.02205 17.988 8.71893 17.9852 8.40429C17.9825 8.08966 17.8563 7.78868 17.6338 7.56619C17.4113 7.3437 17.1103 7.2175 16.7957 7.21477C16.4811 7.21203 16.1779 7.33299 15.9516 7.55158L12 11.5032L10.4484 9.95158C10.2234 9.72661 9.91822 9.60023 9.60002 9.60023C9.28183 9.60023 8.97666 9.72661 8.75163 9.95158L6.35162 12.3516C6.23701 12.4623 6.14559 12.5947 6.0827 12.7411C6.01981 12.8875 5.98671 13.045 5.98532 13.2043C5.98394 13.3636 6.0143 13.5216 6.07464 13.6691C6.13498 13.8166 6.22408 13.9506 6.33675 14.0632C6.44942 14.1759 6.5834 14.265 6.73088 14.3254C6.87836 14.3857 7.03637 14.4161 7.19571 14.4147C7.35504 14.4133 7.51251 14.3802 7.65891 14.3173C7.80531 14.2544 7.93773 14.163 8.04842 14.0484L9.60002 12.4968L11.1516 14.0484C11.3767 14.2733 11.6818 14.3997 12 14.3997C12.3182 14.3997 12.6234 14.2733 12.8484 14.0484L17.6484 9.24837Z" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap {{ Request::is('statistics*') ? 'text-white' : 'group-hover:text-white' }}">Statistics</span>
                </a>
            </li>

            <li>
                <a href="{{ route('account') }}" class="flex items-center p-2 text-gray-900 rounded-lg {{ Request::is('account*') ? 'bg-secondary-500 text-white' : 'hover:bg-secondary-700 active:bg-secondary-500'}} group">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-900 transition duration-75 group-hover:text-white {{ Request::is('account*') ? 'text-white' : 'group-hover:text-white' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 0C4.579 0 0 4.579 0 10C0 15.421 4.579 20 10 20C15.421 20 20 15.421 20 10C20 4.579 15.421 0 10 0ZM10 5C11.727 5 13 6.272 13 8C13 9.728 11.727 11 10 11C8.274 11 7 9.728 7 8C7 6.272 8.274 5 10 5ZM4.894 14.772C5.791 13.452 7.287 12.572 9 12.572H11C12.714 12.572 14.209 13.452 15.106 14.772C13.828 16.14 12.015 17 10 17C7.985 17 6.172 16.14 4.894 14.772Z" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap {{ Request::is('account*') ? 'text-white' : 'group-hover:text-white' }}">My account</span>

                </a>
            </li>
            <li>
                <a href="{{ route('contacts') }}" class="flex items-center p-2 text-gray-900 rounded-lg {{ Request::is('contacts*') ? 'bg-secondary-500 text-white' : 'hover:bg-secondary-700 active:bg-secondary-500'}} group">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-900 transition duration-75 group-hover:text-white {{ Request::is('contacts*') ? 'text-white' : 'group-hover:text-white' }}" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M21 2H6a2 2 0 0 0-2 2v3H2v2h2v2H2v2h2v2H2v2h2v3a2 2 0 0 0 2 2h15a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1zm-8 2.999c1.648 0 3 1.351 3 3A3.012 3.012 0 0 1 13 11c-1.647 0-3-1.353-3-3.001 0-1.649 1.353-3 3-3zM19 18H7v-.75c0-2.219 2.705-4.5 6-4.5s6 2.281 6 4.5V18z"></path></svg>
                    <span class="flex-1 ms-3 whitespace-nowrap {{ Request::is('contacts*') ? 'text-white' : 'group-hover:text-white' }}">Contacts</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
