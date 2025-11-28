@extends('backend.layouts.app')

@section('title', 'Inventory')
@section('page_title', 'Inventory (with Depreciation)')

@section('content')
<div class="row g-3">
  <div class="col-lg-5">
    <div class="card border border-dark-700">
      <div class="card-header border-dark-700">Add Inventory Item</div>
      <div class="card-body">
        <form>
          <div class="mb-2"><label class="form-label">Item Name</label><input class="form-control" type="text"></div>
          <div class="mb-2"><label class="form-label">Category</label><input class="form-control" type="text"></div>
          <div class="mb-2"><label class="form-label">Purchase Date</label><input class="form-control" type="date"></div>
          <div class="mb-2"><label class="form-label">Purchase Cost</label><input class="form-control" type="number" step="0.01"></div>
          <div class="mb-2"><label class="form-label">Depreciation Method</label>
            <select class="form-select"><option>Straight Line</option><option>Reducing Balance</option></select>
          </div>
          <div class="mb-2"><label class="form-label">Depreciation Rate (%)</label><input class="form-control" type="number" step="0.01"></div>
          <div class="mb-2"><label class="form-label">Useful Life (Years)</label><input class="form-control" type="number" step="1"></div>
          <hr class="border-dark-700">
          <div class="mb-2"><label class="form-label">Opening Stock</label><input class="form-control" type="number" step="1"></div>
          <div class="mb-2"><label class="form-label">Quantity Added</label><input class="form-control" type="number" step="1"></div>
          <div class="mb-2"><label class="form-label">Quantity Used / Sold</label><input class="form-control" type="number" step="1"></div>
          <div class="mb-2"><label class="form-label">Reorder Level</label><input class="form-control" type="number" step="1"></div>
          <div class="mb-2"><label class="form-label">Minimum Order Qty</label><input class="form-control" type="number" step="1"></div>
          <div class="mb-2"><label class="form-label">Item Photo</label><input class="form-control" type="file" accept=".jpg,.jpeg,.png"></div>
          <div class="mb-3"><label class="form-label">Notes</label><textarea class="form-control" rows="2"></textarea></div>
          <div class="d-flex justify-content-end"><button class="btn btn-primary">Save Inventory Item</button></div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-lg-7">
    <div class="card border border-dark-700">
      <div class="card-header border-dark-700">Inventory List</div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-dark table-striped align-middle mb-0">
            <thead><tr><th>Item</th><th>Cost</th><th>Dep (%)</th><th>Current Value</th><th>Stock</th><th>Reorder</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody><tr><td>Laptop</td><td>₹60,000</td><td>20%</td><td>₹24,000</td><td>2</td><td>5</td><td><span class="badge text-bg-warning">Low</span></td><td><button class="btn btn-sm btn-outline-light">View</button></td></tr></tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="card border border-dark-700 mt-3">
      <div class="card-header border-dark-700">Depreciation Summary</div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-dark table-striped mb-0">
            <thead><tr><th>Item</th><th>Cost</th><th>Method</th><th>Rate</th><th>Accumulated</th><th>Current Value</th><th>Remaining Life</th></tr></thead>
            <tbody><tr><td>Laptop</td><td>₹60,000</td><td>Straight Line</td><td>20%</td><td>₹36,000</td><td>₹24,000</td><td>1 yr</td></tr></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection


