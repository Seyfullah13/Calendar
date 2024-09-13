@php
    $guest = $getState();
@endphp
<div class="flex items-center">
    <img src="{{ $guest->picture ?? './storage/avatars/default.jpg' }}" class="w-12 h-12 rounded-full mr-5 my-2" />
    <span style="font-size: 14px; color :#666565; font-weight: 400">{{ $guest->first_name . ' ' . $guest->last_name }}</span>
</div>
