@extends('backend.layouts.app')

@section('title', 'Account Statement')
@section('page_title', 'Account Statement')

@section('content')
<div class="card border border-dark-700">
  <div class="card-body">
    <form class="row g-3">
      <div class="col-md-3">
        <label class="form-label">Type</label>
        <select class="form-select">
          <option>Customer</option>
          <option>Vendor</option>
        </select>
      </div>
      <div class="col-md-3">
        <label class="form-label">Name</label>
        <input class="form-control" type="text" placeholder="Search name">
      </div>
      <div class="col-md-3">
        <label class="form-label">From</label>
        <input type="date" class="form-control">
      </div>
      <div class="col-md-3">
        <label class="form-label">To</label>
        <input type="date" class="form-control">
      </div>
      <div class="col-12 d-flex justify-content-end">
        <button class="btn btn-primary">Generate Statement</button>
      </div>
    </form>
  </div>
</div>
<div class="card border border-dark-700 mt-3">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-dark table-striped align-middle mb-0">
        <thead><tr><th>Date</th><th>Ref</th><th>Description</th><th>Debit</th><th>Credit</th><th>Balance</th></tr></thead>
        <tbody><tr><td colspan="6" class="text-center text-muted-300">No records</td></tr></tbody>
      </table>
    </div>
  </div>
</div>
@endsection


