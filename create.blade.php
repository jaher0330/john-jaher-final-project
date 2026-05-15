@extends('layouts.app')
@section('title', 'Add Record | Lost & Found System')

@section('content')
<div class="container">
  <div class="form-card">

    <div class="d-flex align-items-center gap-3 mb-4">
      <div style="background:linear-gradient(135deg,#c0392b,#e74c3c); border-radius:10px; width:44px; height:44px; display:flex; align-items:center; justify-content:center; font-size:1.2rem;">➕</div>
      <div>
        <h4 class="mb-0">Report a Lost or Found Item</h4>
        <p class="subtitle mb-0">Fill out the form below to add a new record.</p>
      </div>
    </div>

    @if($errors->any())
      <div class="alert alert-danger mb-4">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>Please fix the following errors:
        <ul class="mb-0 mt-2">
          @foreach($errors->all() as $e)<li style="font-size:0.88rem;">{{ $e }}</li>@endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data">
      @csrf

      {{-- Item Name --}}
      <div class="mb-3">
        <label class="form-label">Item Name <span class="text-danger">*</span></label>
        <input type="text" name="item_name" class="form-control"
               placeholder="e.g. Black Wallet, iPhone, Blue Umbrella"
               value="{{ old('item_name') }}" required>
      </div>

      {{-- Category --}}
      <div class="mb-3">
        <label class="form-label">Category <span class="text-danger">*</span></label>
        <select name="category" class="form-select" required>
          <option value="">-- Select Category --</option>
          <option value="belongings"   {{ old('category') == 'belongings'   ? 'selected' : '' }}>👜 Personal Belongings</option>
          <option value="electronics"  {{ old('category') == 'electronics'  ? 'selected' : '' }}>📱 Electronics</option>
          <option value="documents"    {{ old('category') == 'documents'    ? 'selected' : '' }}>📄 Documents / ID</option>
          <option value="clothing"     {{ old('category') == 'clothing'     ? 'selected' : '' }}>👕 Clothing</option>
          <option value="accessories"  {{ old('category') == 'accessories'  ? 'selected' : '' }}>💍 Accessories</option>
          <option value="school_items" {{ old('category') == 'school_items' ? 'selected' : '' }}>📚 School Items</option>
          <option value="others"       {{ old('category') == 'others'       ? 'selected' : '' }}>📦 Others</option>
        </select>
      </div>

      {{-- Description --}}
      <div class="mb-3">
        <label class="form-label">Description <span class="text-danger">*</span></label>
        <textarea name="description" class="form-control" rows="3"
                  placeholder="Describe the item in detail (color, brand, markings...)"
                  required>{{ old('description') }}</textarea>
      </div>

      <div class="row">
        {{-- Location --}}
        <div class="col-md-6 mb-3">
          <label class="form-label">Location <span class="text-danger">*</span></label>
          <input type="text" name="location" class="form-control"
                 placeholder="e.g. Canteen, Library, Room 201"
                 value="{{ old('location') }}" required>
        </div>
        {{-- Date --}}
        <div class="col-md-6 mb-3">
          <label class="form-label">Date Reported <span class="text-danger">*</span></label>
          <input type="date" name="date_reported" class="form-control"
                 value="{{ old('date_reported', date('Y-m-d')) }}" required>
        </div>
      </div>

      <div class="row">
        {{-- Type --}}
        <div class="col-md-6 mb-3">
          <label class="form-label">Type <span class="text-danger">*</span></label>
          <select name="type" class="form-select" required>
            <option value="lost"  {{ old('type') == 'lost'  ? 'selected' : '' }}>🔴 Lost</option>
            <option value="found" {{ old('type') == 'found' ? 'selected' : '' }}>🟢 Found</option>
          </select>
        </div>
        {{-- Status --}}
        <div class="col-md-6 mb-3">
          <label class="form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-select" required>
            <option value="on_hand"     {{ old('status') == 'on_hand'     ? 'selected' : '' }}>📦 On Hand</option>
            <option value="turned_over" {{ old('status') == 'turned_over' ? 'selected' : '' }}>🏢 Turned Over to Office</option>
            <option value="claimed"     {{ old('status') == 'claimed'     ? 'selected' : '' }}>✅ Claimed</option>
            <option value="missing"     {{ old('status') == 'missing'     ? 'selected' : '' }}>❌ Missing</option>
          </select>
        </div>
      </div>

      {{-- Image --}}
      <div class="mb-4">
        <label class="form-label">Image (Optional)</label>
        <input type="file" name="image" class="form-control" accept="image/*">
        <div class="form-text text-muted" style="font-size:0.82rem;"><i class="bi bi-info-circle me-1"></i>Max 2MB. JPG, PNG accepted.</div>
      </div>

      <button type="submit" class="btn-submit">
        <i class="bi bi-send-fill me-2"></i>Submit Report
      </button>

      <div class="text-center mt-3">
        <a href="{{ route('items.index') }}" style="color:#7f8c8d; font-size:0.88rem; text-decoration:none;">
          <i class="bi bi-arrow-left me-1"></i>Back to View Records
        </a>
      </div>

    </form>
  </div>
</div>
@endsection
