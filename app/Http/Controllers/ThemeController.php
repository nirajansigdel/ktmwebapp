<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function switch(Request $request): RedirectResponse
    {
        $request->validate([
            'theme' => ['required', 'in:dark,light'],
        ]);

        $request->session()->put('theme', $request->input('theme'));

        return back();
    }
}


