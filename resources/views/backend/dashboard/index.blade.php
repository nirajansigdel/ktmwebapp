@extends('backend.layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')
<div class="row g-3">
  <div class="col-md-3">
    <div class="card border border-dark-700">
      <div class="card-body">
        <div class="small text-muted-300">Income (This Month)</div>
        <div class="h4 mb-0">₹0</div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card border border-dark-700">
      <div class="card-body">
        <div class="small text-muted-300">Expense (This Month)</div>
        <div class="h4 mb-0">₹0</div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card border border-dark-700">
      <div class="card-body">
        <div class="small text-muted-300">Net Pay</div>
        <div class="h4 mb-0">₹0</div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card border border-dark-700">
      <div class="card-body">
        <div class="small text-muted-300">Remaining</div>
        <div class="h4 mb-0">₹0</div>
      </div>
    </div>
  </div>
</div>

<div class="card border border-dark-700 mt-4">
  <div class="card-header border-dark-700">
    <strong>Top 50 Recent Active</strong>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-dark table-striped table-hover mb-0 align-middle">
        <thead>
          <tr>
            <th>Date</th>
            <th>Type</th>
            <th>Description</th>
            <th>Amount</th>
            <th>Added By</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>21-11-2025</td>
            <td><span class="badge text-bg-success">Income</span></td>
            <td>Payment received from Client A</td>
            <td>₹5,000</td>
            <td>Admin</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection


