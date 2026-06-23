@extends('layouts.app')

@section('title', 'Location')
@section('page_title', 'Location')

@section('header_actions')
<li class="nav-item d-flex align-items-center">
  <a href="{{ route('location.create') }}" class="btn btn-sm bg-gradient-primary mb-0 me-3 d-flex align-items-center">
    <i class="fas fa-plus me-1"></i> ADD NEW LOCATION
  </a>
</li>
@endsection

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0 d-flex justify-content-between align-items-center">
        <h6>Location <span class="text-primary">Data Table</span></h6>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">No.</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Location Name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Max Motorcycle</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Max Car</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Max Truck/Bus/Other</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($locations as $index => $location)
                <tr>
                  <td class="align-middle text-center text-sm">
                    <span class="text-secondary text-xs font-weight-bold">{{ $index + 1 }}</span>
                  </td>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">{{ $location->location_name }}</h6>
                      </div>
                    </div>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-secondary text-xs font-weight-bold">{{ $location->max_motorcycle }}</span>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-secondary text-xs font-weight-bold">{{ $location->max_car }}</span>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-secondary text-xs font-weight-bold">{{ $location->max_other }}</span>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <div class="d-flex justify-content-center gap-2">
                      <a href="{{ route('location.edit', $location->id) }}" class="btn btn-sm btn-outline-primary mb-0" title="Edit Location">
                        <i class="fas fa-edit"></i>
                      </a>
                      <form action="{{ route('location.destroy', $location->id) }}" method="POST" onsubmit="return confirm('Hapus lokasi ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger mb-0" title="Delete Location">
                          <i class="fas fa-trash"></i>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="text-center py-4">
                    <span class="text-secondary text-xs font-weight-bold">No locations found.</span>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@if(session('success'))
<script>
  window.addEventListener('load', function() {
    Swal.fire({
      title: 'Good Job',
      text: "{{ session('success') }}",
      icon: 'success',
      confirmButtonText: 'OK',
      customClass: {
        confirmButton: 'btn bg-gradient-primary'
      },
      buttonsStyling: false
    });
  });
</script>
@endif
@endsection
