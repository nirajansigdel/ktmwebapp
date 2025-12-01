@extends('backend.layouts.app')

@section('title', 'Item Entry')
@section('page_title', 'Enter Details – Create Parcel')

@section('content')
@if (Session::has('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ Session::get('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

@if (Session::has('error'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ Session::get('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<div class="card border border-dark-700">
  <div class="card-body">
    <form method="POST" action="{{ route('admin.items.store') }}" enctype="multipart/form-data">
      @csrf
      <h6 class="text-muted-300 text-uppercase mb-3">Customer Information</h6>
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Customer (Sender)</label>
          <select class="form-select" id="customer_id" name="customer_id">
            <option value="" {{ old('customer_id') == '' ? 'selected' : '' }} disabled>Select a Customer</option>
            @foreach($customers ?? [] as $customer)
              <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>{{ $customer->name }} @if($customer->phone)({{ $customer->phone }})@endif</option>
            @endforeach
          </select>
          <div class="form-text"><a href="#" class="link-light" data-bs-toggle="modal" data-bs-target="#customerModal">Add New Customer</a></div>
        </div>
        <div class="col-md-6">
          <label class="form-label">Receiver</label>
          <select class="form-select" id="receiver_id" name="receiver_id">
            <option value="" {{ old('receiver_id') == '' ? 'selected' : '' }} disabled>Select a Receiver</option>
            @foreach($receivers ?? [] as $receiver)
              <option value="{{ $receiver->id }}" {{ old('receiver_id') == $receiver->id ? 'selected' : '' }}>{{ $receiver->name }} @if($receiver->phone)({{ $receiver->phone }})@endif</option>
            @endforeach
          </select>
          <div class="form-text"><a href="#" class="link-light" data-bs-toggle="modal" data-bs-target="#receiverModal">Add New Receiver</a></div>
        </div>
      </div>

      <hr class="border-dark-700 my-4">
      <h6 class="text-muted-300 text-uppercase mb-3">Parcel Destination Details</h6>
      <div class="row g-3">
        <div class="col-md-4"><label class="form-label">Country</label><input class="form-control" type="text" name="country" value="{{ old('country') }}"></div>
        <div class="col-md-4"><label class="form-label">State</label><input class="form-control" type="text" name="state" value="{{ old('state') }}"></div>
        <div class="col-md-4"><label class="form-label">City</label><input class="form-control" type="text" name="city" value="{{ old('city') }}"></div>
        <div class="col-md-8"><label class="form-label">Street Address</label><input class="form-control" type="text" name="street_address" value="{{ old('street_address') }}"></div>
        <div class="col-md-4"><label class="form-label">Postal Code</label><input class="form-control" type="text" name="postal_code" value="{{ old('postal_code') }}"></div>
      </div>

      <hr class="border-dark-700 my-4">
      <h6 class="text-muted-300 text-uppercase mb-3">Parcel Details</h6>
      <div class="row g-3">
        <div class="col-md-4"><label class="form-label">Box Number</label><input class="form-control" type="text" name="box_number" placeholder="DHL / FedEx / etc." value="{{ old('box_number') }}"></div>
        <div class="col-md-4"><label class="form-label">Sending Date</label><input class="form-control" type="date" name="sending_date" value="{{ old('sending_date') }}"></div>
        <div class="col-md-4"><label class="form-label">Weight</label><input class="form-control" type="number" step="0.01" name="weight" value="{{ old('weight') }}"></div>
        <div class="col-12"><label class="form-label">Description</label><textarea class="form-control" rows="2" name="description">{{ old('description') }}</textarea></div>
        <div class="col-md-4"><label class="form-label">Estimated Delivery Date</label><input class="form-control" type="date" name="estimated_delivery_date" value="{{ old('estimated_delivery_date') }}"></div>
      </div>

      <div class="row g-3 mt-1">
        <div class="col-md-4"><label class="form-label">Dimensions (L × W × H)</label><input class="form-control" type="text" name="dimensions" placeholder="e.g. 10x5x3 cm" value="{{ old('dimensions') }}"></div>
        <div class="col-md-4"><label class="form-label">Package Type</label>
          <select class="form-select" name="package_type">
            <option value="Box" {{ old('package_type') == 'Box' ? 'selected' : '' }}>Box</option>
            <option value="Envelope" {{ old('package_type') == 'Envelope' ? 'selected' : '' }}>Envelope</option>
            <option value="Fragile" {{ old('package_type') == 'Fragile' ? 'selected' : '' }}>Fragile</option>
            <option value="Heavy" {{ old('package_type') == 'Heavy' ? 'selected' : '' }}>Heavy</option>
            <option value="Liquid" {{ old('package_type') == 'Liquid' ? 'selected' : '' }}>Liquid</option>
          </select>
        </div>
      </div>

      <hr class="border-dark-700 my-4">
      <h6 class="text-muted-300 text-uppercase mb-3">Value & Charges</h6>
      <div class="row g-3">
        <div class="col-md-4"><label class="form-label">Declared Value Rate</label><input class="form-control" type="number" step="0.01" name="declared_value_rate" value="{{ old('declared_value_rate') }}"></div>
        <div class="col-md-4"><label class="form-label">Shipping Charge</label><input class="form-control" type="number" step="0.01" name="shipping_charge" value="{{ old('shipping_charge') }}"></div>
        <div class="col-md-4"><label class="form-label">Extra Charge</label><input class="form-control" type="number" step="0.01" name="extra_charge" value="{{ old('extra_charge') }}"></div>
      </div>

      <hr class="border-dark-700 my-4">
      <h6 class="text-muted-300 text-uppercase mb-3">Photo or Document</h6>
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Photo or Document</label>
          <input class="form-control" type="file" name="documents[]" multiple accept="image/*,.pdf,.doc,.docx">
          <small class="form-text text-muted">You can select multiple files (Images, PDF, DOC, DOCX)</small>
        </div>
      </div>

      <hr class="border-dark-700 my-4">
      <h6 class="text-muted-300 text-uppercase mb-3">Tracking</h6>
      <div class="row g-3">
        <div class="col-md-4"><label class="form-label">Tracking Number</label><input class="form-control" type="text" name="tracking_number" placeholder="Auto / Manual (Leave empty for auto-generation)" value="{{ old('tracking_number') }}"></div>
        <div class="col-md-4"><label class="form-label">Status</label>
          <select class="form-select" name="status">
            <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="In Transit" {{ old('status') == 'In Transit' ? 'selected' : '' }}>In Transit</option>
            <option value="Delivered" {{ old('status') == 'Delivered' ? 'selected' : '' }}>Delivered</option>
          </select>
        </div>
      </div>

      <div class="mt-3">
        <label class="form-label">Notes</label>
        <textarea class="form-control" rows="2" name="notes" placeholder="Internal Notes / Special Instructions">{{ old('notes') }}</textarea>
      </div>

      <div class="d-flex justify-content-end gap-2 mt-4">
        <button type="reset" class="btn btn-outline-secondary">Reset</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
  </div>
</div>

<!-- Customer Modal -->
<div class="modal fade" id="customerModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">

      <!-- Header -->
      <div class="modal-header bg-primary text-white rounded-top-4">
        <h5 class="modal-title fw-semibold">
          <i class="fa-solid fa-user-plus me-2"></i>
          Add New Customer
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <!-- Form -->
      <form id="customerModalForm">
        @csrf

        <div class="modal-body p-4">

          <!-- Name + Email -->
          <div class="row g-3 mb-3">
            <div class="col-md-6">

              <div class="form-floating">
                <input type="text"
                       name="name"
                       class="form-control rounded-3"
                       id="nameInput"
                       placeholder="Full Name"
                       required>
                <label for="nameInput">
                  <i class="fa-solid fa-user me-1 text-primary"></i>
                  <span class="text-black">Full Name  </span><span class="text-danger">*</span>
                </label>
              </div>

            </div>

            <div class="col-md-6">

              <div class="form-floating">
                <input type="email"
                       name="email"
                       class="form-control rounded-3"
                       id="emailInput"
                       placeholder="Email">
                <label for="emailInput">
                  <i class="fa-solid fa-envelope me-1 text-primary"></i>
                  <span class="text-black">Email</span>
                </label>
              </div>

            </div>
          </div>

          <!-- Phone + Street -->
          <div class="row g-3 mb-3">
            <div class="col-md-6">

              <div class="form-floating">
                <input type="text"
                       name="phone"
                       class="form-control rounded-3"
                       id="phoneInput"
                       placeholder="Phone">
                <label for="phoneInput">
                  <i class="fa-solid fa-phone me-1 text-primary"></i>
                  <span class="text-black"> Phone </span>
                </label>
              </div>

            </div>

            <div class="col-md-6">

              <div class="form-floating">
                <input type="text"
                       name="street"
                       class="form-control rounded-3"
                       id="streetInput"
                       placeholder="Street">
                <label for="streetInput">
                  <i class="fa-solid fa-road me-1 text-primary"></i>
                  <span class="text-black"> Street </span>
                </label>
              </div>

            </div>
          </div>

          <!-- City + State -->
          <div class="row g-3 mb-3">
            <div class="col-md-6">

              <div class="form-floating">
                <input type="text"
                       name="city"
                       class="form-control rounded-3"
                       id="cityInput"
                       placeholder="City">
                <label for="cityInput">
                  <i class="fa-solid fa-city me-1 text-primary"></i>
                  <span class="text-black"> City </span>
                </label>
              </div>

            </div>

            <div class="col-md-6">

              <div class="form-floating">
                <input type="text"
                       name="state"
                       class="form-control rounded-3"
                       id="stateInput"
                       placeholder="State">
                <label for="stateInput">
                  <i class="fa-solid fa-map me-1 text-primary"></i>
                  <span class="text-black"> State </span>
                </label>
              </div>

            </div>
          </div>

          <!-- Postal + Country -->
          <div class="row g-3 mb-1">
            <div class="col-md-6">

              <div class="form-floating">
                <input type="text"
                       name="postal_code"
                       class="form-control rounded-3"
                       id="postalInput"
                       placeholder="Postal Code">
                <label for="postalInput">
                  <i class="fa-solid fa-location-dot me-1 text-primary"></i>
                  <span class="text-black"> Postal Code </span>
                </label>
              </div>

            </div>

            <div class="col-md-6">

              <div class="form-floating">
                <input type="text"
                       name="country"
                       class="form-control rounded-3"
                       id="countryInput"
                       placeholder="Country">
                <label for="countryInput">
                  <i class="fa-solid fa-flag me-1 text-primary"></i>
                  <span class="text-black"> Country </span>         
                </label>
              </div>

            </div>
          </div>

        </div>

        <!-- Footer -->
        <div class="modal-footer border-0 px-4 pb-4">

          <button type="button"
                  class="btn btn-light rounded-pill px-4 shadow-sm"
                  data-bs-dismiss="modal">
            Cancel
          </button>

          <button type="submit"
                  class="btn btn-primary rounded-pill px-4 shadow-sm">
            <i class="fa-solid fa-check me-1"></i>
            Create Customer
          </button>

        </div>

      </form>
    </div>
  </div>
</div>


<!-- Receiver Modal -->
<div class="modal fade" id="receiverModal" tabindex="-1" aria-labelledby="receiverModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">

            <!-- Header -->
            <div class="modal-header bg-light border-0 rounded-top-4">
                <h5 class="modal-title fw-semibold" id="receiverModalLabel">
                    <i class="bi bi-person-plus me-2"></i> Add New Receiver
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="receiverModalForm">
                @csrf

                <!-- Body -->
                <div class="modal-body px-4">
                    <div class="row g-3">

                        <!-- Name -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control rounded-3" placeholder="Enter full name" required>
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Phone Number</label>
                            <input type="text" name="phone" class="form-control rounded-3" placeholder="98XXXXXXXX">
                        </div>

                        <!-- Email -->
                        <div class="col-12">
                            <label class="form-label fw-semibold">Email Address</label>
                            <input type="email" name="email" class="form-control rounded-3" placeholder="example@email.com">
                        </div>

                        <!-- Street -->
                        <div class="col-12">
                            <label class="form-label fw-semibold">Street Address</label>
                            <input type="text" name="street" class="form-control rounded-3" placeholder="Street / House No.">
                        </div>

                        <!-- City -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">City</label>
                            <input type="text" name="city" class="form-control rounded-3" placeholder="City name">
                        </div>

                        <!-- State -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">State / Province</label>
                            <input type="text" name="state" class="form-control rounded-3" placeholder="State name">
                        </div>

                        <!-- Postal Code -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Postal Code</label>
                            <input type="text" name="postal_code" class="form-control rounded-3" placeholder="Zip Code">
                        </div>

                        <!-- Country -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Country</label>
                            <input type="text" name="country" class="form-control rounded-3" value="Nepal">
                        </div>

                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer bg-light border-0 rounded-bottom-4 px-4">
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary px-5 rounded-pill">
                        Save Receiver
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    // Customer Modal Form Submission
    const customerForm = document.getElementById('customerModalForm');
    if (customerForm) {
        customerForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(customerForm);
            formData.append('_token', '{{ csrf_token() }}');
            
            fetch('{{ route("admin.customers.store") }}', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Add new option to customer dropdown
                    const customerSelect = document.getElementById('customer_id');
                    const newOption = document.createElement('option');
                    // Get the last customer (most recently created)
                    const newCustomer = data.customers[data.customers.length - 1];
                    newOption.value = newCustomer.id;
                    newOption.textContent = newCustomer.name + (newCustomer.phone ? ' (' + newCustomer.phone + ')' : '');
                    customerSelect.appendChild(newOption);
                    customerSelect.value = newCustomer.id;
                    
                    // Close modal and reset form
                    const modal = bootstrap.Modal.getInstance(document.getElementById('customerModal'));
                    modal.hide();
                    customerForm.reset();
                    
                    alert('Customer created successfully!');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error creating customer. Please try again.');
            });
        });
    }

    // Receiver Modal Form Submission
    const receiverForm = document.getElementById('receiverModalForm');
    if (receiverForm) {
        receiverForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(receiverForm);
            formData.append('_token', '{{ csrf_token() }}');
            
            fetch('{{ route("admin.receivers.store") }}', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Add new option to receiver dropdown
                    const receiverSelect = document.getElementById('receiver_id');
                    const newOption = document.createElement('option');
                    // Get the last receiver (most recently created)
                    const newReceiver = data.receivers[data.receivers.length - 1];
                    newOption.value = newReceiver.id;
                    newOption.textContent = newReceiver.name + (newReceiver.phone ? ' (' + newReceiver.phone + ')' : '');
                    receiverSelect.appendChild(newOption);
                    receiverSelect.value = newReceiver.id;
                    
                    // Close modal and reset form
                    const modal = bootstrap.Modal.getInstance(document.getElementById('receiverModal'));
                    modal.hide();
                    receiverForm.reset();
                    
                    alert('Receiver created successfully!');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error creating receiver. Please try again.');
            });
        });
    }
});
</script>
@endsection


