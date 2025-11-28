@extends('backend.layouts.app')

@section('title', 'Expense')
@section('page_title', 'Add Expense')

@section('content')
<div class="row g-3">
  <div class="col-lg-5">
    <div class="card border border-dark-700">
      <div class="card-body">
        <form>
          <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Category</label>
            <select class="form-select">
              <option>Transport</option>
              <option>Fuel</option>
              <option>Salary</option>
              <option>Office Materials</option>
              <option>Customs</option>
              <option>Packing</option>
            </select>
          </div>
          <div class="form-check form-switch mb-2">
            <input class="form-check-input" type="checkbox" id="toggleVendor">
            <label class="form-check-label" for="toggleVendor">Vendor (optional)</label>
          </div>
          <div class="mb-3 vendor-field d-none">
            <label class="form-label">Vendor Name</label>
            <input type="text" class="form-control" placeholder="Select or type vendor name">
          </div>
          <div class="mb-3">
            <label class="form-label">Amount</label>
            <input type="number" step="0.01" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Notes</label>
            <textarea class="form-control" rows="2"></textarea>
          </div>
          <div class="d-flex justify-content-end gap-2">
            <button class="btn btn-outline-secondary" type="reset">Reset</button>
            <button class="btn btn-primary" type="submit">Save Expense</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-lg-7">
    <div class="card border border-dark-700">
      <div class="card-header border-dark-700">Recent Expenses</div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-dark table-striped mb-0">
            <thead>
              <tr>
                <th>Date</th>
                <th>Customer</th>
                <th>Vendor</th>
                <th>Total</th>
                <th>Paid</th>
                <th>Remaining</th>
              </tr>
            </thead>
            <tbody>
              <tr><td colspan="6" class="text-center text-muted-300">No records</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('scripts')
<script>
  (function () {
    const toggle = document.getElementById('toggleVendor');
    const vendorField = document.querySelector('.vendor-field');
    toggle.addEventListener('change', () => {
      vendorField.classList.toggle('d-none', !toggle.checked);
    });
  })();
</script>
@endpush


