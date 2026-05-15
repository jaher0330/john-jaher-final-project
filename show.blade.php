@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">
                    <i class="bi bi-eye-fill me-2"></i>Item Details
                </h5>
                <a href="{{ route('items.index') }}" class="btn btn-sm btn-light">
                    <i class="bi bi-arrow-left me-1"></i>Back
                </a>
            </div>
            <div class="card-body p-4">

                @if($item->image)
                <div class="text-center mb-4">
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->item_name }}"
                         class="img-fluid rounded shadow-sm" style="max-height: 300px;">
                </div>
                @endif

                <table class="table table-borderless">
                    <tr>
                        <th style="width: 160px;" class="text-muted">Item Name</th>
                        <td class="fw-semibold">{{ $item->item_name }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Type</th>
                        <td>
                            @if($item->type === 'lost')
                                <span class="badge bg-danger">🔴 Lost</span>
                            @else
                                <span class="badge bg-success">🟢 Found</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="text-muted">Description</th>
                        <td>{{ $item->description }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Location</th>
                        <td><i class="bi bi-geo-alt-fill text-danger me-1"></i>{{ $item->location }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Date Reported</th>
                        <td>{{ \Carbon\Carbon::parse($item->date_reported)->format('F d, Y') }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Status</th>
                        <td>
                            @php
                                $color = match($item->status) {
                                    'pending'  => 'warning',
                                    'claimed'  => 'info',
                                    'resolved' => 'secondary',
                                    default    => 'light',
                                };
                            @endphp
                            <span class="badge bg-{{ $color }} text-dark">{{ ucfirst($item->status) }}</span>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-muted">Reported By</th>
                        <td>{{ $item->user->name ?? 'N/A' }}</td>
                    </tr>
                </table>

                @if(auth()->user()->isAdmin() || $item->user_id == auth()->id())
                <div class="d-flex gap-2 mt-3">
                    <a href="{{ route('items.edit', $item) }}" class="btn btn-warning">
                        <i class="bi bi-pencil-fill me-1"></i>Edit
                    </a>
                    <form action="{{ route('items.destroy', $item) }}" method="POST"
                          onsubmit="return confirm('Delete this item permanently?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger"><i class="bi bi-trash-fill me-1"></i>Delete</button>
                    </form>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>

@endsection
