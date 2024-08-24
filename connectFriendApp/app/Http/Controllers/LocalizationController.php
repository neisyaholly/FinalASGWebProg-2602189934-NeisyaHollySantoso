<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Session;

class LocalizationController extends Controller
{
    public function switchLang($lang)
    {
        if (array_key_exists($lang, config('app.available_locales'))) {
            App::setLocale($lang);
            Session::put('locale', $lang);
        }
        return redirect()->back();
    }
}
