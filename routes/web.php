<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\CoverImageController;
use App\Http\Controllers\PhotoGalleryController;
use App\Http\Controllers\FrontViewController;
use App\Http\Controllers\ParcelTrackingController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\FaviconController;
use App\Http\Controllers\VisitorBookController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\VideoGalleryController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\BlogPostsCategoryController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\DirectorMessageController;
use App\Http\Controllers\SingleController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ReceiverController;
use App\Http\Controllers\ItemController;
Route::get('/', [FrontViewController::class, 'index'])->name('home');

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::view('/register', 'backend.auth.register')->name('register');

// Frontend placeholder
Route::view('/home', 'frontend.home')->name('frontend.home');

// Locale
Route::post('/locale', [LocaleController::class, 'switch'])->name('locale.switch');
// Theme
Route::post('/theme', [ThemeController::class, 'switch'])->name('theme.switch');

 // Public preview route to render sidebackforforntend (no auth)
 Route::view('/frontend-post', 'backend.layouts.sidebackforforntend')->name('frontend.post');

// Parcel Tracking (Public route for frontend)
Route::post('/track-parcel', [ParcelTrackingController::class, 'track'])->name('track-parcel');

// Backend routes (prefix: /admin)
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // Dashboard
    Route::view('/', 'backend.dashboard.index')->name('dashboard');
    Route::view('/dashboard', 'backend.dashboard.index')->name('dashboard.index');
 
     // Debug: render the raw sidebar include in a standalone page
     Route::get('/debug/sidebar', function () {
         return view('backend.debug.sidebar_preview');
     })->name('debug.sidebar');

    // "Post to the Frontend" - show the specified backend layout preview page
    Route::view('/frontend-post', 'backend.layouts.sidebackforforntend')->name('frontend.post');

    // Item Entry / Details
    Route::prefix('items')->name('items.')->group(function () {
        Route::get('/entry', function () {
            $customers = \App\Models\Customer::all();
            $receivers = \App\Models\Receiver::all();
            return view('backend.items.entry', compact('customers', 'receivers'));
        })->name('entry');
        Route::post('/entry', [ItemController::class, 'store'])->name('store');
        Route::view('/details', 'backend.items.details')->name('details');
    });

    // Customers
    Route::resource('customers', CustomerController::class);

    // Receivers
    Route::resource('receivers', ReceiverController::class);

    // Account: income, expense, inventory (account), reports
    Route::prefix('account')->name('account.')->group(function () {
        Route::view('/income', 'backend.account.income')->name('income');
        Route::view('/expense', 'backend.account.expense')->name('expense');
        Route::view('/inventory', 'backend.account.inventory')->name('inventory');
        Route::view('/report', 'backend.account.report')->name('report');
    });

    // Vendors
    Route::prefix('vendor')->name('vendor.')->group(function () {
        Route::view('/', 'backend.vendor.index')->name('index');
        // In real app use /{id}
        Route::view('/show', 'backend.vendor.show')->name('show');
    });

    // Reports
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::view('/income-expense', 'backend.reports.income_expense')->name('income_expense');
        Route::view('/account-statement', 'backend.reports.account_statement')->name('account_statement');
    });

    // Inventory module
    Route::prefix('inventory')->name('inventory.')->group(function () {
        Route::view('/', 'backend.inventory.index')->name('index');
    });

    // Payments (Amount Paid)
    Route::prefix('payments')->name('payments.')->group(function () {
        Route::view('/', 'backend.payments.index')->name('index');
    });

    // Settings
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::view('/profile', 'backend.settings.profile')->name('profile');
        Route::view('/users', 'backend.settings.user_management')->name('users');
    });

    // Notifications
    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::view('/', 'backend.notifications.index')->name('index');
    });

    // Audit
    Route::prefix('audit')->name('audit.')->group(function () {
        Route::view('/', 'backend.audit.index')->name('index');
    });

    // Backup & Restore
    Route::prefix('backup')->name('backup.')->group(function () {
        Route::view('/', 'backend.backup.index')->name('index');
    });

    // Cover Image
    Route::prefix('cover-images')->name('cover-images.')->group(function () {
        Route::get('/', [CoverImageController::class, 'index'])->name('index');
        Route::get('/create', [CoverImageController::class, 'create'])->name('create');
        Route::post('/store', [CoverImageController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CoverImageController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [CoverImageController::class, 'update'])->name('update');
        Route::patch('/update/{id}', [CoverImageController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [CoverImageController::class, 'destroy'])->name('destroy');
    });

    // Photo Gallery
    Route::prefix('photo-galleries')->name('photo-galleries.')->group(function () {
        Route::get('/', [PhotoGalleryController::class, 'index'])->name('index');
        Route::get('/create', [PhotoGalleryController::class, 'create'])->name('create');
        Route::post('/store', [PhotoGalleryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [PhotoGalleryController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [PhotoGalleryController::class, 'update'])->name('update');
        Route::patch('/update/{id}', [PhotoGalleryController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [PhotoGalleryController::class, 'destroy'])->name('destroy');
    });

    // Services
    Route::prefix('services')->name('services.')->group(function () {
        Route::get('/', [ServiceController::class, 'index'])->name('index');
        Route::get('/create', [ServiceController::class, 'create'])->name('create');
        Route::post('/store', [ServiceController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ServiceController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [ServiceController::class, 'update'])->name('update');
        Route::patch('/update/{id}', [ServiceController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [ServiceController::class, 'destroy'])->name('destroy');
    });

    // Site Settings
    Route::prefix('site-settings')->name('site-settings.')->group(function () {
        Route::get('/', [SiteSettingController::class, 'index'])->name('index');
        Route::get('/create', [SiteSettingController::class, 'create'])->name('create');
        Route::post('/store', [SiteSettingController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [SiteSettingController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [SiteSettingController::class, 'update'])->name('update');
        Route::patch('/update/{id}', [SiteSettingController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [SiteSettingController::class, 'destroy'])->name('destroy');
    });

    // Favicons
    Route::prefix('favicons')->name('favicons.')->group(function () {
        Route::get('/', [FaviconController::class, 'index'])->name('index');
        Route::get('/create', [FaviconController::class, 'create'])->name('create');
        Route::post('/store', [FaviconController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [FaviconController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [FaviconController::class, 'update'])->name('update');
        Route::patch('/update/{id}', [FaviconController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [FaviconController::class, 'destroy'])->name('destroy');
    });

    // Visitors Book
    Route::prefix('visitors-book')->name('visitors-book.')->group(function () {
        Route::get('/', [VisitorBookController::class, 'index'])->name('index');
        Route::get('/create', [VisitorBookController::class, 'create'])->name('create');
        Route::post('/store', [VisitorBookController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [VisitorBookController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [VisitorBookController::class, 'update'])->name('update');
        Route::patch('/update/{id}', [VisitorBookController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [VisitorBookController::class, 'destroy'])->name('destroy');
    });

    // Contacts
    Route::prefix('contacts')->name('contacts.')->group(function () {
        Route::get('/', [ContactController::class, 'index'])->name('index');
        Route::get('/create', [ContactController::class, 'create'])->name('create');
        Route::post('/store', [ContactController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ContactController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [ContactController::class, 'update'])->name('update');
        Route::patch('/update/{id}', [ContactController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [ContactController::class, 'destroy'])->name('destroy');
    });

    // Countries
    Route::prefix('countries')->name('countries.')->group(function () {
        Route::get('/', [CountryController::class, 'index'])->name('index');
        Route::get('/create', [CountryController::class, 'create'])->name('create');
        Route::post('/store', [CountryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CountryController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [CountryController::class, 'update'])->name('update');
        Route::patch('/update/{id}', [CountryController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [CountryController::class, 'destroy'])->name('destroy');
    });

    // About Us
    Route::prefix('about-us')->name('about-us.')->group(function () {
        Route::get('/', [AboutController::class, 'index'])->name('index');
        Route::get('/create', [AboutController::class, 'create'])->name('create');
        Route::post('/store', [AboutController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AboutController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [AboutController::class, 'update'])->name('update');
        Route::patch('/update/{id}', [AboutController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [AboutController::class, 'destroy'])->name('destroy');
    });

    // Teams
    Route::resource('teams', TeamController::class);

    // Categories
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [CategoryController::class, 'update'])->name('update');
        Route::patch('/update/{id}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [CategoryController::class, 'destroy'])->name('destroy');
    });

    // Posts
    Route::prefix('posts')->name('posts.')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::post('/store', [PostController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [PostController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [PostController::class, 'update'])->name('update');
        Route::patch('/update/{id}', [PostController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [PostController::class, 'destroy'])->name('destroy');
    });

    // Video Galleries
    Route::prefix('video-galleries')->name('video-galleries.')->group(function () {
        Route::get('/', [VideoGalleryController::class, 'index'])->name('index');
        Route::get('/create', [VideoGalleryController::class, 'create'])->name('create');
        Route::post('/store', [VideoGalleryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [VideoGalleryController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [VideoGalleryController::class, 'update'])->name('update');
        Route::patch('/update/{id}', [VideoGalleryController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [VideoGalleryController::class, 'destroy'])->name('destroy');
    });

    // Testimonials
    Route::prefix('testimonials')->name('testimonials.')->group(function () {
        Route::get('/', [TestimonialController::class, 'index'])->name('index');
        Route::get('/create', [TestimonialController::class, 'create'])->name('create');
        Route::post('/store', [TestimonialController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [TestimonialController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [TestimonialController::class, 'update'])->name('update');
        Route::patch('/update/{id}', [TestimonialController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [TestimonialController::class, 'destroy'])->name('destroy');
    });

    // Blog Posts Categories
    Route::prefix('blog-posts-categories')->name('blog-posts-categories.')->group(function () {
        Route::get('/', [BlogPostsCategoryController::class, 'index'])->name('index');
        Route::get('/create', [BlogPostsCategoryController::class, 'create'])->name('create');
        Route::post('/store', [BlogPostsCategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [BlogPostsCategoryController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [BlogPostsCategoryController::class, 'update'])->name('update');
        Route::patch('/update/{id}', [BlogPostsCategoryController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [BlogPostsCategoryController::class, 'destroy'])->name('destroy');
    });

    // FAQs
    Route::prefix('faqs')->name('faqs.')->group(function () {
        Route::get('/', [FaqController::class, 'index'])->name('index');
        Route::get('/create', [FaqController::class, 'create'])->name('create');
        Route::post('/store', [FaqController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [FaqController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [FaqController::class, 'update'])->name('update');
        Route::patch('/update/{id}', [FaqController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [FaqController::class, 'destroy'])->name('destroy');
    });

    // Director Messages
    Route::prefix('director_messages')->name('director_messages.')->group(function () {
        Route::get('/', [DirectorMessageController::class, 'index'])->name('index');
        Route::get('/create', [DirectorMessageController::class, 'create'])->name('create');
        Route::post('/store', [DirectorMessageController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [DirectorMessageController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [DirectorMessageController::class, 'update'])->name('update');
        Route::patch('/update/{id}', [DirectorMessageController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [DirectorMessageController::class, 'destroy'])->name('destroy');
    });

});

// Parcel Tracking (logistics routes) - inside admin but with logistics name
Route::prefix('admin/logistics')->name('logistics.')->middleware('auth')->group(function () {
    Route::get('/customers', [ParcelTrackingController::class, 'fetchCustomers'])->name('customers.index');
    Route::get('/receivers', [ParcelTrackingController::class, 'fetchReceivers'])->name('receivers.index');
    Route::get('/parcels', [ParcelTrackingController::class, 'fetchParcels'])->name('parcels.index');
    Route::get('/tracking-updates', [ParcelTrackingController::class, 'fetchTrackingUpdates'])->name('tracking-updates.index');
    Route::get('/parcel-histories', [ParcelTrackingController::class, 'fetchParcelHistories'])->name('parcel-histories.index');
});

// Frontend routes
Route::get('/services', [SingleController::class, 'render_service'])->name('Service');
Route::get('/service/{slug}', [SingleController::class, 'render_singleService'])->name('SingleService');
Route::get('/countries', [SingleController::class, 'render_Countries'])->name('Countries');
Route::get('/singlecountry/{slug}', [SingleController::class, 'render_singleCountry'])->name('singleCountry');
Route::get('/contactpage', [SingleController::class, 'render_contact'])->name('Contact');
Route::post('/contactpage', [ContactController::class, 'store'])->name('Contact.store');
Route::get('/aboutus', [SingleController::class, 'render_about'])->name('About');
Route::get('/team', [SingleController::class, 'render_team'])->name('Team');
Route::get('/gallery', [SingleController::class, 'render_gallery'])->name('Gallery');
Route::get('/video', [SingleController::class, 'render_videos'])->name('Video');
Route::get('/testimonial', [SingleController::class, 'render_testimonial'])->name('Testimonial');
Route::get('/blogpostcategory', [SingleController::class, 'render_blogpostcategory'])->name('Blogpostcategory');
Route::get('/singleblogpostcategory/{slug}', [SingleController::class, 'render_singleBlogpostcategory'])->name('SingleBlogpostcategory');
Route::get('/singlepost/{slug}', [SingleController::class, 'render_singlePost'])->name('SinglePost');
Route::get('/gallerys/{slug}', [SingleController::class, 'render_singleImage'])->name('singleImage');
