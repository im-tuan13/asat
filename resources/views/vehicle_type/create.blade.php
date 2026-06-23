@extends('layouts.app')

@section('title', 'Add Vehicle Type')
@section('page_title', 'Vehicle Type')

@section('content')
<div class="row justify-content-center">
  <div class="col-lg-8 col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>Vehicle Type <span class="text-primary">Input Form</span></h6>
      </div>
      <div class="card-body">
        <form action="{{ route('vehicle-type.store') }}" method="POST">
          @csrf
          
          <div class="mb-3">
            <label for="jenis" class="form-label text-xs font-weight-bold text-uppercase">Vehicle Type</label>
            <select class="form-control @error('jenis') is-invalid @enderror" id="jenis" name="jenis" required>
              <option value="">-- Select Type --</option>
              <option value="motorcycle" {{ old('jenis') == 'motorcycle' ? 'selected' : '' }}>Motorcycle</option>
              <option value="car" {{ old('jenis') == 'car' ? 'selected' : '' }}>Car</option>
              <option value="other" {{ old('jenis') == 'other' ? 'selected' : '' }}>Other</option>
            </select>
            @error('jenis')
              <div class="invalid-feedback text-xs">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="perjam_pertama" class="form-label text-xs font-weight-bold text-uppercase">First Hour Charges</label>
            <input type="number" class="form-control @error('perjam_pertama') is-invalid @enderror" id="perjam_pertama" name="perjam_pertama" value="{{ old('perjam_pertama', 0) }}" min="0" required>
            @error('perjam_pertama')
              <div class="invalid-feedback text-xs">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="perjam_berikutnya" class="form-label text-xs font-weight-bold text-uppercase">Next Hourly Charges</label>
            <input type="number" class="form-control @error('perjam_berikutnya') is-invalid @enderror" id="perjam_berikutnya" name="perjam_berikutnya" value="{{ old('perjam_berikutnya', 0) }}" min="0" required>
            @error('perjam_berikutnya')
              <div class="invalid-feedback text-xs">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="max_perhari" class="form-label text-xs font-weight-bold text-uppercase">Max Cost Per Day</label>
            <input type="number" class="form-control @error('max_perhari') is-invalid @enderror" id="max_perhari" name="max_perhari" value="{{ old('max_perhari', 0) }}" min="0" required>
            @error('max_perhari')
              <div class="invalid-feedback text-xs">{{ $message }}</div>
            @enderror
          </div>

          <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('vehicle-type.index') }}" class="btn btn-outline-secondary btn-sm mb-0">CANCEL</a>
            <button type="submit" class="btn bg-gradient-primary btn-sm mb-0" style="background-image: linear-gradient(310deg, #d63384 0%, #a1005c 100%);">SAVE VEHICLE TYPE</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
