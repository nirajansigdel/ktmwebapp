@extends('backend.layouts.app')

@section('title', 'Audit Logs')
@section('page_title', 'Audit Logs')

@section('content')
<div class="card border border-dark-700">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-dark table-striped align-middle mb-0">
        <thead><tr><th>Timestamp</th><th>User</th><th>Action</th><th>Target</th><th>Details</th></tr></thead>
        <tbody><tr><td>2025-11-21 10:35</td><td>admin@curiou.co</td><td>CREATE</td><td>Income</td><td>₹5,000 from Client A</td></tr></tbody>
      </table>
    </div>
  </div>
</div>
@endsection


