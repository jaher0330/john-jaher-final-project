@extends('layouts.app')
@section('title', 'View Records | Lost & Found System')

@section('content')

<div class="page-header">
  <div class="container">
    <h2><i class="bi bi-list-ul me-2"></i>View Records</h2>
    <p>All reported lost and found items are listed below.</p>
  </div>
</div>

<div class="container mt-4">

  {{-- Filter Bar --}}
  <div class="filter-bar">
    <form method="GET" action="{{ route('items.index') }}" class="row g-2 align-items-end">
      <div class="col-md-6">
        <label class="form-label fw-semibold mb-1" style="font-size:0.85rem; color:#7f8c8d; text-transform:uppercase; letter-spacing:0.5px;">Search</label>
        <div class="position-relative">
          <i class="bi bi-search position-absolute" style="left:12px; top:50%; transform:translateY(-50%); color:#aaa; font-size:0.9rem;"></i>
          <input type="text" name="search" class="form-control ps-4"
                 placeholder="Search by item name, location..."
                 value="{{ request('search') }}">
        </div>
      </div>
      <div class="col-md-3">
        <label class="form-label fw-semibold mb-1" style="font-size:0.85rem; color:#7f8c8d; text-transform:uppercase; letter-spacing:0.5px;">Filter by Status</label>
        <select name="status" class="form-select">
          <option value="">All Status</option>
          <option value="on_hand"     {{ request('status') == 'on_hand'     ? 'selected' : '' }}>📦 On Hand</option>
          <option value="turned_over" {{ request('status') == 'turned_over' ? 'selected' : '' }}>🏢 Turned Over</option>
          <option value="claimed"     {{ request('status') == 'claimed'     ? 'selected' : '' }}>✅ Claimed</option>
          <option value="missing"     {{ request('status') == 'missing'     ? 'selected' : '' }}>❌ Missing</option>
        </select>
      </div>
      <div class="col-md-3 d-flex gap-2">
        <button type="submit" class="btn w-100 fw-600" style="background:linear-gradient(135deg,#c0392b,#e74c3c); color:#fff; border-radius:8px; font-weight:600;">
          <i class="bi bi-search me-1"></i>Search
        </button>
        <a href="{{ route('items.index') }}" class="btn btn-outline-secondary w-100" style="border-radius:8px; font-weight:600;">Clear</a>
      </div>
    </form>
  </div>

  {{-- Count & Add Button --}}
  <div class="d-flex justify-content-between align-items-center mb-3">
    <span style="color:#7f8c8d; font-size:0.88rem; font-weight:500;">
      <i class="bi bi-table me-1"></i>Showing <strong style="color:#2c3e50;">{{ count($items) }}</strong> record(s)
    </span>
    <a href="{{ route('items.create') }}" class="btn px-4 py-2 fw-600" style="background:linear-gradient(135deg,#c0392b,#e74c3c); color:#fff; border-radius:8px; font-size:0.88rem; font-weight:600;">
      <i class="bi bi-plus-circle-fill me-1"></i>Add New Record
    </a>
  </div>

  {{-- Table --}}
  <div class="table-card mb-5">
    @if(count($items) > 0)
    <div class="table-responsive">
      <table class="table mb-0">
        <thead>
          <tr>
            <th>#</th>
            <th>Image</th>
            <th>Item Name</th>
            <th>Category</th>
            <th>Description</th>
            <th>Location</th>
            <th>Reported By</th>
            <th>Type</th>
            <th>Status</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($items as $i => $item)
          <tr>
            <td class="text-muted" style="font-size:0.85rem;">{{ $i + 1 }}</td>
            <td>
              @if($item->image)
                <img src="{{ asset('storage/' . $item->image) }}"
                     style="width:52px; height:52px; object-fit:cover; border-radius:8px; cursor:pointer; border:2px solid #f0f0f0; transition: transform 0.2s;"
                     onclick="openModal(this.src)"
                     onmouseover="this.style.transform='scale(1.1)'"
                     onmouseout="this.style.transform='scale(1)'"
                     title="Click to enlarge">
              @else
                <div style="width:52px; height:52px; border-radius:8px; background:#f4f6f9; display:flex; align-items:center; justify-content:center; border:2px solid #e8ecef;">
                  <i class="bi bi-image text-muted"></i>
                </div>
              @endif
            </td>
            <td class="fw-semibold">{{ $item->item_name }}</td>
            <td>
              <span style="background:#f4f6f9; border-radius:6px; padding:3px 10px; font-size:0.8rem; font-weight:600; color:#2c3e50;">
                {{ ucfirst(str_replace('_', ' ', $item->category ?? 'N/A')) }}
              </span>
            </td>
            <td style="max-width:160px; font-size:0.87rem; color:#7f8c8d;">
              {{ Str::limit($item->description, 50) }}
            </td>
            <td style="font-size:0.88rem;"><i class="bi bi-geo-alt-fill text-muted me-1" style="font-size:0.8rem;"></i>{{ $item->location }}</td>
            <td style="font-size:0.88rem;">{{ $item->user->name ?? 'N/A' }}</td>
            <td>
              @if($item->type === 'lost')
                <span class="badge-lost">🔴 Lost</span>
              @else
                <span class="badge-found">🟢 Found</span>
              @endif
            </td>
            <td>
              <span class="badge-{{ strtolower($item->status) }}">
                {{ ucfirst(str_replace('_', ' ', $item->status)) }}
              </span>
            </td>
            <td style="font-size:0.85rem; color:#7f8c8d;">{{ $item->date_reported }}</td>
            <td>
              @if(auth()->user()->isAdmin())
              <div class="d-flex gap-1">
                <a href="{{ route('items.edit', $item) }}" class="btn-edit">
                  <i class="bi bi-pencil-fill me-1"></i>Edit
                </a>
                <form action="{{ route('items.destroy', $item) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Are you sure you want to delete this record?')">
                  @csrf @method('DELETE')
                  <button type="submit" class="btn-delete">
                    <i class="bi bi-trash-fill me-1"></i>Delete
                  </button>
                </form>
              </div>
              @else
              <span class="text-muted" style="font-size:0.82rem; font-style:italic;">View only</span>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    @else
    <div class="empty-state">
      <i class="bi bi-inbox" style="font-size:3.5rem; color:#ddd;"></i>
      <p class="mt-3 mb-1 fw-semibold" style="font-size:1.05rem;">No records found</p>
      <p class="text-muted small">Try adjusting your search or filter criteria.</p>
      <a href="{{ route('items.create') }}" class="btn mt-2 px-4" style="background:linear-gradient(135deg,#c0392b,#e74c3c); color:#fff; border-radius:8px; font-weight:600;">Report an Item</a>
    </div>
    @endif
  </div>

</div>

{{-- Image Modal --}}
<div id="imageModal" onclick="closeModal()"
     style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
            background:rgba(0,0,0,0.88); z-index:9999; justify-content:center;
            align-items:center; cursor:pointer; backdrop-filter:blur(4px);">
  <img id="modalImg" src="" style="max-width:80vw; max-height:85vh; width:auto; height:auto; border-radius:16px; box-shadow:0 25px 60px rgba(0,0,0,0.6);">
  <div style="position:absolute; top:24px; right:30px; color:#fff; font-size:1.8rem; cursor:pointer; background:rgba(255,255,255,0.15); border-radius:50%; width:40px; height:40px; display:flex; align-items:center; justify-content:center;">✕</div>
</div>

<script>
  function openModal(src) {
    document.getElementById('modalImg').src = src;
    document.getElementById('imageModal').style.display = 'flex';
  }
  function closeModal() {
    document.getElementById('imageModal').style.display = 'none';
  }
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeModal();
  });
</script>

@endsection
