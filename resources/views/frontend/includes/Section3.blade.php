<section class="slider-section py-5">
    <div class="container">
        <div class="slider-content row align-items-center g-5">
            <!-- Left Content -->
            <div class="col-lg-6 left-content">
                <div class="slider-text">
                    @if ($sliderPost)
                        <h2 class="slider-title">{{ $sliderPost->title }}</h2>
                        <p class="slider-description">{{ Str::limit(strip_tags($sliderPost->description), 600) }}</p>
                    @else
                        <p class="no-data">No slider post available</p>
                    @endif
                </div>

                <a href="{{ route('Countries') }}" class="slider-btn-link">
                    <button class="btn slider-btn">
                        SEE ALL COUNTRIES
                        <i class="fas fa-arrow-right ms-2"></i>
                    </button>
                </a>
            </div>

            <!-- Right Content - Countries Grid -->
            <div class="col-lg-6 right-content">
                <div class="countries-grid">
                    @forelse ($countries->take(6) as $country)
                        @if ($country->image)
                            <a href="{{ route('singleCountry', ['slug' => $country->slug]) }}" 
                               class="country-card" 
                               style="--index: {{ $loop->index }};">
                                <div class="country-image-wrapper">
                                    <img src="{{ asset('uploads/country/' . $country->image) }}" 
                                         alt="{{ $country->name }}" 
                                         class="country-image">
                                    <div class="country-overlay"></div>
                                    <div class="country-info">
                                        <h4>{{ $country->name }}</h4>
                                    </div>
                                </div>
                            </a>
                        @endif
                    @empty
                        <p class="no-countries text-center w-100">No countries available</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Slider Section */
    .slider-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        position: relative;
        overflow: hidden;
    }

    .slider-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(13, 110, 253, 0.05), transparent);
        border-radius: 50%;
    }

    .slider-section::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -15%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(13, 110, 253, 0.03), transparent);
        border-radius: 50%;
    }

    .slider-content {
        position: relative;
        z-index: 1;
    }

    /* Left Content Animation */
    .left-content {
        animation: slideInLeft 0.8s ease-out 0.2s both;
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-60px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .slider-text {
        margin-bottom: 2rem;
    }

    .slider-title {
        font-size: 3rem;
        font-weight: 800;
        color: #001a4d;
        margin-bottom: 1.5rem;
        line-height: 1.2;
    }

    .slider-description {
        font-size: 1.05rem;
        color: #555;
        line-height: 1.8;
        margin-bottom: 1.5rem;
    }

    .no-data {
        color: #999;
        font-style: italic;
    }

    .slider-btn-link {
        text-decoration: none;
    }

    .slider-btn {
        background: linear-gradient(135deg, #0d6efd, #0653c7);
        border: none;
        color: white;
        padding: 0.9rem 2.5rem;
        font-size: 1rem;
        font-weight: 600;
        border-radius: 50px;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        box-shadow: 0 6px 20px rgba(13, 110, 253, 0.3);
        display: inline-flex;
        align-items: center;
    }

    .slider-btn:hover {
        background: linear-gradient(135deg, #0653c7, #043fa6);
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(13, 110, 253, 0.4);
        color: white;
    }

    .slider-btn i {
        transition: transform 0.3s ease;
    }

    .slider-btn:hover i {
        transform: translateX(6px);
    }

    /* Right Content - Countries Grid Animation */
    .right-content {
        animation: slideInRight 0.8s ease-out 0.2s both;
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(60px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .countries-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 1.5rem;
        perspective: 1000px;
    }

    .country-card {
        text-decoration: none;
        animation: floatIn 0.6s ease-out backwards;
    }

    .country-card {
        animation-delay: calc(0.1s * var(--index));
    }

    @keyframes floatIn {
        from {
            opacity: 0;
            transform: translateY(30px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .country-image-wrapper {
        position: relative;
        height: 200px;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .country-card:hover .country-image-wrapper {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 16px 40px rgba(13, 110, 253, 0.25);
    }

    .country-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .country-card:hover .country-image {
        transform: scale(1.1);
    }

    .country-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(13, 110, 253, 0.4), rgba(6, 83, 199, 0.6));
        opacity: 0;
        transition: opacity 0.4s ease;
        z-index: 2;
    }

    .country-card:hover .country-overlay {
        opacity: 1;
    }

    .country-info {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 1rem;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
        transform: translateY(20px);
        opacity: 0;
        transition: all 0.4s ease;
        z-index: 3;
    }

    .country-card:hover .country-info {
        opacity: 1;
        transform: translateY(0);
    }

    .country-info h4 {
        color: white;
        margin: 0;
        font-size: 1rem;
        font-weight: 600;
    }

    .no-countries {
        color: #999;
        padding: 2rem;
        text-align: center;
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .slider-title {
            font-size: 2.5rem;
        }

        .countries-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 768px) {
        .slider-section {
            padding: 2rem 0 !important;
        }

        .left-content {
            animation: slideInDown 0.8s ease-out 0.2s both;
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-60px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .right-content {
            animation: slideInUp 0.8s ease-out 0.2s both;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(60px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .slider-title {
            font-size: 2rem;
        }

        .slider-description {
            font-size: 1rem;
        }

        .countries-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }

        .country-image-wrapper {
            height: 150px;
        }
    }

    @media (max-width: 576px) {
        .slider-title {
            font-size: 1.5rem;
        }

        .slider-description {
            font-size: 0.95rem;
        }

        .slider-btn {
            padding: 0.75rem 1.5rem;
            font-size: 0.9rem;
        }

        .countries-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .country-image-wrapper {
            height: 120px;
        }
    }
</style>