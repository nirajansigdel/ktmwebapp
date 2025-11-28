@extends('backend.layouts.auth')

@section('title', 'Registration')

@section('content')
<style>
  .auth-center { min-height: calc(100vh - 120px); }
  .type-wrap { text-align: center; margin-bottom: 18px; }
  .type-title {
    margin: 0;
    font-weight: 800;
    letter-spacing: .5px;
    background: linear-gradient(90deg, #60a5fa, #22c55e);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
  }
  .type-sub { color: #94a3b8; font-size: .9rem; }
</style>

<div class="d-flex flex-column align-items-center justify-content-center auth-center">
  <div class="type-wrap">
    <h1 id="typeHeaderReg" class="type-title display-6"></h1>
    <div class="type-sub">Create your account to get started</div>
  </div>
  <div class="col-12 col-lg-11">
    <div class="card border border-dark-700">
      <div class="card-body p-4">
        <form id="registrationForm" enctype="multipart/form-data" novalidate>
          <!-- 1. User Type -->
          <div class="mb-4 border-bottom pb-3">
            <h6 class="text-muted-300 text-uppercase mb-3">User Type</h6>
            <div class="row g-3">
              <div class="col-sm-4">
                <label class="form-label" for="userType">Select Type</label>
                <select class="form-select" id="userType" name="userType" required>
                  <option value="" selected disabled>Select an option</option>
                  <option value="user">User</option>
                  <option value="vendor">Vendor</option>
                </select>
                <div class="form-text text-muted-300">Choose Vendor to unlock business fields.</div>
              </div>
            </div>
          </div>

          <!-- 2. Personal / Business Information -->
          <div class="mb-4 border-bottom pb-3">
            <h6 class="text-muted-300 text-uppercase mb-3">Personal / Business Information</h6>
            <div class="row g-3">
              <div class="col-md-6">
                <label for="fullName" class="form-label">Full Name</label>
                <input id="fullName" name="fullName" type="text" class="form-control" placeholder="e.g., Priya Sharma" required>
              </div>
              <div class="col-md-6 vendor-only d-none">
                <label for="businessName" class="form-label">Business Name <span class="badge text-bg-secondary">Vendor</span></label>
                <input id="businessName" name="businessName" type="text" class="form-control" placeholder="e.g., Sharma Traders">
              </div>
              <div class="col-md-6">
                <label for="primaryEmail" class="form-label">Email Address</label>
                <input id="primaryEmail" name="primaryEmail" type="email" class="form-control" placeholder="you@example.com" required>
              </div>
              <div class="col-md-6">
                <label for="phone" class="form-label">Phone Number</label>
                <input id="phone" name="phone" type="tel" inputmode="tel" class="form-control" placeholder="10-digit mobile number" pattern="[0-9]{10}">
                <div class="form-text text-muted-300">Format: 10 digits</div>
              </div>
              <div class="col-md-6">
                <label for="altPhone" class="form-label">Alternate Phone Number <span class="badge text-bg-secondary">Optional</span></label>
                <input id="altPhone" name="altPhone" type="tel" inputmode="tel" class="form-control" placeholder="Alternate number (optional)" pattern="[0-9]{10}">
              </div>
            </div>
            <div class="row g-3 mt-1">
              <div class="col-md-6">
                <label for="street" class="form-label">Street</label>
                <input id="street" name="street" type="text" class="form-control" placeholder="House/Street/Locality">
              </div>
              <div class="col-md-6">
                <label for="city" class="form-label">City</label>
                <input id="city" name="city" type="text" class="form-control" placeholder="e.g., Pune">
              </div>
              <div class="col-md-6">
                <label for="state" class="form-label">State</label>
                <input id="state" name="state" type="text" class="form-control" placeholder="e.g., Maharashtra">
              </div>
              <div class="col-md-3">
                <label for="pincode" class="form-label">Pincode</label>
                <input id="pincode" name="pincode" type="text" inputmode="numeric" class="form-control" placeholder="e.g., 411001" pattern="[0-9]{6}">
                <div class="form-text text-muted-300">6 digits</div>
              </div>
              <div class="col-md-3">
                <label for="country" class="form-label">Country</label>
                <input id="country" name="country" type="text" class="form-control" placeholder="e.g., India">
              </div>
            </div>
          </div>

          <!-- 3. Account Details -->
          <div class="mb-4 border-bottom pb-3">
            <h6 class="text-muted-300 text-uppercase mb-3">Account Details</h6>
            <div class="row g-3">
              <div class="col-md-6">
                <label for="username" class="form-label">Username <span class="badge text-bg-secondary">Optional</span></label>
                <input id="username" name="username" type="text" class="form-control" placeholder="Pick a username (optional)">
              </div>
              <div class="col-md-6">
                <label for="accountEmail" class="form-label">Email</label>
                <input id="accountEmail" name="accountEmail" type="email" class="form-control" placeholder="you@example.com" required>
              </div>
              <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                  <input id="password" name="password" type="password" class="form-control" placeholder="Create a strong password" required minlength="6">
                  <button type="button" class="btn btn-outline-light" data-toggle="password" aria-label="Show password" aria-pressed="false">Show</button>
                </div>
              </div>
              <div class="col-md-6">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <div class="input-group">
                  <input id="confirmPassword" name="confirmPassword" type="password" class="form-control" placeholder="Re-enter password" required minlength="6">
                  <button type="button" class="btn btn-outline-light" data-toggle="confirmPassword" aria-label="Show password" aria-pressed="false">Show</button>
                </div>
                <div id="passwordError" class="text-danger small d-none">Passwords do not match.</div>
              </div>
            </div>
          </div>

          <!-- 4. Identity & Verification -->
          <div class="mb-4 border-bottom pb-3">
            <h6 class="text-muted-300 text-uppercase mb-3">Identity & Verification</h6>
            <div class="row g-3">
              <div class="col-md-4">
                <label for="panNumber" class="form-label">PAN Number</label>
                <input id="panNumber" name="panNumber" type="text" class="form-control" placeholder="ABCDE1234F" maxlength="10" pattern="[A-Z]{5}[0-9]{4}[A-Z]{1}">
                <div class="form-text text-muted-300">Format: ABCDE1234F</div>
              </div>
              <div class="col-md-4">
                <label for="panFile" class="form-label">Upload PAN Document</label>
                <input id="panFile" name="panFile" type="file" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
              </div>
              <div class="col-md-4">
                <label for="aadharFile" class="form-label">Upload Aadhar Document <span class="badge text-bg-secondary">Optional</span></label>
                <input id="aadharFile" name="aadharFile" type="file" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
              </div>
            </div>
            <div class="row g-3 mt-1">
              <div class="col-md-6 vendor-only d-none">
                <label for="gstNumber" class="form-label">GST Number <span class="badge text-bg-secondary">Vendor</span></label>
                <input id="gstNumber" name="gstNumber" type="text" class="form-control" placeholder="15-digit GSTIN" maxlength="15">
              </div>
              <div class="col-md-6 vendor-only d-none">
                <label for="gstFile" class="form-label">Upload GST Certificate <span class="badge text-bg-secondary">Vendor</span></label>
                <input id="gstFile" name="gstFile" type="file" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
              </div>
            </div>
          </div>

          <!-- 6. Optional Add-Ons -->
          <div class="mb-3">
            <h6 class="text-muted-300 text-uppercase mb-3">Optional Add-Ons</h6>
            <div class="row g-3">
              <div class="col-md-4">
                <label for="profilePhoto" class="form-label">Profile Photo</label>
                <input id="profilePhoto" name="profilePhoto" type="file" class="form-control" accept=".jpg,.jpeg,.png">
              </div>
              <div class="col-md-4">
                <label for="referralCode" class="form-label">Referral Code</label>
                <input id="referralCode" name="referralCode" type="text" class="form-control" placeholder="Enter referral code">
              </div>
              <div class="col-12">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="terms" name="terms">
                  <label class="form-check-label" for="terms">
                    I agree to the <a href="#" class="link-light">Terms & Conditions</a>.
                  </label>
                </div>
              </div>
            </div>
          </div>

          <div class="d-flex gap-2 justify-content-end">
            <button type="reset" class="btn btn-outline-secondary">Reset</button>
            <button id="submitBtn" type="submit" class="btn btn-primary" disabled>Create Account</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  (function () {
    const form = document.getElementById('registrationForm');
    const userType = document.getElementById('userType');
    const terms = document.getElementById('terms');
    const submitBtn = document.getElementById('submitBtn');
    const vendorOnlyEls = Array.from(document.querySelectorAll('.vendor-only'));

    const businessName = document.getElementById('businessName');
    const gstNumber = document.getElementById('gstNumber');
    const gstFile = document.getElementById('gstFile');

    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirmPassword');
    const passwordError = document.getElementById('passwordError');

    function syncSubmitDisabled() {
      submitBtn.disabled = !terms.checked;
    }
    function isVendor() {
      return userType.value === 'vendor';
    }
    function toggleVendorFields() {
      const show = isVendor();
      vendorOnlyEls.forEach(el => el.classList.toggle('d-none', !show));
      [businessName, gstNumber, gstFile].forEach(input => {
        if (!input) return;
        if (show) input.setAttribute('required', 'required');
        else {
          input.removeAttribute('required');
          if (input.type !== 'file') input.value = '';
        }
      });
    }
    function wirePasswordToggle(selector, input) {
      const button = document.querySelector(`[data-toggle="${selector}"]`);
      if (!button) return;
      button.addEventListener('click', () => {
        const isHidden = input.getAttribute('type') === 'password';
        input.setAttribute('type', isHidden ? 'text' : 'password');
        const pressed = button.getAttribute('aria-pressed') === 'true';
        button.setAttribute('aria-pressed', String(!pressed));
        button.textContent = isHidden ? 'Hide' : 'Show';
      });
    }
    function validateConfirmPassword() {
      const match = password.value === confirmPassword.value;
      if (!match && confirmPassword.value.length > 0) {
        confirmPassword.setCustomValidity('Passwords do not match');
        passwordError.classList.remove('d-none');
      } else {
        confirmPassword.setCustomValidity('');
        passwordError.classList.add('d-none');
      }
    }
    function normalizePAN() {
      const pan = document.getElementById('panNumber');
      if (!pan) return;
      pan.addEventListener('input', () => {
        pan.value = pan.value.toUpperCase();
      });
    }

    userType.addEventListener('change', toggleVendorFields);
    terms.addEventListener('change', syncSubmitDisabled);
    [password, confirmPassword].forEach(el => el.addEventListener('input', validateConfirmPassword));
    wirePasswordToggle('password', password);
    wirePasswordToggle('confirmPassword', confirmPassword);
    normalizePAN();

    toggleVendorFields();
    syncSubmitDisabled();
    validateConfirmPassword();

    form.addEventListener('submit', (e) => {
      if (!form.checkValidity()) return;
      e.preventDefault();
      submitBtn.disabled = true;
      submitBtn.textContent = 'Submitting...';
      setTimeout(() => {
        alert('Registration submitted successfully (demo).');
        submitBtn.textContent = 'Create Account';
        submitBtn.disabled = false;
      }, 900);
    });

    // Typewriter with subtle typing sound (same as login)
    const headerEl = document.getElementById('typeHeaderReg');
    const text = 'Welcome to KTM Logstic Nepal';
    let i = 0;
    const AudioCtx = window.AudioContext || window.webkitAudioContext;
    const ctx = AudioCtx ? new AudioCtx() : null;
    function clickSound() {
      if (!ctx) return;
      const o = ctx.createOscillator();
      const g = ctx.createGain();
      o.type = 'square';
      o.frequency.value = 800;
      g.gain.value = 0.02;
      o.connect(g); g.connect(ctx.destination);
      o.start();
      setTimeout(() => { o.stop(); }, 35);
    }
    function typeNext() {
      if (!headerEl) return;
      if (i <= text.length) {
        headerEl.textContent = text.slice(0, i);
        if (i > 0 && text[i-1] !== ' ') clickSound();
        i++;
        setTimeout(typeNext, 65);
      }
    }
    setTimeout(typeNext, 150);
  })();
</script>
@endpush


