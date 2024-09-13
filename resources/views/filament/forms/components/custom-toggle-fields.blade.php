{{-- custom-toggle-fields.blade.php --}}

<div class="p-3">
    <div class="flex items-center justify-between mb-4">
        <label class="text-lg text-gray-900">{{ $getLabel() }}</label>

        <input type="checkbox" 
               class="toggle-switch" 
               wire:model="{{ $getStatePath() }}" 
               {{ $getState() ? 'checked' : '' }}
        >
    </div>
    <hr class="my-4">
</div>


<style>
    /* Styles pour le toggle switch, inchangés */
    .toggle-switch {
        appearance: none;
        width: 40px;
        height: 20px;
        background: #d1d5db; /* Gris par défaut */
        border-radius: 9999px;
        position: relative;
        cursor: pointer;
        outline: none;
        transition: background 0.3s;
    }
    
    .toggle-switch::before {
        content: "";
        position: absolute;
        width: 18px;
        height: 18px;
        background: white;
        border-radius: 9999px;
        top: 1px;
        left: 1px;
        transition: transform 0.3s;
    }
    
    .toggle-switch:checked {
        background: #D22C42; /* Rose quand activé */
    }
    
    .toggle-switch:checked::before {
        transform: translateX(20px);
    }
</style>
