@extends('frontend.layouts.master')

@section('content')
    <div class="background">
        <h1 class="page_title">{{ $country->name }}</h1>
    </div>



    <section class="sample_page">
        <div class="container">
            <div class="row">




                <div class="col-lg-8 col-md-8 col-sm-12 order-1 order-md-1">
                    @if ($country->image)
                        <img class="sample_page_image" src="{{ asset('uploads/country/' . $country->image) }}"
                            alt="Country Image">
                    @else
                        <!-- Display an icon if no images are available -->
                        <i class="fa-solid fa-image" style="font-size: 100px;"></i>
                    @endif

                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 order-2 order-md-3 sample_page_content">
                    {!! $country->content !!}
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 order-3 order-md-2 sample_page_list mt-2 mb-2 p-4">
                    <h3 class="">Recommended Countries</h3>
                    <ul>
                        @foreach ($recommendedCountries as $recommendedCountry)
                            <li>
                                <a href="{{ route('singleCountry', ['slug' => $recommendedCountry->slug]) }}">
                                   {{ $recommendedCountry->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
