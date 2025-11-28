@extends('backend.layouts.app')

@section('title', 'Income')
@section('page_title', 'Add Income')

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
              <option>Parcel Income</option>
              <option>Service Charge</option>
              <option>Delivery Income</option>
              <option>Other Income</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Customer Name</label>
            <input type="text" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Amount</label>
            <input type="number" step="0.01" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Notes (optional)</label>
            <textarea class="form-control" rows="2"></textarea>
          </div>
          <div class="d-flex justify-content-end gap-2">
            <button class="btn btn-outline-secondary" type="reset">Reset</button>
            <button class="btn btn-primary" type="submit">Save Income</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-lg-7">
    <div class="card border border-dark-700">
      <div class="card-header border-dark-700">Recent Income</div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-dark table-striped mb-0">
            <thead>
              <tr>
                <th>Date</th>
                <th>Customer</th>
                <th>Category</th>
                <th>Amount</th>
                <th>Pending</th>
              </tr>
            </thead>
            <tbody>
              <tr><td colspan="5" class="text-center text-muted-300">No records</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection


