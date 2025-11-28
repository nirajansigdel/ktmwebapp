@extends('backend.layouts.auth')

@section('title', 'Login')

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
    <h1 id="typeHeader" class="type-title display-6"></h1>
    <div class="type-sub">Please sign in to continue</div>
  </div>
  <div class="col-12 col-md-8 col-lg-5">
    <div class="card border border-dark-700">
      <div class="card-body p-4">
        <form id="loginForm" method="POST" action="{{ route('login.post') }}">
          @csrf
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" name="email" type="email" class="form-control" placeholder="you@example.com" required>
            @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
          </div>
          <div class="mb-2">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
              <input id="password" name="password" type="password" class="form-control" placeholder="Enter your password" required minlength="6">
              <button class="btn btn-outline-light" type="button" id="togglePassword" aria-label="Show password" aria-pressed="false">Show</button>
            </div>
            <div class="form-text text-muted-300">Minimum 6 characters.</div>
          </div>
          <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" name="remember" id="remember">
            <label class="form-check-label" for="remember">Remember me</label>
          </div>
          @error('password')<div class="text-danger small mb-2">{{ $message }}</div>@enderror
          @if ($errors->has('email') && !$errors->has('password'))
            <div class="text-danger small mb-2">{{ $errors->first('email') }}</div>
          @endif
          <div class="d-flex gap-2 justify-content-end">
            <button type="reset" class="btn btn-outline-secondary">Reset</button>
            <button type="submit" class="btn btn-primary">Sign In</button>
          </div>
        </form>
      </div>
    </div>
    <div class="col-12 mt-3 text-center">
      <div class="small text-muted-300">Don't have an account? <a href="#" class="link-light">Register</a></div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  (function () {
    const password = document.getElementById('password');
    const togglePassword = document.getElementById('togglePassword');

    if (togglePassword) {
      togglePassword.addEventListener('click', () => {
        const isHidden = password.getAttribute('type') === 'password';
        password.setAttribute('type', isHidden ? 'text' : 'password');
        const pressed = togglePassword.getAttribute('aria-pressed') === 'true';
        togglePassword.setAttribute('aria-pressed', String(!pressed));
        togglePassword.textContent = isHidden ? 'Hide' : 'Show';
      });
    }

    // Typewriter with subtle typing sound
    const headerEl = document.getElementById('typeHeader');
    const text = 'Welcome to KTM Logstic Nepal';
    let i = 0;

    // WebAudio click per character (very subtle)
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
      if (i <= text.length) {
        headerEl.textContent = text.slice(0, i);
        if (i > 0 && text[i-1] !== ' ') clickSound();
        i++;
        setTimeout(typeNext, 65);
      }
    }
    // Start after a tiny delay for smoother mount
    setTimeout(typeNext, 150);
  })();
</script>
@endpush


