@extends('backend.layouts.app')

@section('title', 'Vendor Details')
@section('page_title', 'Vendor Details')

@section('content')
<div class="row g-3">
  <div class="col-lg-4">
    <div class="card border border-dark-700">
      <div class="card-body">
        <div class="d-flex align-items-center gap-3">
          <div class="rounded bg-secondary d-flex align-items-center justify-content-center" style="width:64px;height:64px;">IMG</div>
          <div>
            <div class="h5 mb-0">Everest Traders</div>
            <div class="small text-muted-300">Vendor No: V-1001</div>
          </div>
        </div>
        <hr class="border-dark-700">
        <div class="small">
          <div><strong>Contact:</strong> John Doe</div>
          <div><strong>Phone:</strong> +977-9800000000</div>
          <div><strong>Email:</strong> vendor@example.com</div>
          <div><strong>Address:</strong> Kathmandu, Nepal</div>
          <div><strong>PAN/GST:</strong> ABCDE1234F / 22ABCDE1234F1Z5</div>
          <div class="mt-2">
            <button class="btn btn-sm btn-outline-light">Notes</button>
          </div>
        </div>
      </div>
    </div>
    <div class="card border border-dark-700 mt-3">
      <div class="card-header border-dark-700">Payment History</div>
      <div class="card-body p-0">
        <table class="table table-dark table-striped mb-0">
          <thead><tr><th>Date</th><th>Ref</th><th>Amount</th><th>Status</th></tr></thead>
          <tbody><tr><td>2025-11-18</td><td>P-552</td><td>₹22,000</td><td><span class="badge text-bg-success">Paid</span></td></tr></tbody>
        </table>
      </div>
    </div>
    <div class="card border border-dark-700 mt-3">
      <div class="card-header border-dark-700">Outstanding Balances</div>
      <div class="card-body">
        <div class="d-flex justify-content-between"><span>Outstanding</span><strong>₹41,000</strong></div>
        <div class="small text-muted-300">Due Date: —</div>
      </div>
    </div>
  </div>
  <div class="col-lg-8">
    <div class="card border border-dark-700">
      <div class="card-header border-dark-700">Vendor Item Details</div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-dark table-striped mb-0">
            <thead>
              <tr>
                <th>Item</th><th>Weight/Qty</th><th>Rate</th><th>Total</th><th>Extra</th><th>Ship Date</th><th>Flight Date</th><th>Remarks</th><th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Boxes</td><td>10 kg</td><td>₹100</td><td>₹1000</td><td>₹100</td><td>20/11/2025</td><td>21/11/2025</td><td>-</td>
                <td>
                  <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-light">Submit</button>
                    <button class="btn btn-outline-light">Approve</button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="card border border-dark-700 mt-3">
      <div class="card-header border-dark-700">Verification</div>
      <div class="card-body">
        <div class="d-flex gap-2">
          <button class="btn btn-success">Verified</button>
          <button class="btn btn-danger" data-bs-toggle="collapse" data-bs-target="#unverifyBox">Unverified</button>
        </div>
        <div id="unverifyBox" class="collapse mt-3">
          <label class="form-label">Reason for Unverified Payment</label>
          <textarea class="form-control" rows="2" placeholder="e.g. Wrong slip uploaded. Please upload correct proof."></textarea>
          <div class="mt-2"><button class="btn btn-outline-light">Send</button></div>
        </div>
      </div>
    </div>

    <div class="card border border-dark-700 mt-3">
      <div class="card-header border-dark-700">View Everything</div>
      <div class="card-body">
        <ul class="mb-0">
          <li>Vendor details, items, payment history, balances, notes</li>
          <li>Verification status, tracking number, flight info, receiver, parcel, charges, transactions</li>
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection


