<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function changeLanguage($lang) {
        if (in_array($lang, ['en', 'bn'])) {
            session(['locale' => $lang]);
            App::setLocale($lang);
        }
        return redirect()->back();
    }
}
