<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Lost & Found System')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    :root {
      --primary: #c0392b;
      --primary-dark: #96281b;
      --primary-light: #f9ebea;
      --accent: #e74c3c;
      --dark: #1a1a2e;
      --dark-2: #16213e;
      --teal: #0f9b8e;
      --teal-dark: #0a7d72;
      --amber: #f39c12;
      --success: #27ae60;
      --text: #2c3e50;
      --text-light: #7f8c8d;
      --border: #e8ecef;
      --bg: #f4f6f9;
      --white: #ffffff;
      --shadow-sm: 0 1px 3px rgba(0,0,0,0.08), 0 1px 2px rgba(0,0,0,0.06);
      --shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
      --shadow-lg: 0 10px 25px rgba(0,0,0,0.1);
      --radius: 12px;
      --radius-sm: 8px;
    }

    * { box-sizing: border-box; }

    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      background-color: var(--bg);
      color: var(--text);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    /* ===== NAVBAR ===== */
    .active-link {
      background-color: var(--primary) !important;
      color: #fff !important;
      font-weight: 600;
    }
    .nav-link:hover:not(.active-link) {
      background-color: rgba(255,255,255,0.1);
      color: #fff !important;
    }

    /* ===== STAT CARDS ===== */
    .stat-card {
      border: none;
      border-radius: var(--radius);
      padding: 24px;
      color: #fff;
      box-shadow: var(--shadow);
      position: relative;
      overflow: hidden;
      transition: transform 0.2s, box-shadow 0.2s;
    }
    .stat-card:hover { transform: translateY(-2px); box-shadow: var(--shadow-lg); }
    .stat-card::after {
      content: '';
      position: absolute;
      top: -20px; right: -20px;
      width: 100px; height: 100px;
      border-radius: 50%;
      background: rgba(255,255,255,0.08);
    }
    .stat-card .number { font-size: 2.4rem; font-weight: 800; line-height: 1; }
    .stat-card .label  { font-size: 0.85rem; opacity: 0.85; margin-top: 4px; font-weight: 500; }
    .stat-card .icon   { font-size: 2rem; opacity: 0.25; position: absolute; bottom: 12px; right: 16px; }
    .bg-total   { background: linear-gradient(135deg, #1a1a2e, #2d3561); }
    .bg-lost    { background: linear-gradient(135deg, #c0392b, #e74c3c); }
    .bg-found   { background: linear-gradient(135deg, #0f9b8e, #1abc9c); }
    .bg-claimed { background: linear-gradient(135deg, #e67e22, #f39c12); }

    /* ===== BADGES ===== */
    .badge-lost    { background: linear-gradient(135deg, #c0392b, #e74c3c); color:#fff; padding: 5px 12px; border-radius: 20px; font-size:0.78rem; display:inline-block; font-weight:600; }
    .badge-found   { background: linear-gradient(135deg, #0f9b8e, #1abc9c); color:#fff; padding: 5px 12px; border-radius: 20px; font-size:0.78rem; display:inline-block; font-weight:600; }
    .badge-on_hand     { background: linear-gradient(135deg, #0f9b8e, #1abc9c); color:#fff; padding: 5px 12px; border-radius: 20px; font-size:0.78rem; display:inline-block; font-weight:600; }
    .badge-turned_over { background: linear-gradient(135deg, #c0392b, #e74c3c); color:#fff; padding: 5px 12px; border-radius: 20px; font-size:0.78rem; display:inline-block; font-weight:600; }
    .badge-claimed     { background: linear-gradient(135deg, #e67e22, #f39c12); color:#fff; padding: 5px 12px; border-radius: 20px; font-size:0.78rem; display:inline-block; font-weight:600; }
    .badge-missing     { background: linear-gradient(135deg, #7f8c8d, #95a5a6); color:#fff; padding: 5px 12px; border-radius: 20px; font-size:0.78rem; display:inline-block; font-weight:600; }

    /* ===== TABLE ===== */
    .table-card {
      background: var(--white);
      border-radius: var(--radius);
      overflow: hidden;
      box-shadow: var(--shadow);
      border: 1px solid var(--border);
    }
    table thead {
      background: linear-gradient(135deg, var(--dark), var(--dark-2));
      color: #fff;
    }
    table thead th {
      padding: 14px 16px;
      font-weight: 600;
      font-size: 0.82rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      border: none;
    }
    table tbody td {
      padding: 13px 16px;
      vertical-align: middle;
      border-color: var(--border);
      font-size: 0.9rem;
    }
    table tbody tr { transition: background 0.15s; }
    table tbody tr:hover { background-color: #fdf5f5; }

    /* ===== ACTION BUTTONS ===== */
    .btn-edit   { background: linear-gradient(135deg, #0f9b8e, #1abc9c); color:#fff; border:none; border-radius:6px; padding:5px 14px; font-size:0.82rem; font-weight:600; text-decoration:none; transition: opacity 0.2s; }
    .btn-delete { background: linear-gradient(135deg, #c0392b, #e74c3c); color:#fff; border:none; border-radius:6px; padding:5px 14px; font-size:0.82rem; font-weight:600; cursor:pointer; text-decoration:none; transition: opacity 0.2s; }
    .btn-edit:hover, .btn-delete:hover { opacity: 0.85; color: #fff; }

    /* ===== FORM CARD ===== */
    .form-card {
      background: var(--white);
      border-radius: var(--radius);
      padding: 36px;
      box-shadow: var(--shadow);
      max-width: 680px;
      margin: 40px auto;
      border: 1px solid var(--border);
    }
    .form-card h4 { font-weight: 800; color: var(--dark); margin-bottom: 4px; font-size: 1.3rem; }
    .form-card p.subtitle { color: var(--text-light); font-size: 0.9rem; margin-bottom: 28px; }
    .form-label { font-weight: 600; color: var(--text); font-size: 0.88rem; margin-bottom: 6px; }
    .form-control, .form-select {
      border-radius: var(--radius-sm);
      border: 1.5px solid var(--border);
      padding: 10px 14px;
      font-size: 0.92rem;
      font-family: 'Plus Jakarta Sans', sans-serif;
      transition: border-color 0.2s, box-shadow 0.2s;
    }
    .form-control:focus, .form-select:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(192,57,43,0.12);
    }

    /* ===== BUTTONS ===== */
    .btn-submit {
      background: linear-gradient(135deg, var(--primary), var(--accent));
      color: #fff;
      border: none;
      border-radius: var(--radius-sm);
      padding: 12px 32px;
      font-weight: 700;
      font-size: 0.95rem;
      width: 100%;
      margin-top: 8px;
      transition: opacity 0.2s, transform 0.2s;
      font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .btn-submit:hover { opacity: 0.9; transform: translateY(-1px); color: #fff; }

    .btn-update {
      background: linear-gradient(135deg, var(--teal), #1abc9c);
      color: #fff;
      border: none;
      border-radius: var(--radius-sm);
      padding: 12px 32px;
      font-weight: 700;
      font-size: 0.95rem;
      width: 100%;
      margin-top: 8px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      transition: opacity 0.2s;
    }
    .btn-update:hover { opacity: 0.9; color: #fff; }

    /* ===== FILTER BAR ===== */
    .filter-bar {
      background: var(--white);
      border-radius: var(--radius);
      padding: 20px 24px;
      margin-bottom: 20px;
      box-shadow: var(--shadow-sm);
      border: 1px solid var(--border);
    }

    /* ===== PAGE HEADER ===== */
    .page-header {
      background: linear-gradient(135deg, var(--dark) 0%, var(--dark-2) 100%);
      color: #fff;
      padding: 32px 0;
      position: relative;
      overflow: hidden;
    }
    .page-header::before {
      content: '';
      position: absolute;
      top: -50%; right: -10%;
      width: 300px; height: 300px;
      border-radius: 50%;
      background: rgba(192,57,43,0.15);
    }
    .page-header h2 { font-weight: 800; margin-bottom: 4px; font-size: 1.6rem; }
    .page-header p  { opacity: 0.65; margin: 0; font-size: 0.9rem; }

    /* ===== SECTION TITLE ===== */
    .section-title {
      font-size: 1rem;
      font-weight: 700;
      color: var(--dark);
      margin-bottom: 16px;
      border-left: 4px solid var(--primary);
      padding-left: 12px;
    }

    /* ===== ABOUT CARD ===== */
    .about-card {
      background: var(--white);
      border-radius: var(--radius);
      padding: 40px;
      box-shadow: var(--shadow);
      max-width: 700px;
      margin: 40px auto;
      border: 1px solid var(--border);
    }
    .info-row { display:flex; justify-content:space-between; padding:12px 0; border-bottom:1px solid var(--border); font-size:0.92rem; }
    .info-row:last-child { border-bottom: none; }
    .info-label { color: var(--text-light); font-weight: 600; }
    .info-value { color: var(--dark); font-weight: 600; }
    .feature-list li { padding: 7px 0; color: var(--text); font-size: 0.92rem; }
    .feature-list li::before { content: "✅ "; }

    /* ===== EMPTY STATE ===== */
    .empty-state { text-align:center; padding:50px 20px; color: var(--text-light); }

    /* ===== FOOTER ===== */
    footer {
      background: linear-gradient(135deg, var(--dark), var(--dark-2));
      color: rgba(255,255,255,0.5);
      text-align: center;
      padding: 18px;
      margin-top: auto;
      font-size: 0.83rem;
      font-weight: 500;
    }

    /* ===== ALERTS ===== */
    .alert { border-radius: var(--radius-sm); border: none; font-weight: 500; }
    .alert-success { background-color: #eafaf1; color: #1e8449; }
    .alert-danger  { background-color: #fdedec; color: #922b21; }
  </style>
</head>
<body>

  @include('layouts.navbar')

  <div class="container mt-4">
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show shadow-sm">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif
    @if(session('error'))
      <div class="alert alert-danger alert-dismissible fade show shadow-sm">
        <i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif
  </div>

  @yield('content')

  <footer>
    <i class="bi bi-search-heart-fill me-1" style="color:#e74c3c;"></i>
    Lost & Found System &copy; {{ date('Y') }} &mdash; University of Mindanao
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
