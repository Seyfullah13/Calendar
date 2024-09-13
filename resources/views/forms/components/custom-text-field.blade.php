<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <style>
        .test{
            border: none
        }
    </style>
    <div x-data="{ state: $wire.$entangle('{{ $getStatePath() }}') }">
        <input x-model="state" class="test" disabled type="text"  name="" id="">
    </div>
</x-dynamic-component>
