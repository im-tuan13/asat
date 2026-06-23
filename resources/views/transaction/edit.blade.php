@extends('layouts.app')

@section('title', 'Edit Transaction')
@section('page_title', 'Edit Transaction')

@section('content')
<div class="row justify-content-center">
  <div class="col-lg-8">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>Edit Transaction</h6>
      </div>
      <div class="card-body px-4 py-3">
        <form action="{{ route('transaction.update', $transaction->id) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label for="no_tiket" class="form-label">Ticket Number</label>
            <input type="text" class="form-control" id="no_tiket" value="{{ $transaction->no_tiket }}" disabled>
          </div>

          <div class="mb-3">
            <label for="id_lokasi" class="form-label">Location</label>
            <select class="form-select" id="id_lokasi" name="id_lokasi" required>
              @foreach($locations as $location)
                <option value="{{ $location->id }}" {{ $transaction->id_lokasi == $location->id ? 'selected' : '' }}>{{ $location->location_name }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="id_jenis" class="form-label">Vehicle Type</label>
            <select class="form-select" id="id_jenis" name="id_jenis" required>
              @foreach($vehicleTypes as $type)
                <option value="{{ $type->id }}" {{ $transaction->id_jenis == $type->id ? 'selected' : '' }}>{{ ucfirst($type->jenis) }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="no_polisi" class="form-label">Police Number</label>
            <input type="text" class="form-control" id="no_polisi" name="no_polisi" value="{{ old('no_polisi', $transaction->no_polisi) }}" required>
          </div>

          <div class="d-flex justify-content-between align-items-center mt-4">
            <a href="{{ route('transaction.index') }}" class="btn btn-outline-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection