@extends('frontend.layouts.master')

@section('content')
    <div class="background">
        <h1 class="page_title">{{ __('About Us') }}</h1>
    </div>

    {{-- <section class="about_page">
        <div class="container">
            <div class="row gap-5 mt-5">
                <div class="col-md-5 col-lg-5 col-sm-12">
                    <div class="image">
                        @if ($about->image)
                            <img class="about_page_img img-fluid shadow-lg p-3 mb-5 bg-body-tertiary rounded"
                                src="{{ asset('uploads/about/' . $about->image) }}" alt="About Us">
                        @else
                            <p>No about information available</p>
                        @endif
                    </div>

                </div>

                <div class="col-md-7 col-lg-6 col-sm-12 shadow-lg p-3 mb-5 bg-body-tertiary rounded">
            
                    <div style="text-align: justify;">
                        {!! $about->content !!}
                    </div>
                </div>
            </div>
    </section> --}}




    <section class="sample_image">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 order-1 order-md-1">
                    @if ($about->image)
                        <img class="sample_page_image" src="{{ asset('uploads/about/' . $about->image) }}" alt="About Image">
                    @else
                        <p>No about information available</p>
                    @endif
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 order-2 order-md-3 sample_page_content">
                    {!! $about->content !!}
                </div>


                <div class="col-lg-4 col-md-4 col-sm-12 order-3 order-md-2 sample_page_list mt-2 mb-2 p-4">
                    <h3 class="">Services</h3>
                    <ul>
                        @foreach ($listservices as $service)
                            <li>
                                <a href="{{ route('SingleService', ['slug' => $service->slug]) }}">
                                    {{ $service->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>


    <section class="testimonial_page">
        <div class="container">

            <h1 class="section_title text-center"><span>Message From the Managing Director</span></h1>

            <div class="row test_row">

                <div class="col-lg-4">
                    @if ($message->image)
                        <img src="{{ asset('uploads/director_messages/' . $message->image) }}" class="test_image"
                            alt="">
                    @else
                        <img src="{{ asset('image/girl.jpg') }}" class="test_image" alt="">
                    @endif

                </div>
                <div class="col-lg-8">
                    <p>{!! $message->message !!}</p>
                    <h3>{{ $message->name }}</h3>
                    <h5>{{ $message->position }}</h5>
                    <h6>({{ $message->companyName }})</h6>

                </div>

            </div>

        </div>
    </section>


    @include('frontend.includes.teams')
@endsection
