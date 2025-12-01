@php($appName = config('app.name', 'Curiou Company'))
@php($initials = collect(explode(' ', $appName))->map(fn($s) => strtoupper(substr($s, 0, 1)))->take(2)->implode(''))
@php($accountOpen = request()->routeIs('admin.account.*'))
@php($settingsOpen = request()->routeIs('admin.settings.*'))
@php($coverImagesOpen = request()->routeIs('admin.cover-images.*'))
@php($siteSettingsOpen = request()->routeIs('admin.site-settings.*') || request()->routeIs('admin.favicons.*'))
@php($contactDetailsOpen = request()->routeIs('admin.visitors-book.*') || request()->routeIs('admin.contacts.*'))
@php($informationsOpen = request()->routeIs('admin.countries.*'))
@php($introductionOpen = request()->routeIs('admin.about-us.*') || request()->routeIs('admin.teams.*'))
@php($postsOpen = request()->routeIs('admin.categories.*') || request()->routeIs('admin.posts.*'))
@php($parcelTrackingOpen = request()->routeIs('logistics.*'))
@php($galleryOpen = request()->routeIs('admin.video-galleries.*'))
@php($frontpagepostOpen = request()->routeIs('admin.cover-images.*') || request()->routeIs('admin.photo-galleries.*') || request()->routeIs('admin.services.*') || request()->routeIs('admin.site-settings.*') || request()->routeIs('admin.favicons.*') || request()->routeIs('admin.visitors-book.*') || request()->routeIs('admin.contacts.*') || request()->routeIs('admin.countries.*') || request()->routeIs('admin.about-us.*') || request()->routeIs('admin.teams.*') || request()->routeIs('admin.categories.*') || request()->routeIs('admin.posts.*') || request()->routeIs('logistics.*') || request()->routeIs('admin.video-galleries.*') || request()->routeIs('admin.testimonials.*') || request()->routeIs('admin.blog-posts-categories.*') || request()->routeIs('admin.faqs.*') || request()->routeIs('admin.director_messages.*'))

<div class="sidebar-brand px-3 py-3 d-flex align-items-center">
  <span class="brand-badge rounded-3 d-flex align-items-center justify-content-center me-2"> {{ $initials }} </span>
  <div class="ms-1">
    <div class="fw-semibold">{{ $appName }}</div>
    <div class="small text-muted-300">Management System</div>
  </div>
</div>

<nav class="sidebar-nav d-grid gap-1 px-3">
  <div class="sidebar-section-label text-muted-300 small text-uppercase">Main</div>
  <a class="sidebar-link {{ request()->routeIs('admin.dashboard*') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
    <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor"><rect x="3" y="3" width="7" height="7" rx="1.5" stroke-width="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5" stroke-width="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5" stroke-width="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5" stroke-width="1.5"/></svg>
    Dashboard
  </a>
  <a class="sidebar-link {{ request()->routeIs('admin.items.entry') ? 'active' : '' }}" href="{{ route('admin.items.entry') }}">
    <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M12 4v16M4 12h16" stroke-width="1.5" stroke-linecap="round"/></svg>
    Item Entry
  </a>
  <a class="sidebar-link {{ request()->routeIs('admin.items.details') ? 'active' : '' }}" href="{{ route('admin.items.details') }}">
    <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12Z" stroke-width="1.5"/><circle cx="12" cy="12" r="3" stroke-width="1.5"/></svg>
    Item Details
  </a>
  <button class="btn-reset sidebar-link p-2 d-flex align-items-center justify-content-between {{ $accountOpen ? 'active' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarAccount" aria-expanded="{{ $accountOpen ? 'true' : 'false' }}">
      <span class="d-inline-flex align-items-center">
        <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <path d="M3 7.5A1.5 1.5 0 0 1 4.5 6h15A1.5 1.5 0 0 1 21 7.5V18a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7.5Z" stroke-width="1.5"/>
          <path d="M3 9h18" stroke-width="1.5"/>
        </svg>
        Account
      </span>
      <span class="chevron">▾</span>
    </button>

  <div class="sidebar-group">

    <div id="sidebarAccount" class="collapse {{ $accountOpen ? 'show' : '' }}">
      <a class="sidebar-sublink {{ request()->routeIs('admin.account.income') ? 'active' : '' }}" href="{{ route('admin.account.income') }}">
        <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M7 13l4-4 6 6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        Income
      </a>
      <a class="sidebar-sublink {{ request()->routeIs('admin.account.expense') ? 'active' : '' }}" href="{{ route('admin.account.expense') }}">
        <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor"><rect x="3" y="5" width="18" height="14" rx="2" stroke-width="1.5"/><path d="M3 10h18" stroke-width="1.5"/></svg>
        Expense
      </a>
      <a class="sidebar-sublink {{ request()->routeIs('admin.account.inventory') ? 'active' : '' }}" href="{{ route('admin.account.inventory') }}">
        <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M3 9l9-6 9 6-9 6-9-6Z" stroke-width="1.5"/><path d="M3 15l9 6 9-6" stroke-width="1.5"/></svg>
        Inventory
      </a>
      <a class="sidebar-sublink {{ request()->routeIs('admin.account.report') ? 'active' : '' }}" href="{{ route('admin.account.report') }}">
        <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M7 4h7l4 4v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2Z" stroke-width="1.5"/><path d="M14 4v4h4" stroke-width="1.5"/></svg>
        Account Report
      </a>
    </div>
  </div>

  <div class="sidebar-section-label text-muted-300 small text-uppercase mt-3">Management</div>
  <a class="sidebar-link {{ request()->routeIs('admin.vendor.*') ? 'active' : '' }}" href="{{ route('admin.vendor.index') }}">
    <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="8" r="3" stroke-width="1.5"/><path d="M4 20a8 8 0 0 1 16 0" stroke-width="1.5"/></svg>
    Vendor
  </a>
  <a class="sidebar-link {{ request()->routeIs('admin.backup.*') ? 'active' : '' }}" href="{{ route('admin.backup.index') }}">
    <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M7 18a4 4 0 0 1 0-8 5 5 0 1 1 9.7 1.7A3.5 3.5 0 1 1 17 18" stroke-width="1.5"/><path d="M12 12v6M9 15l3 3 3-3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
    Backup & Restore
  </a>
  <a class="sidebar-link {{ request()->routeIs('admin.notifications.*') ? 'active' : '' }}" href="{{ route('admin.notifications.index') }}">
    <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M6 8a6 6 0 1 1 12 0v5l1.5 2.5H4.5L6 13V8Z" stroke-width="1.5"/><path d="M9 19a3 3 0 0 0 6 0" stroke-width="1.5"/></svg>
    Notification
  </a>
  <a class="sidebar-link {{ request()->routeIs('admin.audit.*') ? 'active' : '' }}" href="{{ route('admin.audit.index') }}">
    <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M7 4h10a2 2 0 0 1 2 2v14l-7-3-7 3V6a2 2 0 0 1 2-2Z" stroke-width="1.5"/></svg>
    Audit Log
  </a>
  <a class="sidebar-link {{ request()->routeIs('admin.payments.*') ? 'active' : '' }}" href="{{ route('admin.payments.index') }}">
    <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M12 2a10 10 0 1 0 0 20" stroke-width="1.5"/><path d="M21 12h-9V3" stroke-width="1.5"/></svg>
    Amount Paid Section
  </a>

  <div class="sidebar-group mt-3">
    <button class="btn-reset sidebar-link d-flex align-items-center justify-content-between {{ $settingsOpen ? 'active' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarSettings" aria-expanded="{{ $settingsOpen ? 'true' : 'false' }}">
      <span class="d-inline-flex align-items-center p-2">
        <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M4 6h16M4 12h16M4 18h16" stroke-width="1.5" stroke-linecap="round"/></svg>
        Setting
      </span>
      <span class="chevron">▾</span>
    </button>
    <div id="sidebarSettings" class="collapse {{ $settingsOpen ? 'show' : '' }}">
      <a class="sidebar-sublink {{ request()->routeIs('admin.settings.profile') ? 'active' : '' }}" href="{{ route('admin.settings.profile') }}">
        <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <circle cx="12" cy="8" r="3" stroke-width="1.5"/>
          <path d="M4 20a8 8 0 0 1 16 0" stroke-width="1.5"/>
        </svg>
        Profile
      </a>
      <a class="sidebar-sublink {{ request()->routeIs('admin.settings.users') ? 'active' : '' }}" href="{{ route('admin.settings.users') }}">
        <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <circle cx="8" cy="8" r="3" stroke-width="1.5"/>
          <circle cx="16" cy="10" r="3" stroke-width="1.5"/>
          <path d="M2 20a6 6 0 0 1 12 0" stroke-width="1.5"/>
          <path d="M12 20a6 6 0 0 1 10 0" stroke-width="1.5"/>
        </svg>
        User Management
      </a>
    </div>
  </div>

  <div class="sidebar-section-label text-muted-300 small text-uppercase mt-3">Frontpagepost</div>
  <button class="btn-reset sidebar-link p-2 d-flex align-items-center justify-content-between {{ $frontpagepostOpen ? 'active' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarFrontpagepost" aria-expanded="{{ $frontpagepostOpen ? 'true' : 'false' }}">
    <span class="d-inline-flex align-items-center">
      <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor">
        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8Z" stroke-width="1.5"/>
        <path d="M14 2v6h6M16 13H8M16 17H8M10 9H8" stroke-width="1.5"/>
      </svg>
      Frontpagepost
    </span>
    <span class="chevron">▾</span>
  </button>
  <div class="sidebar-group">
    <div id="sidebarFrontpagepost" class="collapse {{ $frontpagepostOpen ? 'show' : '' }}">
      <a class="sidebar-sublink {{ request()->routeIs('admin.cover-images.*') ? 'active' : '' }}" href="{{ route('admin.cover-images.index') }}">
        <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <rect x="3" y="3" width="18" height="18" rx="2" stroke-width="1.5"/>
          <path d="M3 9h18M9 3v18" stroke-width="1.5"/>
        </svg>
        Cover Image
      </a>

      <a class="sidebar-sublink {{ request()->routeIs('admin.photo-galleries.*') ? 'active' : '' }}" href="{{ route('admin.photo-galleries.index') }}">
        <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <rect x="3" y="3" width="18" height="18" rx="2" stroke-width="1.5"/>
          <circle cx="8" cy="8" r="2" stroke-width="1.5"/>
          <path d="M21 15l-5-5L5 21" stroke-width="1.5"/>
        </svg>
        Photo Gallery
      </a>

      <a class="sidebar-sublink {{ request()->routeIs('admin.services.*') ? 'active' : '' }}" href="{{ route('admin.services.index') }}">
        <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <path d="M12 2L2 7l10 5 10-5-10-5Z" stroke-width="1.5"/>
          <path d="M2 17l10 5 10-5M2 12l10 5 10-5" stroke-width="1.5"/>
        </svg>
        Services
      </a>

      <a class="sidebar-sublink {{ request()->routeIs('admin.site-settings.*') ? 'active' : '' }}" href="{{ route('admin.site-settings.index') }}">
        <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <path d="M12 2a10 10 0 1 0 0 20" stroke-width="1.5"/>
          <path d="M12 6v6l4 2" stroke-width="1.5"/>
        </svg>
        Site Setting
      </a>
      <a class="sidebar-sublink {{ request()->routeIs('admin.favicons.*') ? 'active' : '' }}" href="{{ route('admin.favicons.index') }}">
        <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <circle cx="12" cy="12" r="10" stroke-width="1.5"/>
          <path d="M12 6v6l4 2" stroke-width="1.5"/>
        </svg>
        Favicon
      </a>

      <a class="sidebar-sublink {{ request()->routeIs('admin.visitors-book.*') ? 'active' : '' }}" href="{{ route('admin.visitors-book.index') }}">
        <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" stroke-width="1.5"/>
          <circle cx="9" cy="7" r="4" stroke-width="1.5"/>
          <path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" stroke-width="1.5"/>
        </svg>
        Visitors Book
      </a>
      <a class="sidebar-sublink {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}" href="{{ route('admin.contacts.index') }}">
        <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0Z" stroke-width="1.5"/>
          <circle cx="12" cy="10" r="3" stroke-width="1.5"/>
        </svg>
        Contacts
      </a>

      <a class="sidebar-sublink {{ request()->routeIs('admin.countries.*') ? 'active' : '' }}" href="{{ route('admin.countries.index') }}">
        <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <path d="M12 2L2 7l10 5 10-5-10-5Z" stroke-width="1.5"/>
          <path d="M2 17l10 5 10-5M2 12l10 5 10-5" stroke-width="1.5"/>
        </svg>
        Country
      </a>

      <a class="sidebar-sublink {{ request()->routeIs('admin.about-us.*') ? 'active' : '' }}" href="{{ route('admin.about-us.index') }}">
        <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <circle cx="12" cy="12" r="10" stroke-width="1.5"/>
          <path d="M12 16v-4M12 8h.01" stroke-width="1.5"/>
        </svg>
        About Us
      </a>
      <a class="sidebar-sublink {{ request()->routeIs('admin.teams.*') ? 'active' : '' }}" href="{{ route('admin.teams.index') }}">
        <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <circle cx="12" cy="8" r="3" stroke-width="1.5"/>
          <path d="M4 20a8 8 0 0 1 16 0" stroke-width="1.5"/>
        </svg>
        Teams
      </a>

      <a class="sidebar-sublink {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
        <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <rect x="3" y="3" width="7" height="7" rx="1" stroke-width="1.5"/>
          <rect x="14" y="3" width="7" height="7" rx="1" stroke-width="1.5"/>
          <rect x="3" y="14" width="7" height="7" rx="1" stroke-width="1.5"/>
          <rect x="14" y="14" width="7" height="7" rx="1" stroke-width="1.5"/>
        </svg>
        Categories
      </a>
      <a class="sidebar-sublink {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}" href="{{ route('admin.posts.index') }}">
        <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8Z" stroke-width="1.5"/>
          <path d="M14 2v6h6M16 13H8M16 17H8M10 9H8" stroke-width="1.5"/>
        </svg>
        Post
      </a>

      <a class="sidebar-sublink {{ request()->routeIs('logistics.customers.*') ? 'active' : '' }}" href="{{ route('logistics.customers.index') }}">
        <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <circle cx="12" cy="8" r="3" stroke-width="1.5"/>
          <path d="M4 20a8 8 0 0 1 16 0" stroke-width="1.5"/>
        </svg>
        Customers
      </a>
      <a class="sidebar-sublink {{ request()->routeIs('logistics.receivers.*') ? 'active' : '' }}" href="{{ route('logistics.receivers.index') }}">
        <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <circle cx="12" cy="8" r="3" stroke-width="1.5"/>
          <path d="M4 20a8 8 0 0 1 16 0" stroke-width="1.5"/>
        </svg>
        Receivers
      </a>
      <a class="sidebar-sublink {{ request()->routeIs('logistics.parcels.*') ? 'active' : '' }}" href="{{ route('logistics.parcels.index') }}">
        <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z" stroke-width="1.5"/>
        </svg>
        Parcels
      </a>
      <a class="sidebar-sublink {{ request()->routeIs('logistics.tracking-updates.*') ? 'active' : '' }}" href="{{ route('logistics.tracking-updates.index') }}">
        <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <path d="M3 12a9 9 0 1 0 18 0 9 9 0 0 0-18 0Z" stroke-width="1.5"/>
          <path d="M12 6v6l4 2" stroke-width="1.5"/>
        </svg>
        Tracking Updates
      </a>
      <a class="sidebar-sublink {{ request()->routeIs('logistics.parcel-histories.*') ? 'active' : '' }}" href="{{ route('logistics.parcel-histories.index') }}">
        <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <path d="M7 4h10a2 2 0 0 1 2 2v14l-7-3-7 3V6a2 2 0 0 1 2-2Z" stroke-width="1.5"/>
        </svg>
        Parcel Histories
      </a>

      <a class="sidebar-sublink {{ request()->routeIs('admin.video-galleries.*') ? 'active' : '' }}" href="{{ route('admin.video-galleries.index') }}">
        <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <rect x="2" y="6" width="20" height="12" rx="2" stroke-width="1.5"/>
          <path d="M10 10l5 3-5 3v-6Z" stroke-width="1.5"/>
        </svg>
        Video Gallery
      </a>

      <a class="sidebar-sublink {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}" href="{{ route('admin.testimonials.index') }}">
        <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2Z" stroke-width="1.5"/>
        </svg>
        Testimonials
      </a>

      <a class="sidebar-sublink {{ request()->routeIs('admin.blog-posts-categories.*') ? 'active' : '' }}" href="{{ route('admin.blog-posts-categories.index') }}">
        <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8Z" stroke-width="1.5"/>
          <path d="M14 2v6h6M16 13H8M16 17H8M10 9H8" stroke-width="1.5"/>
        </svg>
        Blog Posts Category
      </a>

      <a class="sidebar-sublink {{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}" href="{{ route('admin.faqs.index') }}">
        <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <circle cx="12" cy="12" r="10" stroke-width="1.5"/>
          <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3M12 17h.01" stroke-width="1.5"/>
        </svg>
        FAQs
      </a>

      <a class="sidebar-sublink {{ request()->routeIs('admin.director_messages.*') ? 'active' : '' }}" href="{{ route('admin.director_messages.index') }}">
        <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2Z" stroke-width="1.5"/>
          <path d="M13 8H8M16 12H8" stroke-width="1.5"/>
        </svg>
        Director Messages
      </a>
    </div>
  </div>

</nav>


  