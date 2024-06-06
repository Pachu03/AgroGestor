<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class LanguageController extends Controller
{
    public function switchLang($locale)
    {
        if (in_array($locale, config('app.locales'))) {
            \Log::info("Switching locale to: " . $locale);
            Session::put('applocale', $locale);
        }
        return Redirect::to(url()->previous());
    }

    public function change(Request $request)
    {
        App::setLocale($request->lang);
        session()->put('locale', $request->lang);
        return Redirect::to(url()->previous());
    }
}
