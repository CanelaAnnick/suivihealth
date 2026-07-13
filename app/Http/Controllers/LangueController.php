<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LangueController extends Controller
{
    public function switch(Request $request, string $locale)
    {
        session(['locale' => in_array($locale, ['fr', 'en']) ? $locale : 'fr']);

        return back();
    }
}