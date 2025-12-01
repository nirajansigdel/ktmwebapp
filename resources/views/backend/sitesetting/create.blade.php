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
            <a href="{{ route('admin.site-settings.index') }}"><button class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i>
                    Back</button></a>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
        </div>
    </div>


    <form id="quickForm" method="POST" action="{{ route('admin.site-settings.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div>
                <div class="form-group">
                    <label for="office_name">Office Name</label><span style="color:red; font-size:large"> *</span>
                    <input type="text" name="office_name" class="form-control" placeholder="Office Name"
                        id="office_name" value="{{ old('office_name') }}" required>
                </div>

                <div class="form-group">
                    <label for="office_address">Office Address</label><span style="color:red; font-size:large"> *</span>
                    <input type="text" name="office_address" class="form-control" placeholder="Address"
                        id="office_address" value="{{ old('office_address') }}" required>
                </div>

                <div class="form-group">
                    <label for="office_contact">Office Contact</label><span style="color:red; font-size:large"> *</span>
                    <input type="text" name="office_contact" class="form-control" placeholder="Office Contact"
                        id="office_contact" value="{{ old('office_contact') }}" required>
                </div>

                <div class="form-group">
                    <label for="office_email">Office Email</label><span style="color:red; font-size:large"> *</span>
                    <input type="email" name="office_email" class="form-control" placeholder="Office Email"
                        id="office_email" value="{{ old('office_email') }}" required>
                </div>
                
                <div class="form-group">
                    <label for="whatsapp_number">Whatsapp Number</label><span style="color:red; font-size:large"> *</span>
                    <input type="text" name="whatsapp_number" class="form-control" placeholder="Whatsapp Number"
                        id="whatsapp_number" value="{{ old('whatsapp_number') }}" required>
                </div>
                
                <div class="form-group">
                    <label for="main_logo">Main Logo</label><span style="color:red; font-size:large"> *</span>
                    <input type="file" name="main_logo" class="form-control" placeholder="Main Logo" id="main_logo"
                        onchange="previewImage(this, 'main_logo_preview')" required>
                    <img id="main_logo_preview" src="#" alt="Main Logo Preview"
                        style="display: none; max-width: 200px; margin-top: 10px; border-radius: 8px; border: 2px solid #ddd;">
                </div>

                <div class="form-group">
                    <label for="side_logo">Side Logo</label>
                    <input type="file" name="side_logo" class="form-control" placeholder="Side Logo" id="side_logo"
                        onchange="previewImage(this, 'side_logo_preview')">
                    <img id="side_logo_preview" src="#" alt="Side Logo Preview"
                        style="display: none; max-width: 200px; margin-top: 10px; border-radius: 8px; border: 2px solid #ddd;">
                </div>
                
                <div class="form-group">
                    <label for="company_registered_date">Company Registered Date</label><span style="color:red; font-size:large"> *</span>
                    <input type="date" name="company_registered_date" class="form-control" id="company_registered_date"
                        placeholder="Enter Registered Date" value="{{ old('company_registered_date') }}" required>
                </div>


                <div class="form-group">
                    <label for="facebook_link">Facebook URL</label>
                    <input type="url" name="facebook_link" class="form-control" placeholder="Facebook URL (https://)"
                        id="facebook_link">
                </div>
                <div class="form-group">
                    <label for="instagram_link">Insta URL</label>
                    <input type="url" name="instagram_link" class="form-control" placeholder="Insta URL (https://)"
                        id="instagram_link">
                </div>
                <div class="form-group">
                    <label for="linkedin_link">Linkedin URL</label>
                    <input type="url" name="linkedin_link" class="form-control"
                        placeholder="LinkedIn URL (https://)" id="linkedin_link">
                </div>
                <div class="form-group">
                    <label for="google_maps_link">Google Maps</label>
                    <input type="url" name="google_maps_link" class="form-control"
                        placeholder="Google Maps URL (https://)" id="google_maps_link">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

    <!-- JavaScript for Image Preview -->
    <script>
        function previewImage(input, imgId) {
            var imgElement = document.getElementById(imgId);
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    imgElement.src = e.target.result;
                    imgElement.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                imgElement.src = '#';
                imgElement.style.display = 'none';
            }
        }
    </script>
@endsection
