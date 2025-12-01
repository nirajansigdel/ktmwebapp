<style>
/* Transparent default header */
#mainHeader {
    transition: background .3s ease;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

/* Scroll effect */
#mainHeader.scrolled {
    background: rgba(0, 0, 0, 0.92) !important;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
}

/* Nav link hover animation */
.nav-link {
    position: relative;
    color: #fff !important;
    font-weight: 500 !important;
    font-size: 16px;
    padding: 8px 12px !important;
    transition: color 0.3s ease;
}

.nav-link::after {
    content: "";
    position: absolute;
    left: 50%;
    bottom: 0; /* FIXED: ensures the underline is always visible */
    width: 0;
    height: 2px;
    background: #ff5e14;
    transition: width 0.3s ease, left 0.3s ease;
    transform: translateX(-50%);
}

.nav-link:hover::after {
    width: 80%; /* underline width */
}

.nav-link:hover {
    color: #ff5e14 !important;
}


/* Dropdown */
.dropdown-menu {
    background-color: rgba(0, 0, 0, 0.95);
    border: 1px solid rgba(255, 94, 20, 0.2);
    border-radius: 6px;
    animation: slideDown 0.2s ease;
}

.dropdown-item {
    color: #fff !important;
    transition: all 0.2s ease;
    padding: 10px 16px;
}

.dropdown-item:hover {
    background: rgba(255, 94, 20, 0.2);
    color: #ff5e14 !important;
    padding-left: 20px;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Navbar brand */
.navbar-brand img {
    transition: transform 0.3s ease;
}

.navbar-brand:hover img {
    transform: scale(1.05);
}

.navbar-toggler {
    border-color: rgba(255, 94, 20, 0.5);
}

.navbar-toggler:focus {
    box-shadow: 0 0 0 0.25rem rgba(255, 94, 20, 0.25);
}
</style>

<header class="secondSection  sticky" id="mainHeader">
    <nav class="navbar navbar-expand-lg navbar-dark py-3">
        <div class="container">

            <!-- Logo -->
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('uploads/sitesetting/' . ($sitesetting->main_logo ?? 'placeholder.png')) }}"
                     alt="Logo" style="height:70px;">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center" id="mainNavbar">
                <ul class="navbar-nav text-center">

                    <!-- Introduction -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Introduction</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('About') }}">About Us</a></li>
                            <li><a class="dropdown-item" href="{{ route('Team') }}">Our Teams</a></li>
                            <li><a class="dropdown-item" href="{{ route('Service') }}">Services</a></li>
                        </ul>
                    </li>

                    <!-- Locations -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Locations</a>
                        <ul class="dropdown-menu">
                            @foreach ($countries as $country)
                                <li><a class="dropdown-item" href="{{ route('singleCountry', $country->slug) }}">{{ $country->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>

                    <!-- Guide -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Export/Import Guide</a>
                        <ul class="dropdown-menu">
                            @forelse ($guides as $guide)
                                <li><a class="dropdown-item" href="{{ route('SinglePost', $guide->slug) }}">{{ $guide->title }}</a></li>
                            @empty
                                <li><a class="dropdown-item" href="#">No guides available</a></li>
                            @endforelse
                        </ul>
                    </li>

                    <!-- Gallery -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Gallery</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('Gallery') }}">Photo Gallery</a></li>
                            <li><a class="dropdown-item" href="{{ route('Video') }}">Video Gallery</a></li>
                        </ul>
                    </li>

                    <!-- Simple links -->
                    <li class="nav-item"><a class="nav-link" href="{{ route('Testimonial') }}">Reviews</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('Blogpostcategory') }}">Blogs</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('Contact') }}">Contact</a></li>

                </ul>
            </div>

        </div>
    </nav>
</header>

<script>
document.addEventListener("DOMContentLoaded", () => {
    let current = window.location.href.split('#')[0];

    document.querySelectorAll('.nav-link, .dropdown-item').forEach(link => {
        if (link.href && link.href.split('#')[0] === current) {
            link.classList.add('active');
            let parent = link.closest('.dropdown-menu');
            if (parent) parent.previousElementSibling.classList.add('active');
        }
    });

    // Scroll header color
    window.addEventListener("scroll", () => {
        const header = document.getElementById("mainHeader");
        window.scrollY > 40 ? header.classList.add("scrolled") : header.classList.remove("scrolled");
    });
});
</script>
