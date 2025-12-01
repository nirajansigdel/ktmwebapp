@extends('frontend.layouts.master')

@section('content')

<section class="py-5 bg-white">
    <div class="container">

        <!-- Section Title -->
        <div class="text-center mb-5">
            <h2 class="fw-bold">What Our Clients Say</h2>
            <p class="text-muted">Real experiences from satisfied customers</p>
            <div class="title-underline mx-auto"></div>
        </div>

        @if($testimonials->count() > 0)

        <div class="row g-4">

            @foreach ($testimonials as $testimonial)
            <div class="col-lg-4 col-md-6">

                <div class="card h-100 shadow-lg border-0 rounded-4 position-relative">

                    <!-- Quote icon -->
                    <div class="quote-icon">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.996 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.984zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                        </svg>
                    </div>

                    <div class="card-body d-flex flex-column p-4">

                        <!-- Testimonial Text -->
                        <p class="fst-italic border-start border-primary ps-3 mb-4">
                            "{{ $testimonial->description }}"
                        </p>

                        <!-- Stars -->
                        <div class="text-warning mb-4 fs-5">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>

                        <!-- Author -->
                        <div class="d-flex align-items-center mt-auto pt-3 border-top">

                            <div class="author-image-wrapper me-3">
                                @if ($testimonial->image)
                                <img src="{{ asset('uploads/testimonial/' . $testimonial->image) }}"
                                     class="author-image"
                                     alt="{{ $testimonial->name }}">
                                @else
                                <img src="{{ asset('image/girl.jpg') }}"
                                     class="author-image"
                                     alt="{{ $testimonial->name }}">
                                @endif
                                <span class="image-border"></span>
                            </div>

                            <div>
                                <h6 class="mb-1 fw-bold">{{ $testimonial->name }}</h6>

                                @if(isset($testimonial->position))
                                    <small class="text-muted">{{ $testimonial->position }}</small>
                                @endif
                            </div>

                        </div>

                    </div>

                </div>

            </div>
            @endforeach

        </div>

        @else
        <!-- Empty State -->
        <div class="text-center py-5">
            <svg width="80" height="80" fill="none" stroke="currentColor" class="text-secondary mb-3" viewBox="0 0 24 24">
                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2Z" stroke-width="1.5"/>
            </svg>
            <h4>No Testimonials Yet</h4>
            <p class="text-muted">Check back soon for customer reviews!</p>
        </div>
        @endif

    </div>
</section>

<!-- Small CSS (Only what Bootstrap can’t do) -->
<style>

.title-underline {
    width: 60px;
    height: 4px;
    background: #0d6efd;
    border-radius: 4px;
}

.quote-icon {
    position: absolute;
    top: 12px;
    right: 15px;
    width: 35px;
    color: rgba(13, 110, 253, 0.15);
}

.author-image-wrapper {
    position: relative;
    width: 60px;
    height: 60px;
}

.author-image {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 50%;
    border: 3px solid #0d6efd;
}

.image-border {
    position: absolute;
    inset: -3px;
    border-radius: 50%;
    background: linear-gradient(135deg, #0d6efd, #0653c7);
    z-index: -1;
    opacity: .2;
}

.card:hover {
    transform: translateY(-6px);
    transition: .3s;
}

</style>

@endsection
