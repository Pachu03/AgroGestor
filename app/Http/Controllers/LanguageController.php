<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class LanguageController extends Controller
{
    public function switchLang($locale)
    {
        // Agregar un mensaje de registro para mostrar el idioma actual de la aplicación
        Log::info('Current application language: ' . App::getLocale());

        // Agregar un mensaje de registro para mostrar el idioma que se va a cambiar
        Log::info('Starting switchLang method. Changing language to: ' . $locale);

        if (!in_array($locale, ['en', 'es'])) {
            abort(404);
        }

        // Agregar un mensaje de registro para verificar si el método se está ejecutando correctamente
        Log::info('Switching language to: ' . $locale);

        App::setLocale($locale);

        session()->put('locale', $locale);

        Log::info('Lenguaje de ahora: ' . App::getLocale());

        // Agregar otro mensaje de registro para verificar el idioma configurado en la sesión
        Log::info('Language set to: ' . session('locale'));

        // Agregar un mensaje de registro para verificar el idioma actual de la aplicación después de cambiarlo
        Log::info('Current application language after change: ' . App::getLocale());

        // Agregar un mensaje de registro para indicar que el método switchLang ha sido completado
        Log::info('Ending switchLang method');

        return redirect()->route('dashboard');
    }
}
