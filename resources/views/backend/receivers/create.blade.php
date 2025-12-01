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
            <h1 class="m-0">Create Receiver</h1>
            <a href="{{ route('admin.receivers.index') }}"><button class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back</button></a>
        </div>
    </div>

    <form id="receiverForm" method="POST" action="{{ route('admin.receivers.store') }}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Receiver Name" value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone Number" value="{{ old('phone') }}">
            </div>
            <div class="form-group">
                <label for="street">Street</label>
                <input type="text" name="street" class="form-control" id="street" placeholder="Street Address" value="{{ old('street') }}">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" name="city" class="form-control" id="city" placeholder="City" value="{{ old('city') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="state">State</label>
                        <input type="text" name="state" class="form-control" id="state" placeholder="State" value="{{ old('state') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="postal_code">Postal Code</label>
                        <input type="text" name="postal_code" class="form-control" id="postal_code" placeholder="Postal Code" value="{{ old('postal_code') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="country">Country</label>
                        <input type="text" name="country" class="form-control" id="country" placeholder="Country" value="{{ old('country') }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Create Receiver</button>
        </div>
    </form>
@stop

