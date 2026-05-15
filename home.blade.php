@extends('layouts.app')
@section('title', 'Home | Lost & Found System')

@section('content')

{{-- Page Header --}}
<div style="background-color:#1a1a2e; color:#fff; padding:40px 0 30px;">
  <div class="container">
    <h1 class="fw-bold mb-1">🔍 Lost & Found System</h1>
    <p class="mb-0" style="opacity:0.7;">Track, manage, and recover lost items easily.</p>
  </div>
</div>

<div class="container mt-4">

  {{-- Dashboard Cards --}}
  <div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
      <div class="stat-card bg-total">
        <div class="number">{{ $total }}</div>
        <div class="label">Total Records</div>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <div class="stat-card bg-lost">
        <div class="number">{{ $lost }}</div>
        <div class="label">Lost Items</div>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <div class="stat-card bg-found">
        <div class="number">{{ $found }}</div>
        <div class="label">Found Items</div>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <div class="stat-card bg-claimed">
        <div class="number">{{ $claimed }}</div>
        <div class="label">Claimed Items</div>
      </div>
    </div>
  </div>

  {{-- Quick Actions --}}
  @auth
  <div class="d-flex gap-2 mb-4">
    <a href="{{ route('items.create') }}" class="btn btn-danger px-4">➕ Report an Item</a>
    <a href="{{ route('items.index') }}"  class="btn btn-outline-dark px-4">📋 View All Records</a>
  </div>
  @else
  <div class="d-flex gap-2 mb-4">
    <a href="{{ route('login') }}"    class="btn btn-danger px-4">🔑 Login to Report</a>
    <a href="{{ route('register') }}" class="btn btn-outline-dark px-4">📝 Register</a>
  </div>
  @endauth

  {{-- Recent Records --}}
  <div class="bg-white rounded-3 shadow-sm p-4">
    <div class="section-title">Recent Records</div>
    @if(count($recent) > 0)
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead style="background-color:#1a1a2e; color:#fff;">
            <tr>
              <th>#</th>
              <th>Item Name</th>
              <th>Location</th>
              <th>Reported By</th>
              <th>Status</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            @foreach($recent as $i => $item)
            <tr>
              <td>{{ $i + 1 }}</td>
              <td class="fw-semibold">{{ $item->item_name }}</td>
              <td>{{ $item->location }}</td>
              <td>{{ $item->user->name ?? 'N/A' }}</td>
              <td>
                <span class="badge-{{ strtolower($item->status) }}">{{ ucfirst($item->status) }}</span>
              </td>
              <td>{{ $item->date_reported }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @else
      <p class="text-muted text-center py-3">No records yet. <a href="{{ route('items.create') }}">Add one now!</a></p>
    @endif
  </div>

</div>
@endsection
