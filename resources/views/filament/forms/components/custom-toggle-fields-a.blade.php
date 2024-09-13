<style>
    /* Style pour le toggle switch */
    .toggle-switch {
        appearance: none;
        width: 40px;
        height: 20px;
        background: #d1d5db; /* Gris par défaut */
        border-radius: 9999px;
        position: relative;
        outline: none;
        transition: background-color 0.3s, transform 0.3s;
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

<div class="p-3">
    <div class="flex items-center justify-between mb-4">
        <label class="text-lg text-gray-900">{{ $label }}</label>
        <input type="checkbox" wire:model="{{ $statePath }}" class="toggle-switch">
    </div>
    <hr class="my-4">
</div>
