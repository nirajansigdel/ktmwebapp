@extends('backend.layouts.app')

@section('title', 'Backup & Restore')
@section('page_title', 'Backup & Restore')

@section('content')
<div class="row g-3">
  <div class="col-md-6">
    <div class="card border border-dark-700">
      <div class="card-header border-dark-700">Create Backup</div>
      <div class="card-body">
        <p class="mb-3 small text-muted-300">Download a complete backup of all system data.</p>
        <button class="btn btn-primary">Download Backup</button>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card border border-dark-700">
      <div class="card-header border-dark-700">Restore Backup</div>
      <div class="card-body">
        <div class="mb-3">
          <label class="form-label">Backup File (.zip / .json)</label>
          <input class="form-control" type="file">
        </div>
        <button class="btn btn-outline-light">Restore</button>
      </div>
    </div>
  </div>
</div>
<div class="mt-3 d-flex gap-2">
  <button class="btn btn-outline-secondary">Enable Auto Backup</button>
  <button class="btn btn-outline-secondary">Cloud Backup</button>
  <button class="btn btn-outline-secondary">Backup History</button>
  </div>
@endsection


