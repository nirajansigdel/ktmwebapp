@extends('backend.layouts.app')

@section('title', 'User Management')
@section('page_title', 'User Management')

@section('content')
<div class="row g-3">
  <div class="col-lg-5">
    <div class="card border border-dark-700">
      <div class="card-header border-dark-700">Add User</div>
      <div class="card-body">
        <form>
          <div class="mb-3"><label class="form-label">Full Name</label><input class="form-control" placeholder="Enter full name"></div>
          <div class="mb-3"><label class="form-label">Email</label><input class="form-control" type="email" placeholder="Enter email address"></div>
          <div class="mb-3"><label class="form-label">Password</label><input class="form-control" type="password"></div>
          <div class="mb-3"><label class="form-label">Role</label>
            <select class="form-select"><option>Super Admin</option><option>Staff</option><option>Finance</option><option>Custom Role</option></select>
          </div>
          <div class="mb-3">
            <div class="small text-muted-300 mb-1">Permissions</div>
            <div class="row g-2">
              <div class="col-6"><div class="form-check"><input class="form-check-input" type="checkbox" id="permView"><label class="form-check-label" for="permView">View</label></div></div>
              <div class="col-6"><div class="form-check"><input class="form-check-input" type="checkbox" id="permCreate"><label class="form-check-label" for="permCreate">Create</label></div></div>
              <div class="col-6"><div class="form-check"><input class="form-check-input" type="checkbox" id="permEdit"><label class="form-check-label" for="permEdit">Edit</label></div></div>
              <div class="col-6"><div class="form-check"><input class="form-check-input" type="checkbox" id="permDelete"><label class="form-check-label" for="permDelete">Delete</label></div></div>
              <div class="col-6"><div class="form-check"><input class="form-check-input" type="checkbox" id="permUsers"><label class="form-check-label" for="permUsers">Manage Users</label></div></div>
              <div class="col-6"><div class="form-check"><input class="form-check-input" type="checkbox" id="permFinance"><label class="form-check-label" for="permFinance">Finance</label></div></div>
            </div>
          </div>
          <div class="d-flex justify-content-end"><button class="btn btn-primary">Create User</button></div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-lg-7">
    <div class="card border border-dark-700">
      <div class="card-header border-dark-700">Users</div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-dark table-striped align-middle mb-0">
            <thead><tr><th>Name</th><th>Email</th><th>Role</th><th>Password</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
              <tr><td>Admin User</td><td>admin@curiou.co</td><td>Super Admin</td><td>••••••••</td><td><span class="badge text-bg-success">Active</span></td><td><div class="btn-group btn-group-sm"><button class="btn btn-outline-light">Edit</button><button class="btn btn-outline-light">Deactivate</button></div></td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection


