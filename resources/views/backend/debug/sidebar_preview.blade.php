<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sidebar Preview</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-4">
    <div class="mb-3 d-flex justify-content-between align-items-center">
      <h1 class="h5 m-0">Sidebar Include Preview</h1>
      <a class="btn btn-sm btn-primary" href="{{ route('admin.frontend.post') }}">Post to the Frontend</a>
    </div>
    <div class="row">
      <div class="col-md-4">
        @include('backend.includes.sidebar')
      </div>
      <div class="col-md-8">
        <div class="alert alert-info">This page only previews the sidebar include. Use the button above to open the public frontend in a new tab.</div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
<html>


