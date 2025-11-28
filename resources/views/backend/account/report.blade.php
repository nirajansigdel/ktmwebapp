@extends('backend.layouts.app')

@section('title', 'Account Reports')
@section('page_title', 'Account Reports')

@section('content')
<div class="card border border-dark-700">
  <div class="card-body">
    <form class="row g-3">
      <div class="col-md-3">
        <label class="form-label">Range</label>
        <select class="form-select">
          <option>Monthly</option>
          <option>Yearly</option>
          <option>Custom</option>
        </select>
      </div>
      <div class="col-md-3">
        <label class="form-label">From</label>
        <input type="date" class="form-control">
      </div>
      <div class="col-md-3">
        <label class="form-label">To</label>
        <input type="date" class="form-control">
      </div>
      <div class="col-md-3 d-flex align-items-end">
        <button class="btn btn-primary w-100">Generate</button>
      </div>
    </form>
  </div>
</div>

<div class="row g-3 mt-1">
  <div class="col-md-4">
    <div class="card border border-dark-700"><div class="card-body"><div class="small text-muted-300">Total Income</div><div class="h5 mb-0">₹0</div></div></div>
  </div>
  <div class="col-md-4">
    <div class="card border border-dark-700"><div class="card-body"><div class="small text-muted-300">Total Expenses</div><div class="h5 mb-0">₹0</div></div></div>
  </div>
  <div class="col-md-4">
    <div class="card border border-dark-700"><div class="card-body"><div class="small text-muted-300">Net</div><div class="h5 mb-0">₹0</div></div></div>
  </div>
</div>

<div class="d-flex gap-2 mt-3">
  <button class="btn btn-outline-light">Download PDF</button>
  <button class="btn btn-outline-light">Download Excel</button>
  <button class="btn btn-outline-secondary">Export</button>
  </div>
@endsection


