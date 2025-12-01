@extends('frontend.layouts.master')

@section('content')
    <div class="background">
        <h1 class="page_title">{{ 'Gallery' }}</h1>
    </div>


    <section class="gallery_section">
        <div class="container">


            <div class="row">

                @foreach ($images as $image)
                    <div class="col-md-6 mt-3 mb-3">
                        <a style="color: var(--first)" href="{{ route('singleImage', ['slug' => $image->slug]) }}">
                            <div class="accordion">
                                <h4 class="text-center">{{ $image->title }}</h4>
                                <ul>

                                    @foreach ($image->img as $imgUrl)
                                        <li tabindex="{{ $loop->iteration }}"
                                            style=" background-image: url('{{ asset($imgUrl) }}');">

                                        </li>
                                    @endforeach

                                </ul>

                            </div>
                        </a>
                    </div>
                @endforeach
            </div>



        </div>
    </section>
@endsection
