@extends('backend.layouts.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="container">
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
                <h1 class="m-0">Team Members</h1>
                <a href="{{ route('admin.teams.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>Add
                    Team</a>
                <a href="{{ url('admin') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
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
                    <th>Name</th>
                    <th>Position</th>
                    <th>Phone Number</th>
                    <th>Role</th>
                    <th>Email</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teamMembers as $member)
                    <tr data-widget="expandable-table" aria-expanded="false">
                        <td width="5%">{{ $loop->iteration }}</td>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->position }}</td>
                        <td>{{ $member->phone_no }}</td>
                        <td>{{ $member->role }}</td>
                        <td>{{ $member->email }}</td>
                        <td><img id="preview{{ $loop->iteration }}"
                                src="{{ $member->image ? asset('uploads/team/' . $member->image) : '' }}"
                                style="width: 150px; height:150px" /></td>
                        <td>
                            <div style="display: flex; flex-direction:row;">
                                <a href="{{ route('admin.teams.edit', $member->id) }}" class="btn btn-warning btn-sm"
                                    style="margin-right: 5px;"><i class="fas fa-edit"></i> Edit</a>
                                <form action="{{ route('admin.teams.destroy', $member->id) }}" method="POST"
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
    </div>

    <script>
        const previewImage1 = e => {
            const reader = new FileReader();
            reader.readAsDataURL(e.target.files[0]);
            reader.onload = () => {
                const preview = document.getElementById('preview1');
                preview.src = reader.result;
            };
        };
    </script>
@endsection
