<?php

namespace App\Http\Controllers;

use App\Models\BlogPostsCategory;
use App\Models\Course;
use App\Models\Post;
// use App\Models\Service;

use App\Models\Team;
use App\Models\CoverImage;
use App\Models\About;
use App\Models\Contact;
use App\Models\Country;
use App\Models\Service;
use App\Models\Category;
use App\Models\SiteSetting;
use App\Models\PhotoGallery;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class FrontViewController extends Controller
{
    public function index()
    {

        $coverimages= CoverImage::latest()->get()->take(6);
        $sitesetting = SiteSetting::first();
        $services = Service::latest()->get();
        $contacts = Contact::latest()->get();
        $blogs = BlogPostsCategory::latest()->get()->take(3);
        $courses = Course::latest()->get()->take(6);
        $testimonials = Testimonial::latest()->get()->take(10);

        $countries = Country::latest()->get()->take(10);
        $formsetting= SiteSetting::first();


       //Advisors
        $advisorsCategory = Category::where('title', 'Advisors')->first();
        $advisorsPosts = $advisorsCategory ? $advisorsCategory->posts()->latest()->get() : collect();

       // Collaborators
        $collaboratorsCategory = Category::where('title', 'Collaborators')->first();
        $collaboratorsPosts = $collaboratorsCategory ? $collaboratorsCategory->posts()->latest()->get() : collect();


       // Airlines 
        $airlinesCategory = Category::where('title', 'Airlines')->first();
        $airlinesPosts = $airlinesCategory ? $airlinesCategory->posts()->latest()->get() : collect();

        $lastCategory = Category::find('2');
        $countryUniversityCategory = $lastCategory;
        $sliderPost = $countryUniversityCategory ? $countryUniversityCategory->posts()->latest()->first() : null;
        $enrollPost = $countryUniversityCategory ? $countryUniversityCategory->posts()->orderBy('id', 'desc')->skip(1)->first() : null;
        $googleMapsLink = SiteSetting::first()?->google_maps_link ?? null;
        $images = PhotoGallery::latest()->get()->take(6);

        

        // Export/Import Guide posts
        $guidesCategory = Category::where('title', 'Export/Import Guide')->orWhere('title', 'Guide')->first();
        $guides = $guidesCategory ? $guidesCategory->posts()->latest()->get() : collect();


        return view('frontend.index', compact([
            'services',
            'contacts',
            'blogs',
            'courses',
            'testimonials',
            'countries',
            'sliderPost',
            'enrollPost',
            'coverimages',
            'googleMapsLink',
            'images',
            'advisorsCategory',
            'collaboratorsCategory',
            'airlinesCategory',
            'advisorsPosts',
            'airlinesPosts',
            'collaboratorsPosts',
            'formsetting',
            'sitesetting',
            'guides'


        ]));
    }
    public function singlePost($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $relatedPosts = Post::where('id', '!=', $post->id)->get();

        return view('frontend.posts', compact('post', 'relatedPosts'));
    }


    public function about()
    {
        $serviceList = Service::latest()->get()->take(6);
        $categories = Category::all();
        $services = Service::latest()->get();
        $sitesetting = SiteSetting::first();
        $about = About::first();
        $images = PhotoGallery::latest()->get();
        $googleMapsLink = SiteSetting::first()->google_maps_link;

        return view('frontend.aboutus', compact('serviceList', 'categories', 'sitesetting', 'about', 'services', 'images', 'googleMapsLink'));
    }
}
