<?php

namespace App\Filament\Resources\Forms\Components;

use Filament\Resources\Forms\Components\Field;

class Abilities extends Field
{
    public $view = 'filament.forms.components.abilities';

    public function getAbilities()
    {
        return config('auth.abilities');
    }

    public function getRules($field = null)
    {
        $rules = [];

        foreach ($this->getAbilities() as $key => $label) {
            $rules[$this->getName() . '.' . $key] = ['boolean'];
        }

        return $rules;
    }

    public function isChecked($key)
    {
        $value = $this->getValue();
        return isset($value[$key]) && $value[$key] === true;
    }

    public function getNameForOption($key)
    {
        return $this->getName() . '.' . $key;
    }
}
