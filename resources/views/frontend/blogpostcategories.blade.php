@extends('frontend.layouts.master')

@section('content')

<!-- Page Header -->
<div class="bg-light py-5 text-center">
    <h1 class="fw-bold">{{ __('Blogs') }}</h1>
</div>

<section class="py-5 bg-white">
    <div class="container">

        <div class="row g-4 justify-content-center">

            @foreach ($blogpostcategories as $blogpostcategory)
                <div class="col-lg-4 col-md-6">

                    <div class="card blog-card h-100 shadow border-0 rounded-4 overflow-hidden">

                        <!-- Image -->
                        <div class="blog-image-wrapper position-relative">
                            @if ($blogpostcategory->image)
                                <img src="{{ asset('uploads/blogpostcategory/' . $blogpostcategory->image) }}"
                                     class="w-100 blog-image" alt="Blog Image">
                            @else
                                <img src="https://plus.unsplash.com/premium_photo-1705091309202-5838aeedd653?w=500"
                                     class="w-100 blog-image" alt="Blog Image">
                            @endif
                            <div class="image-overlay"></div>
                        </div>

                        <!-- Content -->
                        <div class="card-body d-flex flex-column p-4">

                            <h5 class="fw-bold mb-3">
                                {{ $blogpostcategory->title }}
                            </h5>

                            <p class="text-muted mb-4">
                                {{ Str::limit(strip_tags($blogpostcategory->content), 140) }}
                            </p>

                            <a href="{{ route('SingleBlogpostcategory', ['slug' => $blogpostcategory->slug]) }}"
                               class="btn btn-primary mt-auto px-4 py-2 align-self-start">
                                Read More <i class="fa-solid fa-arrow-right ms-1"></i>
                            </a>

                        </div>
                    </div>

                </div>
            @endforeach

        </div>

    </div>
</section>

<style>
/* Blog Card Styling */
.blog-card {
    transition: all 0.3s ease;
}

.blog-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,.12) !important;
}

/* Image styling */
.blog-image-wrapper {
    height: 230px;
    overflow: hidden;
}

.blog-image {
    height: 100%;
    object-fit: cover;
    transition: 0.4s ease;
}

.blog-card:hover .blog-image {
    transform: scale(1.1);
}

/* Gradient overlay */
.image-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,.5), transparent);
}

/* Title style */
.card-body h5 {
    color: #0d1b3e;
}

/* Button style on hover */
.btn-primary:hover {
    background: #083d94;
}
</style>

@endsection
