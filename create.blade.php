@extends('layouts.app')
@section('title', 'Add Record | Lost & Found System')

@section('content')
<div class="container">
  <div class="form-card">

    <h4>➕ Report a Lost or Found Item</h4>
    <p class="subtitle">Fill out the form below to add a new record to the system.</p>

    @if($errors->any())
      <div class="alert alert-danger">
        ⚠️ Please fix the following errors:
        <ul class="mb-0 mt-1">
          @foreach($errors->all() as $e)
            <li>{{ $e }}</li>
          @endforeach
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

      {{-- Description --}}
      <div class="mb-3">
        <label class="form-label">Description <span class="text-danger">*</span></label>
        <textarea name="description" class="form-control" rows="3"
                  placeholder="Describe the item in detail (color, brand, markings...)"
                  required>{{ old('description') }}</textarea>
      </div>

      <hr style="border-top:1.5px solid #f0f0f0; margin:22px 0;">

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
            <option value="lost"    {{ old('type') == 'lost'    ? 'selected' : '' }}>🔴 Lost</option>
            <option value="found"   {{ old('type') == 'found'   ? 'selected' : '' }}>🟢 Found</option>
          </select>
        </div>
        {{-- Status --}}
        <div class="col-md-6 mb-4">
          <label class="form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-select" required>
            <option value="lost"    {{ old('status') == 'lost'    ? 'selected' : '' }}>🔴 Lost</option>
            <option value="found"   {{ old('status') == 'found'   ? 'selected' : '' }}>🟢 Found</option>
            <option value="claimed" {{ old('status') == 'claimed' ? 'selected' : '' }}>📦 Claimed</option>
          </select>
        </div>
      </div>

      {{-- Image --}}
      <div class="mb-4">
        <label class="form-label">Image (Optional)</label>
        <input type="file" name="image" class="form-control" accept="image/*">
        <div class="form-text">Max 2MB. JPG, PNG accepted.</div>
      </div>

      <button type="submit" class="btn-submit">Submit Report</button>

      <div class="text-center mt-3">
        <a href="{{ route('items.index') }}" style="color:#888; font-size:0.9rem;">← Back to View Records</a>
      </div>

    </form>
  </div>
</div>
@endsection
