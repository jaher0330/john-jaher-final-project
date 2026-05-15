@extends('layouts.app')
@section('title', 'View Records | Lost & Found System')

@section('content')

<div class="page-header">
  <div class="container">
    <h2>📋 View Records</h2>
    <p>All reported lost and found items are listed below.</p>
  </div>
</div>

<div class="container mt-4">

  {{-- Filter Bar --}}
  <div class="filter-bar">
    <form method="GET" action="{{ route('items.index') }}" class="row g-2 align-items-end">
      <div class="col-md-6">
        <label class="form-label fw-semibold mb-1" style="font-size:0.88rem;">Search</label>
        <input type="text" name="search" class="form-control"
               placeholder="Search by item name, location..."
               value="{{ request('search') }}">
      </div>
      <div class="col-md-3">
        <label class="form-label fw-semibold mb-1" style="font-size:0.88rem;">Filter by Status</label>
        <select name="status" class="form-select">
          <option value="">All Status</option>
          <option value="lost"    {{ request('status') == 'lost'    ? 'selected' : '' }}>Lost</option>
          <option value="found"   {{ request('status') == 'found'   ? 'selected' : '' }}>Found</option>
          <option value="claimed" {{ request('status') == 'claimed' ? 'selected' : '' }}>Claimed</option>
        </select>
      </div>
      <div class="col-md-3 d-flex gap-2">
        <button type="submit" class="btn btn-danger w-100">Search</button>
        <a href="{{ route('items.index') }}" class="btn btn-outline-secondary w-100">Clear</a>
      </div>
    </form>
  </div>

  {{-- Count & Add Button --}}
  <div class="d-flex justify-content-between align-items-center mb-3">
    <span style="color:#666; font-size:0.9rem;">
      Showing <strong>{{ count($items) }}</strong> record(s)
    </span>
    <a href="{{ route('items.create') }}" class="btn btn-danger">➕ Add New Record</a>
  </div>

  {{-- Table --}}
  <div class="table-card">
    @if(count($items) > 0)
    <div class="table-responsive">
      <table class="table mb-0">
        <thead>
          <tr>
            <th>#</th>
            <th>Item Name</th>
            <th>Description</th>
            <th>Location</th>
            <th>Reported By</th>
            <th>Status</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($items as $i => $item)
          <tr>
            <td>{{ $i + 1 }}</td>
            <td class="fw-semibold">{{ $item->item_name }}</td>
            <td style="max-width:180px; font-size:0.87rem; color:#555;">
              {{ Str::limit($item->description, 60) }}
            </td>
            <td>{{ $item->location }}</td>
            <td>{{ $item->user->name ?? 'N/A' }}</td>
            <td>
              <span class="badge-{{ strtolower($item->status) }}">{{ ucfirst($item->status) }}</span>
            </td>
            <td>{{ $item->date_reported }}</td>
            <td class="d-flex gap-1 flex-wrap">
              @if(auth()->user()->isAdmin() || $item->user_id == auth()->id())
              <a href="{{ route('items.edit', $item) }}" class="btn-edit">✏️ Edit</a>
              <form action="{{ route('items.destroy', $item) }}" method="POST" class="d-inline"
                    onsubmit="return confirm('Are you sure you want to delete this record?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn-delete">🗑️ Delete</button>
              </form>
              @else
              <span class="text-muted small">View only</span>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    @else
    <div class="empty-state">
      <p style="font-size:2.5rem;">📭</p>
      <p>No records found. <a href="{{ route('items.create') }}">Report an item now!</a></p>
    </div>
    @endif
  </div>

</div>
@endsection
