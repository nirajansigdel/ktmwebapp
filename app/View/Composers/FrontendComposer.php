<?php

namespace App\View\Composers;

use App\Models\SiteSetting;
use App\Models\Country;
use App\Models\Category;
use Illuminate\View\View;

class FrontendComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $sitesetting = SiteSetting::first();
        $countries = Country::latest()->get()->take(10);
        
        // Export/Import Guide posts - search flexibly for guide category (case-insensitive)
        $guidesCategory = Category::where(function($query) {
                $query->whereRaw('LOWER(title) LIKE ?', ['%export%import%guide%'])
                    ->orWhereRaw('LOWER(title) LIKE ?', ['%export%guide%'])
                    ->orWhereRaw('LOWER(title) LIKE ?', ['%import%guide%'])
                    ->orWhere('title', 'Export/Import Guide')
                    ->orWhere('title', 'Guide')
                    ->orWhere('title', 'Export Import Guide');
            })
            ->orWhere(function($query) {
                // Fallback: search for any category with "guide" in the title
                $query->whereRaw('LOWER(title) LIKE ?', ['%guide%'])
                    ->whereRaw('LOWER(title) NOT LIKE ?', ['%blog%']); // Exclude blog categories
            })
            ->first();
        
        // Get posts from the guide category
        $guides = $guidesCategory ? $guidesCategory->posts()->latest()->get() : collect();

        $view->with([
            'sitesetting' => $sitesetting,
            'countries' => $countries,
            'guides' => $guides,
        ]);
    }
}

