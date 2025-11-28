@extends('backend.layouts.app')

@section('title', 'Item Details')
@section('page_title', 'Item Details')

@section('content')
<div class="card border border-dark-700">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-dark table-striped align-middle">
        <thead>
          <tr>
            <th>Module</th>
            <th>Customer/Vendor</th>
            <th>Vendor Number</th>
            <th>Bill Number</th>
            <th>Entry Date</th>
            <th>Flight Date</th>
            <th>Estimate Delivery</th>
            <th>Track Number</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Parcel</td>
            <td>Client A</td>
            <td>VND-001</td>
            <td>INV-1042</td>
            <td>21/11/2025</td>
            <td>22/11/2025</td>
            <td>28/11/2025</td>
            <td>TRK-0001</td>
            <td><span class="badge text-bg-info">In Transit</span></td>
            <td>
              <div class="btn-group btn-group-sm">
                <button class="btn btn-outline-light">Print Bill</button>
                <button class="btn btn-outline-light">Print HAWB</button>
                <button class="btn btn-outline-light">Flight Status</button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection


