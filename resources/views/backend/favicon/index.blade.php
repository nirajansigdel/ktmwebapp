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
            <a href="{{ route('admin.favicons.create') }}"><button class="btn btn-primary btn-sm"><i
                        class="fa fa-plus"></i>Add Favicon</button></a>
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




    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Android Chrome 192x192</th>
                <th>Android Chrome 512x512</th>
                <th>Apple Touch Icon</th>
                <th>Favicon ICO</th>
                <th>Favicon 16x16</th>
                <th>Favicon 32x32</th>
                <th>Site Webmanifest</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($icons as $icon)
                <tr>
                    <td>
                        @if($icon->android_chrome_oneninetwo && $icon->android_chrome_oneninetwo != 'NoFile')
                            <img src="{{ asset('uploads/favicon/' . $icon->android_chrome_oneninetwo) }}"
                                style="width: 150px; height:150px; object-fit: contain;">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>
                        @if($icon->android_chrome_fiveonetwo && $icon->android_chrome_fiveonetwo != 'NoFile')
                            <img src="{{ asset('uploads/favicon/' . $icon->android_chrome_fiveonetwo) }}"
                                style="width: 150px; height:150px; object-fit: contain;">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>
                        @if($icon->apple_touch_icon && $icon->apple_touch_icon != 'NoFile')
                            <img src="{{ asset('uploads/favicon/' . $icon->apple_touch_icon) }}"
                                style="width: 150px; height:150px; object-fit: contain;">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>
                        @if($icon->favicon_ico && $icon->favicon_ico != 'NoFile')
                            <img src="{{ asset('uploads/favicon/' . $icon->favicon_ico) }}" 
                                style="width: 150px; height:150px; object-fit: contain;">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>
                        @if($icon->favicon_sixteen && $icon->favicon_sixteen != 'NoFile')
                            <img src="{{ asset('uploads/favicon/' . $icon->favicon_sixteen) }}"
                                style="width: 150px; height:150px; object-fit: contain;">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>
                        @if($icon->favicon_thirtyTwo && $icon->favicon_thirtyTwo != 'NoFile')
                            <img src="{{ asset('uploads/favicon/' . $icon->favicon_thirtyTwo) }}"
                                style="width: 150px; height:150px; object-fit: contain;">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>
                        @if($icon->site_webmanifest && $icon->site_webmanifest != 'NoFile')
                            <a href="{{ asset('uploads/favicon/file/' . $icon->site_webmanifest) }}" target="_blank">
                                <i class="fas fa-file"></i> View Manifest
                            </a>
                        @else
                            <span class="text-muted">No File</span>
                        @endif
                    </td>
                    <td>
                        <div style="display: flex; flex-direction:row;">
                            <a href="{{ route('admin.favicons.edit', $icon->id) }}" class="btn btn-warning btn-sm"
                                style="margin-right: 5px;">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.favicons.destroy', $icon->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this favicon?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
