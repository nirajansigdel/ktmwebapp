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
            <a href="{{ route('admin.student-details.create') }}">
                <button class="btn btn-primary btn-sm">
                    <i class="fa fa-plus"></i> Add Student Detail
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
        </div><!-- /.col -->
    </div><!-- /.row -->

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>S.N.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Country</th>
                <th>University</th>
                <th>Course</th>
                <th>Intake Date</th>
                <th>Image</th>
                <th>Documents</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($studentDetails as $studentDetail)
                <tr data-widget="expandable-table" aria-expanded="false">
                    <td width="5%">{{ $loop->iteration }}</td>
                    <td>{{ $studentDetail->name ?? '' }}</td>
                    <td>{{ $studentDetail->email ?? '' }}</td>
                    <td>{{ $studentDetail->phone_no ?? '' }}</td>
                    <td>{{ $studentDetail->country->name ?? 'No Country' }}</td>
                    <td>{{ $studentDetail->university->title ?? 'No University' }}</td>
                    <td>{{ $studentDetail->course->title ?? 'No Course' }}</td>
                    <td>{{ $studentDetail->intake_month_year ?? '' }}</td>
                    <td>
                        <img id="preview{{ $loop->iteration }}"
                            src="{{ asset('uploads/students_detail/image/' . $studentDetail->image) }}"
                            style="width: 150px; height:150px" />
                    </td>
                    <td>
                        @php
                            $documents = json_decode($studentDetail->documents, true);
                        @endphp
                        @if ($documents && is_array($documents))
                            <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                                @foreach ($documents as $document)
                                    <div class="document-preview">
                                        @if (preg_match('/\.pdf$/i', $document))
                                            <iframe src="{{ asset($document) }}" style="width: 300px; height: 300px;"
                                                frameborder="0"></iframe>
                                        @elseif(preg_match('/\.(jpg|jpeg|png|gif)$/i', $document))
                                            <img src="{{ asset($document) }}" style="width: 100px; height: 100px;">
                                        @else
                                            <a href="{{ asset($document) }}" target="_blank">View Document</a>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            No Documents
                        @endif
                    </td>

                    <td>
                        <div style="display: flex; flex-direction:row;">
                            <a href="{{ route('admin.student-details.edit', $studentDetail->id) }}"
                                class="btn btn-warning btn-sm" style="margin-right: 5px;">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.student-details.destroy', $studentDetail->id) }}" method="POST"
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
