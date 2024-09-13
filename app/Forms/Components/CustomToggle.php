<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Field;
use Filament\Forms\Components\Concerns\HasLabel;

class CustomToggle extends Field
{
    use HasLabel;

    protected string $view = 'filament.forms.components.custom-toggle-fields';

    protected bool $isChecked = false;

    public function isChecked($value)
    {
        $this->isChecked = (bool) $value;

        return $this;
    }

    public function getIsChecked()
    {
        return $this->isChecked;
    }
}
