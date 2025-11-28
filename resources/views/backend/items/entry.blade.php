@extends('backend.layouts.app')

@section('title', 'Item Entry')
@section('page_title', 'Enter Details – Create Parcel')

@section('content')
<div class="card border border-dark-700">
  <div class="card-body">
    <form>
      <h6 class="text-muted-300 text-uppercase mb-3">Customer Information</h6>
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Customer (Sender)</label>
          <select class="form-select">
            <option selected disabled>Select a Customer</option>
          </select>
          <div class="form-text"><a href="#" class="link-light">Add New Customer</a></div>
        </div>
        <div class="col-md-6">
          <label class="form-label">Receiver</label>
          <select class="form-select">
            <option selected disabled>Select a Receiver</option>
          </select>
          <div class="form-text"><a href="#" class="link-light">Add New Receiver</a></div>
        </div>
      </div>

      <hr class="border-dark-700 my-4">
      <h6 class="text-muted-300 text-uppercase mb-3">Parcel Destination Details</h6>
      <div class="row g-3">
        <div class="col-md-4"><label class="form-label">Country</label><input class="form-control" type="text"></div>
        <div class="col-md-4"><label class="form-label">State</label><input class="form-control" type="text"></div>
        <div class="col-md-4"><label class="form-label">City</label><input class="form-control" type="text"></div>
        <div class="col-md-8"><label class="form-label">Street Address</label><input class="form-control" type="text"></div>
        <div class="col-md-4"><label class="form-label">Postal Code</label><input class="form-control" type="text"></div>
      </div>

      <hr class="border-dark-700 my-4">
      <h6 class="text-muted-300 text-uppercase mb-3">Parcel Details</h6>
      <div class="row g-3">
        <div class="col-md-4"><label class="form-label">Box Number</label><input class="form-control" type="text" placeholder="DHL / FedEx / etc."></div>
        <div class="col-md-4"><label class="form-label">Sending Date</label><input class="form-control" type="date"></div>
        <div class="col-md-4"><label class="form-label">Weight</label><input class="form-control" type="number" step="0.01"></div>
        <div class="col-12"><label class="form-label">Description</label><textarea class="form-control" rows="2"></textarea></div>
        <div class="col-md-4"><label class="form-label">Estimated Delivery Date</label><input class="form-control" type="date"></div>
      </div>

      <div class="row g-3 mt-1">
        <div class="col-md-4"><label class="form-label">Dimensions (L × W × H)</label><input class="form-control" type="text" placeholder="e.g. 10x5x3 cm"></div>
        <div class="col-md-4"><label class="form-label">Package Type</label>
          <select class="form-select">
            <option>Box</option><option>Envelope</option><option>Fragile</option><option>Heavy</option><option>Liquid</option>
          </select>
        </div>
      </div>

      <hr class="border-dark-700 my-4">
      <h6 class="text-muted-300 text-uppercase mb-3">Value & Charges</h6>
      <div class="row g-3">
        <div class="col-md-4"><label class="form-label">Declared Value Rate</label><input class="form-control" type="number" step="0.01"></div>
        <div class="col-md-4"><label class="form-label">Shipping Charge</label><input class="form-control" type="number" step="0.01"></div>
        <div class="col-md-4"><label class="form-label">Extra Charge</label><input class="form-control" type="number" step="0.01"></div>
      </div>

      <hr class="border-dark-700 my-4">
      <h6 class="text-muted-300 text-uppercase mb-3">Photo or Document</h6>
      <div class="row g-3">
        <div class="col-md-6"><input class="form-control" type="file" multiple></div>
      </div>

      <hr class="border-dark-700 my-4">
      <h6 class="text-muted-300 text-uppercase mb-3">Tracking</h6>
      <div class="row g-3">
        <div class="col-md-4"><label class="form-label">Tracking Number</label><input class="form-control" type="text" placeholder="Auto / Manual"></div>
        <div class="col-md-4"><label class="form-label">Status</label>
          <select class="form-select">
            <option>In Transit</option><option>Delivered</option><option>Pending</option>
          </select>
        </div>
      </div>

      <div class="mt-3">
        <label class="form-label">Notes</label>
        <textarea class="form-control" rows="2" placeholder="Internal Notes / Special Instructions"></textarea>
      </div>

      <div class="d-flex justify-content-end gap-2 mt-4">
        <button type="reset" class="btn btn-outline-secondary">Reset</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
  </div>
</div>
@endsection


