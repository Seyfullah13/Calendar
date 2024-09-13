@extends('theme::layouts.app2-no-footer') 

@section('content')

  <div id="conversations-container">
    <MessagerieComponent />
  </div>
  
@endsection

@section('javascript')
  {{-- <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" /> --}}
  <script src="https://cdn.tailwindcss.com"></script>
  {{-- <script type="module" src="{{ asset('themes/' . $theme->folder . '/js/inbox.js') }}"></script> --}}
@endsection