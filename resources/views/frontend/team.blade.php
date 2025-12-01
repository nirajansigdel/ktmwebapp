@extends('frontend.layouts.master')

@section('content')
    <div class="background">
        <h1 class="page_title">Our Team</h1>
    </div>

    <section class="single_page">
        <div class="container">

            <div class="row mt-3">


                @foreach ($teams as $team)
                    <div class="col-md-3">
                        <div class="card team_card mt-2 mb-2">

                            @if ($team->image)
                                <img src="{{ asset('uploads/team/' . $team->image) }}" class="card-img-top image"
                                    alt="">
                            @else
                                <!-- Default image or placeholder -->
                                <img src="{{ asset('images/girl.jpg') }}" class="card-img-top image"
                                    alt="Default Image">
                            @endif

                            
                            <div class="card-body">

                                <span class="team_name">{{ $team->name }}</span><br>
                                <span class="team_position">{{ $team->position }}</span><br>
                                <span class="team_email">{{ $team->email }}</span><br>
                                <span class="team_contact">{{ $team->phone_no }}</span>

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>




        </div>

    </section>
@endsection
