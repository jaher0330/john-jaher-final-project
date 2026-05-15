@extends('layouts.app')
@section('title', 'Edit Record | Lost & Found System')

@section('content')
<div class="container">
  <div class="form-card">

    <div class="d-flex align-items-center gap-3 mb-4">
      <div style="background:linear-gradient(135deg,#0f9b8e,#1abc9c); border-radius:10px; width:44px; height:44px; display:flex; align-items:center; justify-content:center; font-size:1.2rem;">✏️</div>
      <div>
        <h4 class="mb-0">Edit Record</h4>
        <p class="subtitle mb-0">Update the details of this item report.</p>
      </div>
    </div>

    {{-- Edit Banner --}}
    <div style="background:#fffbf0; border-left:4px solid #f39c12; border-radius:8px; padding:12px 16px; margin-bottom:24px; font-size:0.88rem; color:#7d6608;">
      <i class="bi bi-pencil-square me-2"></i>Editing: <strong>{{ $item->item_name }}</strong> &mdash; ID #{{ $item->id }}
    </div>

    @if($errors->any())
      <div class="alert alert-danger mb-4">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>Please fix the following errors:
        <ul class="mb-0 mt-2">
          @foreach($errors->all() as $e)<li style="font-size:0.88rem;">{{ $e }}</li>@endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('items.update', $item) }}" enctype="multipart/form-data">
      @csrf @method('PUT')

      <div class="mb-3">
        <label class="form-label">Item Name <span class="text-danger">*</span></label>
        <input type="text" name="item_name" class="form-control"
               value="{{ old('item_name', $item->item_name) }}" required>
      </div>

      {{-- Category --}}
      <div class="mb-3">
        <label class="form-label">Category <span class="text-danger">*</span></label>
        <select name="category" class="form-select" required>
          <option value="">-- Select Category --</option>
          <option value="belongings"   {{ old('category', $item->category) == 'belongings'   ? 'selected' : '' }}>👜 Personal Belongings</option>
          <option value="electronics"  {{ old('category', $item->category) == 'electronics'  ? 'selected' : '' }}>📱 Electronics</option>
          <option value="documents"    {{ old('category', $item->category) == 'documents'    ? 'selected' : '' }}>📄 Documents / ID</option>
          <option value="clothing"     {{ old('category', $item->category) == 'clothing'     ? 'selected' : '' }}>👕 Clothing</option>
          <option value="accessories"  {{ old('category', $item->category) == 'accessories'  ? 'selected' : '' }}>💍 Accessories</option>
          <option value="school_items" {{ old('category', $item->category) == 'school_items' ? 'selected' : '' }}>📚 School Items</option>
          <option value="others"       {{ old('category', $item->category) == 'others'       ? 'selected' : '' }}>📦 Others</option>
        </select>
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
        <div class="col-md-6 mb-3">
          <label class="form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-select" required>
            <option value="on_hand"     {{ old('status', $item->status) == 'on_hand'     ? 'selected' : '' }}>📦 On Hand</option>
            <option value="turned_over" {{ old('status', $item->status) == 'turned_over' ? 'selected' : '' }}>🏢 Turned Over to Office</option>
            <option value="claimed"     {{ old('status', $item->status) == 'claimed'     ? 'selected' : '' }}>✅ Claimed</option>
            <option value="missing"     {{ old('status', $item->status) == 'missing'     ? 'selected' : '' }}>❌ Missing</option>
          </select>
        </div>
      </div>

      <div class="mb-4">
        <label class="form-label">Update Image (Optional)</label>
        @if($item->image)
          <div class="mb-2 d-flex align-items-center gap-3">
            <img src="{{ asset('storage/' . $item->image) }}" class="img-thumbnail" style="max-height:80px; border-radius:8px;">
            <span class="text-muted small">Current image. Upload new to replace.</span>
          </div>
        @endif
        <input type="file" name="image" class="form-control" accept="image/*">
      </div>

      <button type="submit" class="btn-update">
        <i class="bi bi-save-fill me-2"></i>Save Changes
      </button>

      <div class="text-center mt-3">
        <a href="{{ route('items.index') }}" style="color:#7f8c8d; font-size:0.88rem; text-decoration:none;">
          <i class="bi bi-x-circle me-1"></i>Cancel
        </a>
      </div>

    </form>
  </div>
</div>
@endsection
