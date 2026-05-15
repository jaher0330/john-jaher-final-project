<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Lost & Found System')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background-color: #f0f2f5; font-family: 'Segoe UI', sans-serif; }

    /* Navbar */
    .active-link {
      background-color: #e94560 !important;
      color: #fff !important;
      font-weight: 600;
    }
    .nav-link:hover {
      background-color: rgba(255,255,255,0.1);
      color: #fff !important;
    }

    /* Stat Cards */
    .stat-card {
      border: none;
      border-radius: 12px;
      padding: 24px;
      color: #fff;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .stat-card .number { font-size: 2.5rem; font-weight: 700; }
    .stat-card .label  { font-size: 0.95rem; opacity: 0.9; }
    .bg-total   { background-color: #1a1a2e; }
    .bg-lost    { background-color: #e94560; }
    .bg-found   { background-color: #0f9b8e; }
    .bg-claimed { background-color: #f39c12; }

    /* Badges */
    .badge-lost    { background-color: #e94560; color:#fff; padding: 5px 12px; border-radius: 20px; font-size:0.8rem; display:inline-block; }
    .badge-found   { background-color: #0f9b8e; color:#fff; padding: 5px 12px; border-radius: 20px; font-size:0.8rem; display:inline-block; }
    .badge-claimed { background-color: #f39c12; color:#fff; padding: 5px 12px; border-radius: 20px; font-size:0.8rem; display:inline-block; }

    /* Table */
    .table-card { background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,0.07); }
    table thead { background-color: #1a1a2e; color: #fff; }
    table thead th { padding: 14px 16px; font-weight: 500; }
    table tbody td { padding: 13px 16px; vertical-align: middle; }
    table tbody tr:hover { background-color: #fdf0f2; }

    /* Action Buttons */
    .btn-edit   { background-color: #0f9b8e; color:#fff; border:none; border-radius:6px; padding:5px 14px; font-size:0.85rem; text-decoration:none; }
    .btn-delete { background-color: #e94560; color:#fff; border:none; border-radius:6px; padding:5px 14px; font-size:0.85rem; cursor:pointer; text-decoration:none; }
    .btn-edit:hover   { background-color: #0a7d72; color:#fff; }
    .btn-delete:hover { background-color: #c73652; color:#fff; }

    /* Form Card */
    .form-card { background:#fff; border-radius:14px; padding:36px; box-shadow:0 4px 20px rgba(0,0,0,0.08); max-width:680px; margin:40px auto; }
    .form-card h4 { font-weight:700; color:#1a1a2e; margin-bottom:4px; }
    .form-card p.subtitle { color:#888; font-size:0.9rem; margin-bottom:28px; }
    .form-label { font-weight:600; color:#333; font-size:0.9rem; }
    .form-control, .form-select { border-radius:8px; border:1.5px solid #ddd; padding:10px 14px; font-size:0.95rem; }
    .form-control:focus, .form-select:focus { border-color:#e94560; box-shadow:0 0 0 3px rgba(233,69,96,0.15); }

    /* Buttons */
    .btn-submit { background-color:#e94560; color:#fff; border:none; border-radius:8px; padding:11px 32px; font-weight:600; font-size:0.95rem; width:100%; margin-top:8px; transition:background 0.2s; }
    .btn-submit:hover { background-color:#c73652; color:#fff; }
    .btn-update { background-color:#0f9b8e; color:#fff; border:none; border-radius:8px; padding:11px 32px; font-weight:600; font-size:0.95rem; width:100%; margin-top:8px; }
    .btn-update:hover { background-color:#0a7d72; color:#fff; }

    /* Section Title */
    .section-title { font-size:1.1rem; font-weight:600; color:#1a1a2e; margin-bottom:16px; border-left:4px solid #e94560; padding-left:10px; }

    /* Filter Bar */
    .filter-bar { background:#fff; border-radius:12px; padding:18px 24px; margin-bottom:20px; box-shadow:0 2px 10px rgba(0,0,0,0.06); }

    /* Page Header */
    .page-header { background-color:#1a1a2e; color:#fff; padding:30px 0; }
    .page-header h2 { font-weight:700; margin-bottom:4px; }
    .page-header p  { opacity:0.7; margin:0; font-size:0.9rem; }

    /* About Card */
    .about-card { background:#fff; border-radius:14px; padding:40px; box-shadow:0 4px 20px rgba(0,0,0,0.08); max-width:700px; margin:40px auto; }
    .info-row { display:flex; justify-content:space-between; padding:10px 0; border-bottom:1px solid #f0f0f0; font-size:0.93rem; }
    .info-row:last-child { border-bottom:none; }
    .info-label { color:#888; font-weight:600; }
    .info-value { color:#1a1a2e; font-weight:500; }
    .feature-list li { padding:7px 0; color:#444; font-size:0.93rem; }
    .feature-list li::before { content:"✅ "; }

    /* Empty State */
    .empty-state { text-align:center; padding:50px 20px; color:#aaa; }

    /* Footer */
    footer { background-color:#1a1a2e; color:rgba(255,255,255,0.6); text-align:center; padding:16px; margin-top:40px; font-size:0.85rem; }
  </style>
</head>
<body>

  @include('layouts.navbar')

  <div class="container mt-4">
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show">
        ✅ {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif
    @if(session('error'))
      <div class="alert alert-danger alert-dismissible fade show">
        ⚠️ {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif
  </div>

  @yield('content')

  <footer>Lost & Found System &copy; {{ date('Y') }}</footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
