@extends('layouts.app')

@section('title', 'Add New Location')
@section('page_title', 'Location')

@section('content')
<div class="row justify-content-center">
  <div class="col-lg-8 col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>Location <span class="text-primary">Input Form</span></h6>
      </div>
      <div class="card-body">
        <form action="{{ route('location.store') }}" method="POST">
          @csrf
          
          <div class="mb-3">
            <label for="location_name" class="form-label text-xs font-weight-bold text-uppercase">Location Name</label>
            <input type="text" class="form-control @error('location_name') is-invalid @enderror" id="location_name" name="location_name" value="{{ old('location_name') }}" placeholder="e.g. Gedung A" required>
            @error('location_name')
              <div class="invalid-feedback text-xs">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="max_motorcycle" class="form-label text-xs font-weight-bold text-uppercase">Max Motorcycle</label>
            <input type="number" class="form-control @error('max_motorcycle') is-invalid @enderror" id="max_motorcycle" name="max_motorcycle" value="{{ old('max_motorcycle', 0) }}" min="0" required>
            @error('max_motorcycle')
              <div class="invalid-feedback text-xs">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="max_car" class="form-label text-xs font-weight-bold text-uppercase">Max Car</label>
            <input type="number" class="form-control @error('max_car') is-invalid @enderror" id="max_car" name="max_car" value="{{ old('max_car', 0) }}" min="0" required>
            @error('max_car')
              <div class="invalid-feedback text-xs">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="max_other" class="form-label text-xs font-weight-bold text-uppercase">Max Truck/Dual/Other</label>
            <input type="number" class="form-control @error('max_other') is-invalid @enderror" id="max_other" name="max_other" value="{{ old('max_other', 0) }}" min="0" required>
            @error('max_other')
              <div class="invalid-feedback text-xs">{{ $message }}</div>
            @enderror
          </div>

          <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('location.index') }}" class="btn btn-outline-secondary btn-sm mb-0">CANCEL</a>
            <button type="submit" class="btn bg-gradient-primary btn-sm mb-0" style="background-image: linear-gradient(310deg, #d63384 0%, #a1005c 100%);">SAVE LOCATION</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
