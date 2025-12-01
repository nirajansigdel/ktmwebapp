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
            <a href="{{ route('admin.photo-galleries.create') }}">
                <button class="btn btn-primary btn-sm">
                    <i class="fa fa-plus"></i> Add Photo
                </button>
            </a>
            <a href="{{ url('admin') }}">
                <button class="btn btn-primary btn-sm">
                    <i class="fa fa-arrow-left"></i> Back
                </button>
            </a>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
        </div>
    </div>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Image Description</th>
                <th>Images</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gallery as $image)
                <tr>
                    <td>{{ $image->id }}</td>
                    <td>{{ $image->title }}</td>
                    <td>{{ $image->img_desc ?? '' }}</td>
                    <td>
                        @if (is_array($image->img))
                            <div class="album-container">
                                @foreach ($image->img as $index => $imagePath)
                                    <img class="album-image" id="preview{{ $loop->parent->iteration }}{{ $index }}"
                                        src="{{ asset($imagePath) }}"
                                        style="width: 100px; height:100px; margin-right: 5px;" />
                                @endforeach
                            </div>
                        @else
                            <img id="preview{{ $loop->iteration }}" src="{{ asset($image->img) }}"
                                style="width: 150px; height:150px" />
                        @endif
                    </td>
                    <td>
                        <div style="display: flex; flex-direction:row;">
                            <a href="{{ route('admin.photo-galleries.edit', $image->id) }}" class="btn btn-warning btn-sm"
                                style="margin-right: 5px;"><i class="fas fa-edit"></i>
                                Edit</a>
                            <form action="{{ route('admin.photo-galleries.destroy', $image->id) }}" method="POST"
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
@endsection
