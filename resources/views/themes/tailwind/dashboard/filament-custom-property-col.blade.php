@php
    $property = $getState();

    // dd($property->getFirstPhotoUrlAttribute());

@endphp
<div class="flex items-center">
    <img src="{{ './storage/' . $property->getFirstPhotoUrlAttribute() }}" class="h-10 rounded-lg mr-5 my-2" style="width: 50px" />
    <span style="font-size: 14px; color :#666565; font-weight: 400">{{ $property->attribute->name }}</span>
</div>
