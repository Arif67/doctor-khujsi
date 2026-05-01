<?php

namespace App\Models\Concerns;

trait HasLocalizedAttributes
{
    protected function localizedValue(string $baseField, mixed $defaultValue = null): mixed
    {
        $baseValue = $defaultValue ?? ($this->attributes[$baseField] ?? null);

        if (app()->getLocale() !== 'bn') {
            return $baseValue;
        }

        $localizedField = $baseField . '_bn';
        $localizedValue = $this->attributes[$localizedField] ?? null;

        return filled($localizedValue) ? $localizedValue : $baseValue;
    }
}
