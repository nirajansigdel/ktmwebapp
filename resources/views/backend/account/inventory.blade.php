@extends('backend.layouts.app')

@section('title', 'Inventory (Account)')
@section('page_title', 'Inventory Overview')

@section('content')
<div class="card border border-dark-700">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-dark table-striped align-middle">
        <thead>
          <tr>
            <th>Item</th>
            <th>Category</th>
            <th>Cost</th>
            <th>Dep (%)</th>
            <th>Current Value</th>
            <th>Stock</th>
            <th>Reorder Level</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Laptop</td>
            <td>IT</td>
            <td>₹60,000</td>
            <td>20%</td>
            <td>₹24,000</td>
            <td>2</td>
            <td>5</td>
            <td><span class="badge text-bg-warning">Low</span></td>
            <td><button class="btn btn-sm btn-outline-light">View</button></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection


