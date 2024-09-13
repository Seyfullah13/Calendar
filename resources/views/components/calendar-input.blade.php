@php
dd($record);
@endphp
<div>
    @livewire('properties.calendar', ['record' => $record])
</div>
