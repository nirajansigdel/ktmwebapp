<section class="testimonials-section py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">Join Clients 1000+ Like You</h2>
            <p class="section-subtitle">Discover what our satisfied clients have to say</p>
            <div class="title-underline"></div>
        </div>

        @if ($testimonials->isNotEmpty())
            <div class="testimonials-carousel">
                <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($testimonials as $testimonial)
                            <div class="carousel-item{{ $loop->first ? ' active' : '' }}" data-bs-interval="8000">
                                <div class="testimonial-card">
                                    <div class="testimonial-row">
                                        <!-- Left: Image -->
                                        <div class="testimonial-image-col">
                                            <div class="testimonial-image-wrapper">
                                                @if ($testimonial->image)
                                                    <img src="{{ asset('uploads/testimonial/' . $testimonial->image) }}"
                                                        class="testimonial-image" alt="{{ $testimonial->name }}">
                                                @else
                                                    <img src="{{ asset('image/girl.jpg') }}" class="testimonial-image" alt="Testimonial">
                                                @endif
                                                <div class="image-overlay"></div>
                                            </div>
                                        </div>

                                        <!-- Right: Content -->
                                        <div class="testimonial-content-col">
                                            <div class="testimonial-content">
                                                <div class="stars">
                                                    @for ($i = 0; $i < 5; $i++)
                                                        <i class="fas fa-star"></i>
                                                    @endfor
                                                </div>
                                                <p class="testimonial-text">
                                                    "{{ $testimonial->description }}"
                                                </p>
                                                <h3 class="testimonial-name">{{ $testimonial->name }}</h3>
                                                <p class="testimonial-role">Satisfied Client</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Carousel Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>

                    <!-- Carousel Indicators -->
                    <div class="carousel-indicators-custom">
                        @foreach ($testimonials as $testimonial)
                            <button type="button" 
                                    data-bs-target="#testimonialCarousel" 
                                    data-bs-slide-to="{{ $loop->index }}"
                                    class="{{ $loop->first ? 'active' : '' }}"
                                    aria-label="Slide {{ $loop->iteration }}">
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('Testimonial') }}" class="testimonial-link">
                    <button class="btn btn-view-all">
                        View All Testimonials
                        <i class="fas fa-arrow-right ms-2"></i>
                    </button>
                </a>
            </div>
        @else
            <div class="alert alert-info text-center" role="alert">
                No testimonials available at the moment.
            </div>
        @endif
    </div>
</section>

<style>
    /* Testimonials Section */
    .testimonials-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        position: relative;
        overflow: hidden;
    }

    .testimonials-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(13, 110, 253, 0.05), transparent);
        border-radius: 50%;
    }

    .testimonials-section::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -15%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(13, 110, 253, 0.03), transparent);
        border-radius: 50%;
    }


    .testimonials-section .title-underline {
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, #0d6efd, #0653c7);
        margin: 0 auto;
        border-radius: 2px;
    }

    /* Carousel Container */
    .testimonials-carousel {
        position: relative;
        z-index: 1;
    }

    .carousel {
        position: relative;
    }

    .carousel-inner {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    }

    /* Testimonial Card */
    .testimonial-card {
        background: white;
        padding: 2rem;
        min-height: 500px;
        display: flex;
        align-items: center;
        animation: fadeIn 0.6s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    .testimonial-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem;
        align-items: center;
        width: 100%;
    }

    /* Image Column */
    .testimonial-image-col {
        animation: slideInLeft 0.8s ease-out;
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-40px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .testimonial-image-wrapper {
        position: relative;
        height: 400px;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 12px 40px rgba(13, 110, 253, 0.2);
        transition: all 0.4s ease;
    }

    .testimonial-image-wrapper:hover {
        transform: scale(1.02);
        box-shadow: 0 16px 50px rgba(13, 110, 253, 0.3);
    }

    .testimonial-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .testimonial-image-wrapper:hover .testimonial-image {
        transform: scale(1.05);
    }

    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(13, 110, 253, 0.1), rgba(6, 83, 199, 0.2));
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .testimonial-image-wrapper:hover .image-overlay {
        opacity: 1;
    }

    /* Content Column */
    .testimonial-content-col {
        animation: slideInRight 0.8s ease-out;
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(40px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .testimonial-content {
        padding: 1.5rem;
    }

    .stars {
        font-size: 1.3rem;
        color: #ffc107;
        margin-bottom: 1.5rem;
        letter-spacing: 0.3rem;
    }

    .stars i {
        transition: transform 0.2s ease;
    }

    .stars i:hover {
        transform: scale(1.2);
    }

    .testimonial-text {
        font-size: 1.1rem;
        color: #555;
        font-style: italic;
        line-height: 1.8;
        margin-bottom: 1.5rem;
        border-left: 4px solid #0d6efd;
        padding-left: 1.5rem;
    }

    .testimonial-name {
        font-size: 1.4rem;
        font-weight: 700;
        color: #001a4d;
        margin-bottom: 0.3rem;
    }

    .testimonial-role {
        font-size: 0.95rem;
        color: #0d6efd;
        font-weight: 500;
        margin-bottom: 0;
    }

    /* Carousel Controls */
    .carousel-control-prev,
    .carousel-control-next {
        width: 50px;
        height: 50px;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(13, 110, 253, 0.8);
        border-radius: 50%;
        opacity: 0;
        transition: all 0.3s ease;
    }

    .testimonials-carousel:hover .carousel-control-prev,
    .testimonials-carousel:hover .carousel-control-next {
        opacity: 1;
    }

    .carousel-control-prev:hover,
    .carousel-control-next:hover {
        background: rgba(13, 110, 253, 1);
        transform: translateY(-50%) scale(1.1);
    }

    .carousel-control-prev {
        left: -60px;
    }

    .carousel-control-next {
        right: -60px;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        filter: brightness(0) invert(1);
    }

    /* Custom Carousel Indicators */
    .carousel-indicators-custom {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-top: 2rem;
        position: relative;
        z-index: 1;
    }

    .carousel-indicators-custom button {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(13, 110, 253, 0.3);
        border: 2px solid #0d6efd;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .carousel-indicators-custom button.active {
        background: #0d6efd;
        width: 40px;
        border-radius: 6px;
    }

    .carousel-indicators-custom button:hover {
        background: rgba(13, 110, 253, 0.6);
    }

    /* Button */
    .testimonial-link {
        text-decoration: none;
    }

    .btn-view-all {
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

    .btn-view-all:hover {
        background: linear-gradient(135deg, #0653c7, #043fa6);
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(13, 110, 253, 0.4);
        color: white;
    }

    .btn-view-all i {
        transition: transform 0.3s ease;
    }

    .btn-view-all:hover i {
        transform: translateX(6px);
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .testimonial-row {
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .testimonial-card {
            min-height: auto;
            padding: 1.5rem;
        }

        .testimonial-image-wrapper {
            height: 300px;
        }

        .carousel-control-prev {
            left: 10px;
        }

        .carousel-control-next {
            right: 10px;
        }

        .carousel-control-prev,
        .carousel-control-next {
            opacity: 1;
        }
    }

    @media (max-width: 768px) {
        .testimonials-section .section-title {
            font-size: 2rem;
        }

        .testimonials-section .section-subtitle {
            font-size: 1rem;
        }

        .testimonial-text {
            font-size: 1rem;
        }

        .testimonial-name {
            font-size: 1.2rem;
        }

        .testimonial-image-wrapper {
            height: 250px;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 40px;
            height: 40px;
        }

        .carousel-indicators-custom {
            gap: 0.5rem;
        }

        .carousel-indicators-custom button {
            width: 10px;
            height: 10px;
        }

        .carousel-indicators-custom button.active {
            width: 30px;
        }
    }

    @media (max-width: 576px) {
        .testimonials-section .section-title {
            font-size: 1.5rem;
        }

        .testimonial-card {
            padding: 1rem;
            min-height: auto;
        }

        .testimonial-image-wrapper {
            height: 200px;
            margin-bottom: 1rem;
        }

        .testimonial-content {
            padding: 1rem 0;
        }

        .testimonial-text {
            font-size: 0.95rem;
            padding-left: 1rem;
        }

        .testimonial-name {
            font-size: 1.1rem;
        }

        .btn-view-all {
            padding: 0.75rem 1.5rem;
            font-size: 0.9rem;
        }
    }
</style>