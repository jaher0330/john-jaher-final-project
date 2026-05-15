@extends('layouts.app')
@section('title', 'Edit Record | Lost & Found System')

@section('content')
<div class="container">
  <div class="form-card">

    <h4>✏️ Edit Record</h4>
    <p class="subtitle">Update the details of this item record.</p>

    {{-- Edit Banner --}}
    <div style="background-color:#fff8e1; border-left:4px solid #f39c12; border-radius:8px; padding:12px 16px; margin-bottom:24px; font-size:0.88rem; color:#6d4c00;">
      📝 You are editing: <strong>{{ $item->item_name }}</strong> (ID: #{{ $item->id }})
    </div>

    @if($errors->any())
      <div class="alert alert-danger">
        ⚠️ Please fix the following errors:
        <ul class="mb-0 mt-1">
          @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('items.update', $item) }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label class="form-label">Item Name <span class="text-danger">*</span></label>
        <input type="text" name="item_name" class="form-control"
               value="{{ old('item_name', $item->item_name) }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Description <span class="text-danger">*</span></label>
        <textarea name="description" class="form-control" rows="3" required>{{ old('description', $item->description) }}</textarea>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Location <span class="text-danger">*</span></label>
          <input type="text" name="location" class="form-control"
                 value="{{ old('location', $item->location) }}" required>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Date Reported <span class="text-danger">*</span></label>
          <input type="date" name="date_reported" class="form-control"
                 value="{{ old('date_reported', $item->date_reported) }}" required>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Type <span class="text-danger">*</span></label>
          <select name="type" class="form-select" required>
            <option value="lost"  {{ old('type', $item->type) == 'lost'  ? 'selected' : '' }}>🔴 Lost</option>
            <option value="found" {{ old('type', $item->type) == 'found' ? 'selected' : '' }}>🟢 Found</option>
          </select>
        </div>
        <div class="col-md-6 mb-4">
          <label class="form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-select" required>
           <option value="lost"    {{ old('status', $item->status) == 'lost'    ? 'selected' : '' }}>🔴 Lost</option>
           <option value="found"   {{ old('status', $item->status) == 'found'   ? 'selected' : '' }}>🟢 Found</option>
           <option value="claimed" {{ old('status', $item->status) == 'claimed' ? 'selected' : '' }}>📦 Claimed</option>
          </select>
        </div>
      </div>

      {{-- Image --}}
      <div class="mb-4">
        <label class="form-label">Update Image (Optional)</label>
        @if($item->image)
          <div class="mb-2">
            <img src="{{ asset('storage/' . $item->image) }}" class="img-thumbnail" style="max-height:120px;">
            <p class="text-muted small mt-1">Current image. Upload new to replace.</p>
          </div>
        @endif
        <input type="file" name="image" class="form-control" accept="image/*">
      </div>

      <button type="submit" class="btn-update">💾 Save Changes</button>

      <div class="text-center mt-3">
        <a href="{{ route('items.index') }}" style="color:#888; font-size:0.9rem;">← Cancel and go back</a>
      </div>

    </form>
  </div>
</div>
@endsection
