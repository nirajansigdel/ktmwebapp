@extends('backend.layouts.app')

@section('title', 'Vendors')
@section('page_title', 'Vendors')

@section('content')
<div class="card border border-dark-700">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-dark table-hover align-middle mb-0">
        <thead>
          <tr>
            <th>Photo</th>
            <th>Name</th>
            <th>Vendor Number</th>
            <th>Contact</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Category</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><span class="badge text-bg-secondary">IMG</span></td>
            <td>Everest Traders</td>
            <td>V-1001</td>
            <td>John Doe</td>
            <td>+977-9800000000</td>
            <td>vendor@example.com</td>
            <td>Logistics</td>
            <td>
              <a href="#" class="btn btn-sm btn-outline-light">View</a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  </div>
@endsection


