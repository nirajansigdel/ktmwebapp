@extends('backend.layouts.master')

@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif

    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">{{ $page_title }}</h1>
            <a href="{{ url('admin') }}"><button class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i>
                    Back</button></a>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
        </div>
    </div>


    <section class="content">
        <div class="container-fluid">
            <form id="quickForm" method="POST" action="{{ route('admin.site-settings.update', $sitesetting->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $sitesetting->id }}">
                <div class="card-body">
                    <div>
                        <div class="form-group">
                            <label for="office_name">Office Name</label>
                            <input type="text" name="office_name" class="form-control" placeholder="Office Name"
                                id="office_name" value="{{ $sitesetting->office_name }}">
                        </div>

                        <div class="form-group">
                            <label for="office_address">Office Address</label>
                            <input type="text" name="office_address" class="form-control" placeholder="Address"
                                id="office_address" value="{{ $sitesetting->office_address }}">
                        </div>

                        <div class="form-group">
                            <label for="office_contact">Office Contact</label>
                            <input type="text" name="office_contact" class="form-control" placeholder="Office Contact"
                                id="office_contact" value="{{ $sitesetting->office_contact }}">
                        </div>

                        <div class="form-group">
                            <label for="office_email">Office Email</label>
                            <input type="email" name="office_email" class="form-control" placeholder="Email"
                                id="office_email" value="{{ $sitesetting->office_email }}">
                        </div>
                        <div class="form-group">
                            <label for="whatsapp_number">Whatsapp Number</label>
                            <input type="text" name="whatsapp_number" class="form-control" placeholder="Whatsapp Number"
                                id="whatsapp_number" value="{{ $sitesetting->whatsapp_number }}">
                        </div>

                        <div class="form-group">
                            <label for="company_registered_date">Company Registered Date</label>
                            <input type="date" name="company_registered_date" class="form-control"
                                placeholder="Enter Registered Date" id="company_registered_date"
                                value="{{ $sitesetting->company_registered_date }}">
                        </div>
                        <div class="form-group">
                            <label for="main_logo">Main Logo</label>
                            <input type="file" name="main_logo" class="form-control" placeholder="Main Logo"
                                id="main_logo" onchange="previewMainImage(event)">

                            <img id="main_preview" src="{{ asset('uploads/sitesetting/' . $sitesetting->main_logo) }}"
                                style="max-width: 300px; max-height:300px" />
                        </div>

                        <div class="form-group">
                            <label for="side_logo">Side Logo</label>
                            <input type="file" name="side_logo" class="form-control" placeholder="Side Logo"
                                id="side_logo" onchange="previewSideImage(event)">

                            <img id="side_preview" src="{{ asset('uploads/sitesetting/' . $sitesetting->side_logo) }}"
                                style="max-width: 300px; max-height:300px" />
                        </div>
                        <div class="form-group">
                            <label for="facebook_link">Facebook URL</label>
                            <input name="facebook_link" class="form-control" placeholder="Facebook URL (https://)"
                                id="facebook_link" value="{{ $sitesetting->facebook_link }}">
                        </div>
                        <div class="form-group">
                            <label for="instagram_link">Insta URL</label>
                            <input name="instagram_link" class="form-control" placeholder="Insta URL (https://)"
                                id="instagram_link" value="{{ $sitesetting->instagram_link }}">
                        </div>
                        <div class="form-group">
                            <label for="linkedin_link">Linkedin URL</label>
                            <input name="linkedin_link" class="form-control" placeholder="LinkedIn URL (https://)"
                                id="linkedin_link" value="{{ $sitesetting->linkedin_link }}">
                        </div>
                        <div class="form-group">
                            <label for="google_maps_link">Google Map</label>
                            <input name="google_maps_link" class="form-control" placeholder="Google Maps URL (https://)"
                                id="google_maps_link" value="{{ $sitesetting->google_maps_link }}">
                        </div>

                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Apply</button>
                </div>
            </form>
        </div>
    </section>




    </form>
    <script>
        const previewMainImage = e => {
            const reader = new FileReader();
            reader.readAsDataURL(e.target.files[0]);
            reader.onload = () => {
                const preview = document.getElementById('main_preview');
                preview.src = reader.result;
            };
        };

        const previewSideImage = e => {
            const reader = new FileReader();
            reader.readAsDataURL(e.target.files[0]);
            reader.onload = () => {
                const preview = document.getElementById('side_preview');
                preview.src = reader.result;
            };
        };
    </script>
@endsection
