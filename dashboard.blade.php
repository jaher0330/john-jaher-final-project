@extends('layouts.app')
@section('title', 'Admin Panel | Lost & Found System')

@section('content')

<div class="page-header">
  <div class="container d-flex justify-content-between align-items-center">
    <div>
      <h2>🛡️ Admin Dashboard</h2>
      <p>Full control over all records and users.</p>
    </div>
    <span class="badge" style="background-color:#e94560; font-size:0.9rem; padding:8px 16px;">Administrator</span>
  </div>
</div>

<div class="container mt-4">

  {{-- Stats --}}
  <div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
      <div class="stat-card bg-total">
        <div class="number">{{ $totalItems }}</div>
        <div class="label">Total Reports</div>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <div class="stat-card bg-lost">
        <div class="number">{{ $lostItems }}</div>
        <div class="label">Lost Items</div>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <div class="stat-card bg-found">
        <div class="number">{{ $foundItems }}</div>
        <div class="label">Found Items</div>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <div class="stat-card bg-claimed">
        <div class="number">{{ $totalUsers }}</div>
        <div class="label">Registered Users</div>
      </div>
    </div>
  </div>

  {{-- Quick Actions --}}
  <div class="d-flex gap-2 mb-4">
    <a href="{{ route('items.index') }}" class="btn btn-danger px-4">📋 Manage All Records</a>
    <a href="{{ route('items.create') }}" class="btn btn-outline-dark px-4">➕ Add New Record</a>
  </div>

  {{-- Recent Items --}}
  <div class="table-card">
    <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
      <div class="section-title mb-0">Recent Reports</div>
      <a href="{{ route('items.index') }}" style="color:#e94560; font-size:0.9rem;">View All →</a>
    </div>
    <div class="table-responsive">
      <table class="table mb-0">
        <thead>
          <tr>
            <th>Item</th>
            <th>Type</th>
            <th>Status</th>
            <th>Reported By</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($recentItems as $item)
          <tr>
            <td class="fw-semibold">{{ $item->item_name }}</td>
            <td>
              <span class="badge-{{ $item->type }}">{{ ucfirst($item->type) }}</span>
            </td>
            <td>
              <span class="badge-{{ strtolower($item->status) }}">{{ ucfirst($item->status) }}</span>
            </td>
            <td>{{ $item->user->name ?? 'N/A' }}</td>
            <td>{{ $item->date_reported }}</td>
            <td class="d-flex gap-1">
              <a href="{{ route('items.edit', $item) }}" class="btn-edit">✏️ Edit</a>
              <form action="{{ route('items.destroy', $item) }}" method="POST" class="d-inline"
                    onsubmit="return confirm('Delete this item?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn-delete">🗑️ Delete</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

</div>
@endsection
