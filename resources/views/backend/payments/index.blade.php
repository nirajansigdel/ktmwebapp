@extends('backend.layouts.app')

@section('title', 'Amount Paid')
@section('page_title', 'Amount Paid (Vendor → Owner Company)')

@section('content')
<div class="row g-3">
  <div class="col-lg-5">
    <div class="card border border-dark-700">
      <div class="card-header border-dark-700">Vendor Payment Submission</div>
      <div class="card-body">
        <form>
          <div class="mb-3"><label class="form-label">Vendor Name</label><input type="text" class="form-control"></div>
          <div class="mb-3"><label class="form-label">Amount Paid</label><input type="number" step="0.01" class="form-control"></div>
          <div class="mb-3"><label class="form-label">Payment Date</label><input type="date" class="form-control"></div>
          <div class="mb-3"><label class="form-label">Upload Proof / Photo</label><input type="file" class="form-control"></div>
          <div class="mb-3"><label class="form-label">Notes (Optional)</label><textarea class="form-control" rows="2"></textarea></div>
          <div class="d-flex justify-content-end"><button class="btn btn-primary">Submit Payment</button></div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-lg-7">
    <div class="card border border-dark-700">
      <div class="card-header border-dark-700">Admin Verification</div>
      <div class="card-body">
        <div class="row g-3">
          <div class="col-md-6"><div class="small text-muted-300">Vendor Name</div><div>Everest Traders</div></div>
          <div class="col-md-3"><div class="small text-muted-300">Amount Paid</div><div>₹22,000</div></div>
          <div class="col-md-3"><div class="small text-muted-300">Pending to Owner</div><div>₹41,000</div></div>
          <div class="col-md-3"><div class="small text-muted-300">Remaining After Payment</div><div>₹19,000</div></div>
          <div class="col-md-3"><button class="btn btn-sm btn-outline-light">View Proof</button></div>
          <div class="col-md-6"><div class="small text-muted-300">Vendor Notes</div><div>"Payment for invoice P-552"</div></div>
        </div>
        <div class="mt-3 d-flex gap-2">
          <button class="btn btn-success">Verified</button>
          <button class="btn btn-danger" data-bs-toggle="collapse" data-bs-target="#unverifiedNote">Unverified</button>
        </div>
        <div id="unverifiedNote" class="collapse mt-3">
          <label class="form-label">Reason for Unverified Payment</label>
          <textarea class="form-control" rows="2" placeholder="Wrong slip uploaded. Please upload correct proof."></textarea>
          <div class="mt-2"><button class="btn btn-outline-light">Send</button></div>
        </div>
      </div>
    </div>
    <div class="card border border-dark-700 mt-3">
      <div class="card-header border-dark-700">Vendor Payment History</div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-dark table-striped mb-0">
            <thead><tr><th>Date</th><th>Vendor</th><th>Amount</th><th>Status</th><th>Proof</th><th>Notes</th><th>Action</th></tr></thead>
            <tbody>
              <tr><td>2025-11-18</td><td>Everest Traders</td><td>₹22,000</td><td><span class="badge text-bg-success">Verified</span></td><td><a href="#" class="link-light">View</a></td><td>–</td><td>–</td></tr>
              <tr><td>2025-11-16</td><td>Swift Movers</td><td>₹64,500</td><td><span class="badge text-bg-danger">Unverified</span></td><td><a href="#" class="link-light">View</a></td><td>Missing slip</td><td><button class="btn btn-sm btn-outline-light">Resubmit</button></td></tr>
              <tr><td>2025-11-12</td><td>Everest Traders</td><td>₹41,000</td><td><span class="badge text-bg-warning">Pending</span></td><td><a href="#" class="link-light">View</a></td><td>–</td><td><button class="btn btn-sm btn-outline-light">Verify</button></td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection


