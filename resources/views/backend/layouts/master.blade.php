<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'KTM Log Admin')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    /* Default (dark) palette stays as-is */
    :root {
      --bg: #0f172a;
      --panel: #101a2c;
      --panel-2: #0f172a;
      --sidebar: #0f172a;
      --text: #e5e7eb;
      --muted: #a7b1c5;
      --primary: #22c55e;
      --primary-10: rgba(34,197,94,0.10);
      --accent: #60a5fa;
      --warn: #f59e0b;
      --danger: #ef4444;
      --card: #101a2c;
      --border: #2a3446;
      --hover: #16233a;
      --shadow: 0 10px 30px rgba(2, 6, 23, 0.35);
      --radius: 12px;
      --radius-sm: 10px;
      --radius-lg: 16px;
    }
    /* Light palette from your spec */
    .theme-light {
      --bg: #f6f7fb;
      --panel: #ffffff;
      --panel-2: #f8fafc;
      --sidebar: #f0f9ff;
      --muted: #6b7280;
      --text: #0f172a;
      --primary: #22c55e;
      --primary-10: rgba(34, 197, 94, 0.1);
      --accent: #60a5fa;
      --warn: #f59e0b;
      --danger: #ef4444;
      --card: #ffffff;
      --border: #e5e7eb;
      --hover: rgba(0,0,0,0.04);
      --shadow: 0 10px 30px rgba(2, 6, 23, 0.08);
      --radius: 12px;
      --radius-sm: 10px;
      --radius-lg: 16px;
    }
    body { background-color: var(--bg); color: var(--text); }
    /* Light gradient background per spec */
    body.theme-light {
      background:
        radial-gradient(1200px 1200px at 80% -200px, rgba(96,165,250,0.12), transparent 60%),
        radial-gradient(1200px 1200px at -200px 90%, rgba(34,197,94,0.10), transparent 60%),
        var(--bg);
    }
    .navbar, .offcanvas, .card, .dropdown-menu { background-color: var(--panel); color: var(--text); box-shadow: var(--shadow); }
    .navbar .nav-link, .navbar-brand, .dropdown-item { color: var(--text); }
    .navbar .nav-link.active { color: var(--accent); }
    .sidebar-link { color: var(--text); text-decoration: none; display: flex; align-items: center; gap: .625rem; padding: .6rem .75rem; border-radius: .5rem; border: 0; cursor: pointer; }
    .sidebar-link:hover, .sidebar-link.active { background: linear-gradient(90deg, var(--primary-10), rgba(96,165,250,0.10)); border: 0; }
    .border-dark-700 { border-color: var(--border) !important; }
    .text-muted-300 { color: var(--muted) !important; }
    .page-title { color: var(--text); }
    .topnavbar {  overflow-y: auto; background:
      linear-gradient(180deg, rgba(96,165,250,0.06), rgba(96,165,250,0.0) 75%),
      linear-gradient(180deg, rgba(34,197,94,0.06), rgba(34,197,94,0.0) 55%),
      var(--sidebar);
    }
    
    .sidebar-static { position: sticky; top: 0; height: calc(100vh - 56px); overflow-y: auto; padding-top: .75rem; background:
      linear-gradient(180deg, rgba(96,165,250,0.06), rgba(96,165,250,0.0) 25%),
      linear-gradient(180deg, rgba(34,197,94,0.06), rgba(34,197,94,0.0) 55%),
      var(--sidebar);
    }
    .sidebar-brand { border-bottom: 1px solid var(--border); }
    .brand-badge { width: 42px; height: 42px; background: linear-gradient(135deg, var(--primary), var(--accent)); color: #fff; font-weight: 700; box-shadow: 0 12px 25px rgba(34,197,94,0.25); }
    .sidebar-sublink { display:block; padding:.45rem .75rem .45rem 1.75rem; border-radius:.5rem; color: var(--text); text-decoration:none; }
    .sidebar-sublink:hover, .sidebar-sublink.active { background: var(--hover); }
    .sidebar-group .chevron { transition: transform .15s ease; }
    .sidebar-link[aria-expanded="true"] .chevron { transform: rotate(180deg); }

    /* Header pills */
    .pill { display:inline-flex; align-items:center; gap:.5rem; padding:.35rem .75rem; border-radius: 999px; border:1px solid var(--border); background: var(--panel-2); color: var(--text); font-size:.9rem; }
    .pill-accent { border-color: rgba(96,165,250,0.35); background: linear-gradient(180deg, rgba(96,165,250,0.12), rgba(96,165,250,0.06)); }
    .pill-warn { border-color: rgba(245,158,11,0.35) !important; background: linear-gradient(180deg, rgba(245,158,11,0.12), rgba(245,158,11,0.06)); !important }
    .pill-success { border-color: rgba(34,197,94,0.35) !important; background: linear-gradient(180deg, rgba(34,197,94,0.12), rgba(34,197,94,0.06)); !important }
    .btn-reset { appearance:none; background:transparent; border:0; padding:0; color:inherit; width:100%; text-align:left; line-height:inherit; }
    .btn-reset:focus { outline: none; box-shadow: none; }
    /* Ensure navbar dropdown shows above everything */
    .navbar { position: relative; z-index: 10010; overflow: visible; }
    .navbar .container-fluid { position: relative; z-index: 10010; overflow: visible; }
    .navbar .dropdown { position: relative; z-index: 10020; }
    .navbar .dropdown-menu { z-index: 10030 !important; }

    /* Collapsed sidebar */
    body.sidebar-collapsed .sidebar-static { display:none; }
    body.sidebar-collapsed .content-col { flex: 0 0 100% !important; max-width: 100% !important; }

    /* Sidebar icons */
    .nav-ico { width: 18px; height: 18px; margin-right: 10px; opacity: .9; }

    /* Form styling */
    .form-control, .form-select { background-color: var(--panel); color: var(--text); border-color: var(--border); }
    .form-control:focus, .form-select:focus { background-color: var(--panel); color: var(--text); border-color: var(--accent); box-shadow: 0 0 0 0.25rem rgba(96,165,250,0.25); }
    .card { background-color: var(--panel); border-color: var(--border); }
    .table { color: var(--text); }
    .table-dark { background-color: var(--panel); }
    .breadcrumb { background-color: transparent; }
    .breadcrumb-item a { color: var(--accent); }
  </style>
  @stack('head')
</head>
@php($theme = session('theme', 'dark'))
<body class="{{ $theme === 'light' ? 'theme-light' : '' }}">
  <nav class="navbar navbar-expand-lg border-bottom topnavbar">
    <div class="container-fluid">
      <a class="navbar-brand fw-semibold" href="{{ route('admin.dashboard') }}">KTM Log</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarMain">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
          <li class="nav-item me-2 d-none d-md-block">
            <span class="pill">FY 2025</span>
          </li>
          <li class="nav-item me-2 pill pill-success">
            <form method="POST" action="{{ route('theme.switch') }}">
              @csrf
              <input type="hidden" name="theme" value="{{ $theme === 'dark' ? 'light' : 'dark' }}">
              <button type="submit" class="pill pill-success btn-reset">
                {{ $theme === 'dark' ? __('Light Mode') : __('Dark Mode') }}
              </button>
            </form>
          </li>
          <li class="nav-item me-2 pill pill-warn">
            @php($locale = app()->getLocale())
            <form method="POST" action="{{ route('locale.switch') }}" class="d-flex align-items-center gap-2">
              @csrf
              <input type="hidden" name="locale" value="{{ $locale === 'en' ? 'ne' : 'en' }}">
              <button type="submit" class="pill pill-warn btn-reset">
                {{ __('Language:') }} {{ $locale === 'en' ? 'English' : 'नेपाली' }}
              </button>
            </form>
          </li>
          
          <li class="nav-item dropdown pill pill-accent p-0">
            @php($user = auth()->user())
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{ $user?->name ?? 'Super Admin' }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li class="px-3 py-2">
                <div class="fw-semibold">{{ $user?->name }}</div>
                <div class="small text-muted">{{ $user?->email }}</div>
              </li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="dropdown-item text-danger">Logout</button>
                </form>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <aside class="d-none d-md-block col-md-4 col-lg-3 border-end border-dark-700 sidebar-static">
        @include('backend.layouts.sidebar')
      </aside>
      <main class="col-12 col-md-8 col-lg-9 py-4 content-col">
        @yield('content')
      </main>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  @stack('scripts')
  <script>
    (function(){
      const btn = document.getElementById('toggleSidebar');
      if (btn) {
        btn.addEventListener('click', function(){
          document.body.classList.toggle('sidebar-collapsed');
        });
      }
    })();
  </script>
  </body>
</html>

