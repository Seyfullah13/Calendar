@extends('theme::layouts.base')
<style>

        html,
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
            font-size: 14px;
        }
</style>
@section('content')
  <h1 class="text-2xl font-semibold text-gray-900 text-center mt-24 mb-16">
    Contacts
  </h1>

  <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
    @foreach ($contacts as $contact)
      {{-- <div class="py-8 px-8 max-w-sm mx-auto bg-white rounded-xl shadow-lg space-y-2 sm:py-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-6">
        <img class="block mx-auto h-16 rounded-full sm:mx-0 sm:shrink-0" src="{{ '/storage/' . $contact->picture_url }}" alt="">
        <div class="text-center space-y-2 sm:text-left">
            <div class="space-y-0.5">
                <p class="text-lg text-black font-semibold">
                  {{ $contact->full_name }}
                </p>
                <p class="text-slate-500 font-medium text-sm">
                  {{ $contact->email }}
                </p>
            </div>
            <a href="#" class="px-4 py-1 text-sm text-indigo-500 font-semibold rounded-full border border-indigo-200 hover:text-white hover:bg-indigo-500 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Message</a>
            <a href="{{ route('contacts.show', ['contact' => $contact]) }}" class="px-4 py-1 text-sm text-indigo-500 font-semibold rounded-full border border-indigo-200 hover:text-white hover:bg-indigo-500 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">View contact</a>
        </div>
      </div> --}}


      <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="flex justify-end px-4 pt-4">
            <button id="{{ 'contact-dropdown-btn-' . $contact->id}}" data-dropdown-toggle="{{'contact-dropdown-' . $contact->id}}" class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5" type="button">
                <span class="sr-only">Open dropdown</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                    <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                </svg>
            </button>
            <!-- Dropdown menu -->
            <div id="{{'contact-dropdown-' . $contact->id}}" class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-30 dark:bg-gray-700">
              <ul class="py-2" aria-labelledby="{{ 'contact-dropdown-btn-' . $contact->id}}">
                <li>
                  <a href="#" class="block px-4 py-2 text-sm text-red-700 hover:bg-gray-100">Report</a>
                </li>
              </ul>
            </div>
        </div>
        <div class="flex flex-col items-center pb-10">
            <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="{{'/storage/' . $contact->picture_url}}" alt=""/>
            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $contact->full_name }}</h5>
            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $contact->email }}</span>
            <div class="flex mt-4 md:mt-6">
                <a href="{{ route('contacts.show', ['contact' => $contact]) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">View profile</a>
                <a href="#" class="py-2 px-4 ms-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Message</a>
            </div>
        </div>
      </div>

    @endforeach
  </div>

@endsection