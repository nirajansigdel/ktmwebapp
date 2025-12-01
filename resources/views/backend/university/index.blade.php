@extends('backend.layouts.master')


@section('content')
    <!-- Content Wrapper. Contains page content -->

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
            <a href="{{ route('admin.universities.create') }}"><button class="btn btn-primary btn-sm"><i
                        class="fa fa-plus"></i>Add
                    University</button></a>
            <a href="{{ url('admin') }}"><button class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i>
                    Back</button></a>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->


    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>S.N.</th>
                <th>Logo</th>
                <th>University Title</th>
                <th>Address</th>
                <th>Country</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Website</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($universities as $university)
                <tr data-widget="expandable-table" aria-expanded="false">
                    <td width="5%">{{ $loop->iteration }}</td>
                    <td> <img id="preview{{ $loop->iteration }}"
                            src="{{ asset('uploads/university/' . $university->logo) }}"
                            style="width: 150px; height:150px" /></td>
                    <td>{{ $university->title ?? '' }}</td>
                    <td>{{ $university->address ?? '' }}</td>
                    <td>{{ $university->country->name ?? 'No Country' }}</td>
                    <td>{{ $university->phone_no ?? '' }}</td>
                    <td>{{ $university->email ?? '' }}</td>
                    <td>{{ $university->website ?? '' }}</td>
                    <td>
                        <div style="display: flex; flex-direction:row;">
                            <a href="{{ route('admin.universities.edit', $university->id) }}"
                                class="btn btn-warning btn-sm" style="margin-right: 5px;"><i class="fas fa-edit"></i>
                                Edit</a>
                            <form action="{{ route('admin.universities.destroy', $university->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this item?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>




    <!-- Main row -->




    <script>
        const previewImage = e => {
            const reader = new FileReader();
            reader.readAsDataURL(e.target.files[0]);
            reader.onload = () => {
                const preview = document.getElementById('preview');
                preview.src = reader.result;
            };
        };
    </script>
@endsection
