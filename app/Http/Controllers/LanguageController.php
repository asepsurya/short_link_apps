<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switch($lang)
    {
        if (array_key_exists($lang, config('app.available_locales', ['en' => 'English', 'id' => 'Indonesian']))) {
            Session::put('locale', $lang);
        }
        return redirect()->back();
    }
}
