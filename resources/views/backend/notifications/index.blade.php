@extends('backend.layouts.app')

@section('title', 'Notifications')
@section('page_title', 'Notifications')

@section('content')
<div class="row g-3">
  <div class="col-md-6">
    <div class="card border border-dark-700">
      <div class="card-header border-dark-700">Due Payments</div>
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <div class="fw-semibold">INV-1042 (Everest Traders)</div>
            <div class="small text-muted-300">₹ 21,000 due in 4 days</div>
          </div>
          <span class="badge text-bg-warning">Due</span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card border border-dark-700">
      <div class="card-header border-dark-700">Low Stock Alerts</div>
      <div class="card-body">
        <div class="small">Laptop — 2 left (Reorder to 5)</div>
        <div class="small">Printer — Value depreciated 80%</div>
      </div>
    </div>
  </div>
</div>
<div class="mt-3 d-flex gap-2">
  <button class="btn btn-outline-light">Email Alerts</button>
  <button class="btn btn-outline-light">SMS Alerts</button>
  <button class="btn btn-outline-light">Bell On/Off</button>
</div>
@endsection


