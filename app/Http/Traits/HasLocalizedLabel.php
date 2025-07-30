<?php

namespace App\Http\Traits;

trait HasLocalizedLabel
{
    public function getLabelAttribute()
    {
        // Get the current application locale
        $locale = app()->getLocale();

        // Build the localized attribute name dynamically
        $localizedLabel = "label_{$locale}";

        // Return the value if it exists, or fallback to a default language
        return $this->attributes[$localizedLabel] ?? $this->attributes['label_en'] ?? null;
    }
}
