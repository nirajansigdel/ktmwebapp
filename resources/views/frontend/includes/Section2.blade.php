
<section class="services-section py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">Our Services</h2>
            <p class="section-subtitle">Comprehensive solutions tailored to your needs</p>
        </div>

        <div class="row g-4">
            @forelse ($services as $service)
                <div class="col-lg-4 col-md-6">
                    <div class="service-card-dark">
                        <div class="service-icon-wrapper">
                            <i class="fas fa-cog"></i>
                        </div>
                        
                        <div class="service-content-dark">
                            <h3 class="service-title-dark">{{ $service->title }}</h3>
                            <p class="service-description-dark">
                                {{ Str::limit(strip_tags($service->description), 150) }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center text-white">No services available at the moment.</p>
                </div>
            @endforelse
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('Service') }}" class="btn btn-light btn-lg white">
                View All Services <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<style>

    .title-underline {
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, #0d6efd, #0653c7);
        margin: 0 auto;
        border-radius: 2px;
    }

    /* Blog Card Styles */
    .blog-section {
        background: #f8f9fa;
    }

    .blog-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .blog-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    }

    .blog-image-wrapper {
        overflow: hidden;
        height: 220px;
    }

    .blog-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .blog-card:hover .blog-image {
        transform: scale(1.05);
    }

    .blog-content {
        padding: 1.5rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .blog-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 0.8rem;
        line-height: 1.4;
    }

    .blog-excerpt {
        font-size: 0.95rem;
        color: #666;
        margin-bottom: 1rem;
        flex: 1;
        line-height: 1.6;
    }

    .read-more {
        display: inline-flex;
        align-items: center;
        color: #0d6efd;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .read-more:hover {
        color: #0653c7;
        gap: 8px;
    }

    .read-more i {
        margin-left: 0.5rem;
        transition: transform 0.3s ease;
    }

    .read-more:hover i {
        transform: translateX(4px);
    }

    /* Service Card Styles - Dark Theme */
    .services-section {
        position: relative;
        overflow: hidden;
    }

    .services-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: rgba(255, 255, 255, 0.03);
        border-radius: 50%;
        z-index: 0;
    }

    .services-section::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -10%;
        width: 400px;
        height: 400px;
        background: rgba(255, 255, 255, 0.02);
        border-radius: 50%;
        z-index: 0;
    }

    .services-section .container {
        position: relative;
        z-index: 1;
    }


    .service-card-dark {
        background: rgba(0, 26, 77, 0.9);
        border: 2px solid rgba(255, 255, 255, 0.1);
        border-radius: 24px;
        padding: 2.5rem 2rem;
        height: 100%;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(10px);
        display: flex;
        flex-direction: column;
        text-align: center;
    }

    .service-card-dark::before {
        content: '';
        position: absolute;
        top: -100%;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(180deg, rgba(13, 110, 253, 0.15), transparent);
        transition: all 0.5s ease;
    }

    .service-card-dark:hover {
        border-color: rgba(13, 110, 253, 0.4);
        background: rgba(0, 26, 77, 1);
        transform: translateY(-12px);
        box-shadow: 0 20px 50px rgba(13, 110, 253, 0.2);
    }

    .service-card-dark:hover::before {
        top: 0;
    }

    .service-icon-wrapper {
        font-size: 4rem;
        color: rgba(200, 210, 240, 0.8);
        margin-bottom: 2rem;
        transition: all 0.3s ease;
        position: relative;
        z-index: 2;
    }

    .service-card-dark:hover .service-icon-wrapper {
        color: rgba(200, 210, 240, 1);
        transform: scale(1.15);
    }

    .service-content-dark {
        position: relative;
        z-index: 2;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .service-title-dark {
        font-size: 1.6rem;
        font-weight: 700;
        color: white;
        margin-bottom: 1.2rem;
        line-height: 1.3;
    }

    .service-description-dark {
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.85);
        line-height: 1.7;
        flex: 1;
    }

    /* Updated Button Styles for Dark Background */
    .services-section .btn-light {
        background: white;
        border: none;
        color: white;
        padding: 0.85rem 2.5rem;
        font-weight: 600;
        border-radius: 50px;
        transition: all 0.3s ease;
    }

    .services-section .btn-light:hover {
        background: rgba(255, 255, 255, 0.95);
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3);
        color: white;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .services-section .section-header .section-title {
            font-size: 2rem;
        }

        .services-section .section-header .section-subtitle {
            font-size: 1rem;
        }

        .service-title-dark {
            font-size: 1.3rem;
        }

        .service-card-dark {
            padding: 2rem 1.5rem;
        }

        .service-icon-wrapper {
            font-size: 3rem;
        }
    }

    @media (max-width: 576px) {
        .services-section .section-header .section-title {
            font-size: 1.5rem;
        }

        .service-card-dark {
            padding: 1.5rem;
            margin-bottom: 1rem;
        }

        .service-description-dark {
            font-size: 0.95rem;
        }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .section-title {
            font-size: 2rem;
        }

        .section-subtitle {
            font-size: 1rem;
        }

        .service-title {
            font-size: 1.2rem;
        }

        .blog-title {
            font-size: 1.1rem;
        }

        .service-body {
            padding: 1.5rem;
        }
    }

    @media (max-width: 576px) {
        .section-title {
            font-size: 1.5rem;
        }

        .blog-card {
            margin-bottom: 1rem;
        }

        .service-card {
            margin-bottom: 1rem;
        }
    }
</style>
