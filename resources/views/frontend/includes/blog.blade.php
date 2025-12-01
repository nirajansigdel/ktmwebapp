<section class="blog-section py-5 bg-light">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">Latest Blogs & Updates</h2>
            <p class="section-subtitle">Stay informed with our latest articles and insights</p>
        </div>

        @include('frontend.includes.partials._blog-contact-panel-styles')

        @forelse ($blogs->take(2) as $blog)
            @php $isEven = $loop->iteration % 2 === 0; @endphp
            <div class="row g-0 align-items-center blog-item my-5">
                <div class="col-lg-6 {{ $isEven ? 'order-lg-2' : 'order-lg-1' }}">
                    <a href="{{ route('SingleBlogpostcategory', ['slug' => $blog->slug]) }}">
                        <img src="{{ asset('uploads/blogpostcategory/' . $blog->image) }}"
                             alt="{{ $blog->title ?? 'Blog Post' }}"
                             class="blog-image {{ $isEven ? 'slide-in-right' : 'slide-in-left' }}">
                    </a>
                </div>

                <div class="col-lg-6 {{ $isEven ? 'order-lg-1' : 'order-lg-2' }}">
                    <div class="contact-panel {{ $isEven ? 'slide-in-left' : 'slide-in-right' }}">
                        <h3 class="my-1">{{ $blog->title ?? 'Blog Post' }}</h3>
                        <p class="my-5">{{ Str::limit(strip_tags($blog->content), 700) }}</p>

                        @if(!empty($blog->meta) || !empty($blog->excerpt))
                            <div class="contact-list">
                                {{-- optional small meta/summary area; falls back gracefully --}}
                                {{ Str::limit(strip_tags($blog->excerpt ?? $blog->meta ?? ''), 140) }}
                            </div>
                        @endif

                        <a href="{{ route('SingleBlogpostcategory', ['slug' => $blog->slug]) }}" class="contact-cta">
                            LEARN MORE
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="row">
                <div class="col-12">
                    <p class="text-center text-muted">No blog posts available at the moment.</p>
                </div>
            </div>
        @endforelse
    </div>
</section>