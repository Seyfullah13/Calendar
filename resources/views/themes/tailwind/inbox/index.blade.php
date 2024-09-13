@php
  function last_message_text($conversation) {
    $result = $conversation->last_message[1];
    $sent_or_received = ($conversation->last_message[0] === Auth::user()->contact->id) ? 'sent' : 'received';
    $attachment_word = ($conversation->last_message[3] > 1) ? 'attachments' : 'attachment';

    if($conversation->last_message[1] === '' && $conversation->last_message[3] > 0) {
      $result = 'You ' . $sent_or_received . ' ' . $conversation->last_message[3] . ' ' . $attachment_word . '.';
    }

    return $result;
  }
@endphp

@extends('theme::layouts.app2-no-footer')

@section('content')
  <div class="relative flex h-screen antialiased text-gray-800">
    <div class="h-full w-full overflow-x-hidden">
      <div class="flex flex-col px-10 py-8 bg-inherit flex-shrink-0 overflow-y-auto">
        <div class="flex flex-row items-center justify-center h-12 w-full">
          <div class="flex items-center justify-center rounded-2xl text-indigo-700 bg-indigo-100 h-10 w-10">
            <svg
              class="w-6 h-6"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"
              ></path>
            </svg>
          </div>
          <div class="ml-2 font-bold text-2xl">Inbox</div>
        </div>
        <div class="flex flex-col mt-8">
          <div class="flex flex-col space-y-1 mt-4 -mx-2 overflow-y-auto">
            @foreach ($conversations as $conversation)
              @php
                $conversation_booking = $conversation->booking;
                $conversation_has_booking = !is_null($conversation_booking);
                $interlocutor = null;

                if ($conversation_has_booking) 
                {
                  $picture = $conversation_booking->guest->picture;
                }
                else 
                {
                  $interlocutor = $conversation->contacts()->where('contacts.id', '!=', Auth::user()->contact->id)->first();
                  $picture = $interlocutor->picture_url;
                }
              @endphp
              <a 
                href="{{ route('inbox.show', ['conversation' => $conversation->id]) }}"
                class="
                  flex flex-row items-center gap-2 hover:bg-gray-100 rounded-xl p-4 border
                  {{ !$conversation->is_read ? 'border-l-4 border-blue-400 bg-blue-100 hover:bg-blue-200' : 'text-gray-500' }}
                "
              >
                <div class="relative shrink grow flex flex-row items-center w-5/12">
                  <div class="shrink-0 flex items-center justify-center h-8 w-8 bg-indigo-200 rounded-full overflow-hidden">
                    @if ($picture !== null)
                      <img class="h-full" src="{{ $picture }}" alt="">
                    @else
                      <svg 
                        class="w-6 h-6 text-gray-800 dark:text-white" 
                        aria-hidden="true" 
                        xmlns="http://www.w3.org/2000/svg" 
                        width="24" 
                        height="24" 
                        fill="currentColor" 
                        viewBox="0 0 24 24"
                      >
                        <path fill-rule="evenodd" d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z" clip-rule="evenodd"/>
                      </svg>
                    @endif
                  </div>
                  <div class="relative shrink grow flex flex-col min-w-0 justify-start ml-4 font-semibold">
                    <span class="text-md">
                      @if($conversation_has_booking)
                        {{ $conversation->booking->guest->fist_name }}
                      @else
                        {{ $interlocutor->full_name }}                      
                      @endif
                    </span>
                    <span class="text-sm max-w-full truncate">
                      @if ($conversation->last_message)
                        @if (
                          ($conversation->last_message[0] === Auth::user()->contact->id)
                          && ($conversation->last_message[1] !== '')
                          && ($conversation->last_message[2] !== 'notification')
                        )
                          You : 
                        @endif
                        {!! last_message_text($conversation) !!}
                      @else
                        Aucun message
                      @endif
                    </span>
                  </div>
                </div>
                @if($conversation_has_booking)
                  <div class="flex flex-row items-center w-5/12">
                    <div class="shrink-0 flex items-center justify-center h-8 w-8 bg-indigo-200 rounded-md">
                      {{-- @if ($conversation_booking->property->photos !== null) --}}
                        {{-- <img class="h-6" src="path/to/property/main/image" alt=""> --}}
                      {{-- @else --}}
                        <svg 
                          class="w-5 h-5 text-gray-800 dark:text-white" 
                          aria-hidden="true" 
                          xmlns="http://www.w3.org/2000/svg" 
                          width="24" 
                          height="24" 
                          fill="none" 
                          viewBox="0 0 24 24"
                        >
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5"/>
                        </svg>                    
                      {{-- @endif --}}
                    </div>
                    <div class="relative shrink grow flex flex-col min-w-0 justify-start ml-4 font-semibold">
                      <span class="text-md">
                        {{ $conversation_booking->status->name ?? null }}
                      </span>
                      <span class="text-sm max-w-full truncate">
                        {{ $conversation_booking->property->attribute->name }}
                      </span>
                    </div>
                  </div>  
                @endif
                <div class="flex flex-row items-center justify-end text-sm w-2/12">
                  {{ $conversation->updated_at->diffForHumans() }}
                </div>
              </a>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('javascript')
  <script type="module" src="{{ asset('themes/' . $theme->folder . '/js/inbox.js') }}"></script>
@endsection