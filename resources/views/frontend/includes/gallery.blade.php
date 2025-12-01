<section class="gallery-section py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">Gallery</h2>
            <p class="section-subtitle">Explore our collection of stunning visuals</p>
            <div class="title-underline"></div>
        </div>

        <div class="gallery-grid masonry">
            @php $tileIndex = 0; @endphp
            @forelse ($images as $image)
                @if (!empty($image->img))
                    @foreach ($image->img as $imgUrl)
                        <div class="masonry-item" data-group-id="{{ $image->id }}" data-index="{{ $loop->index }}">
                            <a href="{{ route('singleImage', ['slug' => $image->slug]) }}" class="masonry-link">
                                        <div class="art-card">
                                            <div class="art-image-wrap">
                                                <img src="{{ asset($imgUrl) }}" alt="{{ $image->title ?? 'Image' }}" class="art-image" loading="lazy">

                                                <div class="art-overlay">
                                                    <div class="overlay-content">
                                                        <h4 class="overlay-title">{{ $image->title ?? 'Untitled' }}</h4>
                                                        <span class="overlay-cta"><i class="fas fa-search"></i></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="art-footer">
                                                <div class="author">
                                                    <span class="author-dot"></span>
                                                    <span class="author-name">{{ $image->title ?? 'Unknown' }}</span>
                                                </div>
                                                <div class="more-dots">
                                                    <i class="fas fa-ellipsis-h"></i>
                                                </div>
                                            </div>
                                        </div>
                            </a>
                        </div>
                        @php $tileIndex++; @endphp
                    @endforeach
                @endif
            @empty
                <div class="col-12">
                    <p class="text-center text-muted" style="font-size: 1.1rem;">No gallery items available.</p>
                </div>
            @endforelse
        </div>

        {{-- Modals removed: tiles now link directly to the gallery detail page. --}}
    </div>
</section>

<style>
    /* Gallery Section */
    .gallery-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        position: relative;
        overflow: hidden;
    }

    .gallery-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(13, 110, 253, 0.05), transparent);
        border-radius: 50%;
    }

    .gallery-section::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -15%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(13, 110, 253, 0.03), transparent);
        border-radius: 50%;
    }

    /* Gallery Grid */
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 1.25rem;
        position: relative;
        z-index: 1;
    }

    .gallery-item {
        animation: fadeInUp 0.6s ease-out backwards;
    }

    .gallery-item:nth-child(1) { animation-delay: 0.1s; }
    .gallery-item:nth-child(2) { animation-delay: 0.2s; }
    .gallery-item:nth-child(3) { animation-delay: 0.3s; }
    .gallery-item:nth-child(4) { animation-delay: 0.4s; }
    .gallery-item:nth-child(5) { animation-delay: 0.5s; }
    .gallery-item:nth-child(6) { animation-delay: 0.6s; }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Gallery Card */
    .gallery-link {
        text-decoration: none;
        display: block;
        height: 100%;
    }

    /* Dark vertical art-card style */
    .art-card {
        background: linear-gradient(180deg, #05060a 0%, #0b1220 100%);
        color: #e6eef8;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 18px 40px rgba(3,8,23,0.4);
        transition: transform 0.35s ease, box-shadow 0.35s ease;
        display: flex;
        flex-direction: column;
        height: auto;
        min-height: 320px;
    }

    .art-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 30px 70px rgba(3,8,23,0.75);
    }

    .art-image-wrap {
        flex: 1 1 auto;
        overflow: hidden;
        position: relative;
        height: 260px;
        background: linear-gradient(180deg, rgba(0,0,0,0.03), rgba(0,0,0,0.06));
    }

    .art-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.6s ease;
        transform-origin: center;
    }

    .art-card:hover .art-image {
        transform: scale(1.06) translateY(-2px);
    }

    /* Varied tile heights for a dynamic masonry feel */
    .gallery-grid .masonry-item:nth-child(6n+1) .art-image-wrap { height: 420px; }
    .gallery-grid .masonry-item:nth-child(6n+4) .art-image-wrap { height: 360px; }

    /* Hover overlay */
    .art-overlay {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: flex-end;
        justify-content: center;
        background: linear-gradient(180deg, rgba(0,0,0,0) 40%, rgba(3,8,23,0.55) 100%);
        opacity: 0;
        transition: opacity 260ms ease, transform 260ms ease;
        transform: translateY(6px);
    }

    .art-card:hover .art-overlay { opacity: 1; transform: translateY(0); }

    .overlay-content { width: 100%; padding: 16px; display:flex; align-items:center; justify-content:space-between; gap:12px; }
    .overlay-title { color: #fff; font-weight:700; margin:0; font-size:1.05rem; text-shadow: 0 6px 18px rgba(1,10,30,0.45); }
    .overlay-cta { background: rgba(255,255,255,0.95); color:#07183f; width:42px; height:42px; display:inline-flex; align-items:center; justify-content:center; border-radius:50%; font-size:14px; }

    .art-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem 1rem;
        gap: 0.75rem;
        border-top: 1px solid rgba(255,255,255,0.03);
        background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(0,0,0,0.06));
    }

    .author {
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }

    .author-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #2ee6a8;
        box-shadow: 0 0 10px rgba(46,230,168,0.12);
        display: inline-block;
    }

    .author-name {
        font-size: 0.95rem;
        color: #dfe9fb;
        font-weight: 600;
    }

    .more-dots {
        color: rgba(255,255,255,0.45);
        font-size: 0.9rem;
    }

    /* Gallery Modal */
    .gallery-modal {
        animation: fadeIn 0.3s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    .gallery-modal .modal-dialog {
        animation: scaleInModal 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    @keyframes scaleInModal {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .gallery-modal-content {
        background: #000;
        border: none;
        border-radius: 20px;
        overflow: hidden;
    }

    .gallery-modal-header {
        background: linear-gradient(135deg, #001a4d, #003d99);
        border: none;
        padding: 1.5rem;
    }

    .gallery-modal-header .modal-title {
        color: white;
        font-size: 1.5rem;
        font-weight: 700;
    }

    .gallery-modal-body {
        padding: 2rem 1.5rem;
    }

    /* Gallery Carousel */
    .gallery-carousel {
        border-radius: 12px;
        overflow: hidden;
    }

    .gallery-modal-image {
        width: 100%;
        height: auto;
        max-height: 600px;
        object-fit: contain;
        animation: zoomIn 0.5s ease-out;
    }

    @keyframes zoomIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .carousel-control-prev,
    .carousel-control-next {
        width: 50px;
        height: 50px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
        transition: all 0.3s ease;
    }

    .carousel-control-prev:hover,
    .carousel-control-next:hover {
        background: rgba(255, 255, 255, 0.4);
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        filter: brightness(0) invert(1);
    }

    /* Thumbnails */
    .gallery-thumbnails {
        display: flex;
        gap: 0.8rem;
        flex-wrap: wrap;
        justify-content: center;
    }

    .thumbnail-item {
        width: 70px;
        height: 70px;
        border-radius: 8px;
        overflow: hidden;
        cursor: pointer;
        border: 3px solid transparent;
        transition: all 0.3s ease;
        opacity: 0.6;
    }

    .thumbnail-item:hover,
    .thumbnail-item.active {
        border-color: #0d6efd;
        opacity: 1;
        transform: scale(1.05);
    }

    .thumbnail-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Modal Backdrop */
    .gallery-modal .modal-backdrop {
        background: rgba(0, 0, 0, 0.7);
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .gallery-grid {
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1rem;
        }

        .gallery-image-wrapper {
            height: 220px;
        }
    }

    @media (max-width: 768px) {
        .gallery-section .section-title {
            font-size: 2rem;
        }

        .gallery-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1.2rem;
        }

        .gallery-image-wrapper {
            height: 200px;
        }

        .gallery-modal-body {
            padding: 1.5rem 1rem;
        }

        .gallery-modal-image {
            max-height: 400px;
        }

        .gallery-thumbnails {
            gap: 0.6rem;
        }

        .thumbnail-item {
            width: 60px;
            height: 60px;
        }
    }

    @media (max-width: 576px) {
        .gallery-section .section-title {
            font-size: 1.5rem;
        }

        .gallery-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .gallery-image-wrapper {
            height: 250px;
        }

        .gallery-card {
            margin-bottom: 1rem;
        }

        .gallery-modal .modal-xl {
            width: 95vw;
        }

        .gallery-modal-header {
            padding: 1rem;
        }

        .gallery-modal-header .modal-title {
            font-size: 1.2rem;
        }

        .gallery-modal-body {
            padding: 1rem;
        }

        .gallery-modal-image {
            max-height: 300px;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 40px;
            height: 40px;
        }

        .thumbnail-item {
            width: 50px;
            height: 50px;
        }
    }
</style>