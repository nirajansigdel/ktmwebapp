<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function switch(Request $request): RedirectResponse
    {
        $request->validate([
            'locale' => ['required', 'in:en,ne'],
        ]);

        $request->session()->put('locale', $request->input('locale'));

        return back();
    }
}


