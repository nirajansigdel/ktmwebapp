<div class="enroll"
    style="background-image: url('{{ asset('image/convo.jpg') }}'); background-size: contain; background-position: right; background-repeat: no-repeat;">

    <div class="col-md-5 mx-5">
        <div class="empty">.</div>
        <div class="text mx-5 text-white">
            <p>
                @if ($enrollPost)
                    <h2>{{ $enrollPost->title }}</h2>
                    <p>{{ Str::limit(strip_tags($enrollPost->description), 600) }}</p>
                    <!-- Add any other content or styling you need -->
                @endif
            </p>

        </div>

        <div class="butt d-flex">
            <div class="text-center my-5 mx-3">
                <a href="{{ route('Contact') }}" class="btn bg-primary text-white">Contact Now</a>
            </div>

            <div class="text-center my-5 mx-1">
                @if ($sliderPost)
                    <a href="{{ route('SinglePost', ['slug' => $sliderPost->slug]) }}"
                        class="btn bg-primary text-white">Read More</a>
                @endif

            </div>

        </div>
    </div>
</div>