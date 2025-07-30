<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    // switchLanguage
    public function switchLanguage($locale)
    {
        // Validate the locale
        $availableLocales = ['en', 'fr', 'ar'];
        if (!in_array($locale, $availableLocales)) {
            abort(404);
        }

        // Set the locale in the session
        session(['app_locale' => $locale]);

        // Redirect back to the previous page
        return redirect()->back();
    }
}
