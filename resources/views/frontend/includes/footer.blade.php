{{-- Footer --}}

<style>
    .footer-section {
        background:#0b2f63;
        color: #c7bfbf;
        position: relative;
        overflow: hidden;
    }

    .footer-section::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at 20% 50%, rgba(255, 94, 20, 0.05) 0%, transparent 50%);
        pointer-events: none;
    }

    .reveal { 
        opacity: 0; 
        transform: translateY(100px); 
        transition: opacity 1300ms ease-out, transform 1300ms ease-out; 
        will-change: opacity, transform; 
    }

    .reveal.revealed { 
        opacity: 1; 
        transform: translateY(0); 
    }

    .reveal-stagger > * { 
        transform-origin: 0 0; 
    }

    .footer-section .container {
        position: relative;
        z-index: 1;
    }

    .footer-section h3 {
        color: #fff;
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 25px;
        position: relative;
        letter-spacing: 0.5px;
    }

    .footer-section h3::before {
        content: "";
        position: absolute;
        left: 0;
        bottom: -12px;
        height: 3px;
        width: 50px;
        background: linear-gradient(90deg, #ff5e14, #ff7d3f);
        border-radius: 2px;
    }

    .footer-logo img {
        transition: transform 0.3s ease;
        margin-bottom: 20px;
    }

    .footer-logo:hover img {
        transform: scale(1.05);
    }

    .footer-links {
        list-style: none;
        padding-left: 0;
    }

    .footer-links li {
        margin-bottom: 12px;
    }

    .footer-links a {
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-block;
        position: relative;
    }

    .footer-links a::before {
        content: "›";
        margin-right: 8px;
        color: #ff5e14;
        opacity: 0;
        transform: translateX(-5px);
        transition: all 0.3s ease;
    }

    .footer-links a:hover {
        color: #ff5e14;
        padding-left: 8px;
    }

    .footer-links a:hover::before {
        opacity: 1;
        transform: translateX(0);
    }

    .contact-title {
        font-size: 12px;
        color: #888;
        margin-bottom: 6px;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
    }

    .contact-value {
        font-size: 18px;
        font-weight: 700;
        color: #fff;
        line-height: 1.4;
        margin-bottom: 20px;
    }

    .contact-value a {
        color: #fff;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .contact-value a:hover {
        color: #ff5e14;
    }

    .footer-social-icon {
        padding-top: 15px;
    }

    .footer-social-icon span {
        color: #fff;
        font-weight: 700;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 1px;
       
    }

    .footer-social-icon a {
        font-size: 22px;
        margin-right: 18px;
        color: #c7bfbf;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
         text-decoration: none;
    }

    .footer-social-icon a:hover {
        color: #ff5e14;
        transform: translateY(-3px);
    }

    .copyright-area {
       background:#0b2f79;
        padding: 25px 0;
        border-top: 1px solid rgba(255, 94, 20, 0.1);
    }

    .copyright-area p {
        margin: 0;
        color:white;
        font-size: 14px;
        line-height: 1.6;
    }

    .copyright-area a {
        color: #ff5e14;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .copyright-area a:hover {
        color: #ff7d3f;
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .footer-section h3 {
            font-size: 18px;
            margin-bottom: 20px;
        }
        .contact-value {
            font-size: 18px;
        }
        .footer-social-icon a {
            font-size: 18px;
            width: 36px;
            height: 36px;
        }
    }
</style>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        var sections = document.querySelectorAll('section');
        if (!sections.length) return;

        sections.forEach(function (sec) {
            sec.classList.add('reveal');
        });

        if ('IntersectionObserver' in window) {
            var observer = new IntersectionObserver(function (entries, obs) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                        obs.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });

            sections.forEach(sec => observer.observe(sec));
        } else {
            sections.forEach(sec => sec.classList.add('revealed'));
        }
    });
</script>


<footer class="footer-section pt-5 pb-4">
    <div class="container">
        <div class="row">

            <!-- Logo + Social -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="footer-logo">
                     
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('uploads/sitesetting/' . ($sitesetting->main_logo ?? 'placeholder.png')) }}"
                             class="img-fluid" style="max-width:130px;" alt="logo">
                    </a>
                    -
                </div>

                <div class="footer-social-icon ">
                    <span class="d-block mb-3">Follow us</span>
                    <a href="{{ $sitesetting->facebook_link ?? '#' }}"><i class="fa-brands fa-facebook"></i></a>
                    <a href="{{ $sitesetting->x_link ?? $sitesetting->twitter_link ?? '#' }}"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="{{ $sitesetting->instagram_link ?? '#' }}"><i class="fa-brands fa-instagram"></i></a>
                    <a href="{{ $sitesetting->youtube_link ?? '#' }}"><i class="fa-brands fa-youtube"></i></a>
                </div>
            </div>

            <!-- Services -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h3>Services</h3>
                <ul class="footer-links">
                    
        
                @if(!empty($services) && $services->count())
                        @foreach($services as $service)
                            <li>
                                <a href="{{ route('SingleService', ['slug' => $service->slug]) }}">
                                    {{ $service->title }}
                                </a>
                            </li>
                        @endforeach
                    @else
                        <li><a href="#">Air Freight</a></li>
                        <li><a href="#">Truck Freight</a></li>
                        <li><a href="#">Warehousing</a></li>
                        <li><a href="#">Rail Freight</a></li>
                        <li><a href="#">Ship Freight</a></li>
                    @endif
    
                </ul>
            </div>

            <!-- Company -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h3>Quick Links</h3>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('About') }}">About Us</a></li>
                    <li><a href="{{ route('Team') }}">Our Team</a></li>
                    <li><a href="{{ route('Blogpostcategory') }}">Blogs</a></li>
                    <li><a href="{{ route('Contact') }}">Contact</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h3>Get in Touch</h3>

                <div class="mb-4">
                    <div class="contact-title">Email</div>
                    <div class="contact-value">
                        <a href="mailto:{{ $sitesetting->office_email ?? 'contact@example.com' }}">
                            {{ $sitesetting->office_email ?? 'contact@example.com' }}
                        </a>
                    </div>
                    
                </div>

                <div class="mb-4">
                    <div class="contact-title">Phone</div>
                    <div class="contact-value">
                        <a href="tel:{{ $sitesetting->office_contact ?? '+1 000 000 0000' }}">
                            {{ $sitesetting->office_contact ?? '+1 000 000 0000' }}
                        </a>
                    </div>
                   
                </div>

                <div class="mb-4">
                    <div class="contact-title">Office Location</div>
                    <div class="contact-value" style="font-size:18px;">
                        {{ $sitesetting->office_address ?? '100 S Main St, New York, NY' }}
                    </div>
                   
                </div>

            </div>

        </div>
    </div>
</footer>

<div class="copyright-area">
    <div class="container text-center">
        {{-- 
        <p>
            Copyright © 2024,
            All Rights Reserved {{ $sitesetting->office_name }}
            <br>
            Developed by <a href="https://aashatech.com">Softtech</a>
        </p>
        --}}
    </div>
</div>
