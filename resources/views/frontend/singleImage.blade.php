
@extends('frontend.layouts.master')

@section('content')


<div class="background">
    <h1 class="page_title">
        {{ __($image->title) }}
    </h1>
  </div>

<section class="single_page">
    <div class="container">

        <div class="row mt-3">

            <p class="text-center">{{ $image->img_desc }}</p>

            @foreach ($image->img as $imgUrl) 
                <div class="col-md-4 mb-3">
                    <a class="venobox" data-gall="gallery01" href="{{ asset($imgUrl) }}" data-vbtype="image"> 
                        <img src="{{ asset($imgUrl) }}" class="gallery_image">
                    </a>
                </div>
            
            @endforeach
    

        </div>



    </div>
@endsection