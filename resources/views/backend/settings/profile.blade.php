@extends('backend.layouts.app')

@section('title', 'Profile')
@section('page_title', 'Profile')

@section('content')
<div class="row g-3">
  <div class="col-lg-6">
    <div class="card border border-dark-700">
      <div class="card-header border-dark-700">Profile Settings</div>
      <div class="card-body">
        <form>
          <div class="mb-3"><label class="form-label">Full Name</label><input class="form-control" value="Admin User"></div>
          <div class="mb-3"><label class="form-label">Email</label><input class="form-control" value="admin@curiou.co"></div>
          <div class="mb-3"><label class="form-label">Phone</label><input class="form-control" value="+977-9800000000"></div>
          <div class="mb-3"><label class="form-label">Language</label><select class="form-select"><option>English</option><option>Nepali</option></select></div>
          <div class="mb-3"><label class="form-label">Logo</label><input type="file" class="form-control"></div>
          <div class="mb-3"><label class="form-label">Image</label><input type="file" class="form-control"></div>
          <div class="d-flex justify-content-end"><button class="btn btn-primary">Save Profile</button></div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card border border-dark-700">
      <div class="card-header border-dark-700">Password</div>
      <div class="card-body">
        <form>
          <div class="mb-3"><label class="form-label">Current Password</label><input class="form-control" type="password"></div>
          <div class="mb-3"><label class="form-label">New Password</label><input class="form-control" type="password"></div>
          <div class="mb-3"><label class="form-label">Confirm New Password</label><input class="form-control" type="password"></div>
          <div class="d-flex justify-content-end"><button class="btn btn-primary">Update Password</button></div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection


