@extends('layouts.app')

@section('title', 'Location Report')
@section('page_title', 'Location Report')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>Location <span class="text-primary">Occupancy & Revenue Summary</span></h6>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">No.</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Location Name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Capacity (Motor / Car / Other)</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Active Parked (Motor / Car / Other)</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Total Transactions</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Total Revenue</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($reportData as $index => $row)
                <tr>
                  <td class="align-middle text-center text-sm">
                    <span class="text-secondary text-xs font-weight-bold">{{ $index + 1 }}</span>
                  </td>
                  <td>
                    <h6 class="mb-0 text-sm ps-2">{{ $row->location_name }}</h6>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-secondary text-xs font-weight-bold">
                      {{ $row->max_motorcycle }} / {{ $row->max_car }} / {{ $row->max_other }}
                    </span>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-secondary text-xs font-weight-bold">
                      {{ $row->active_motorcycle }} / {{ $row->active_car }} / {{ $row->active_other }}
                    </span>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-secondary text-xs font-weight-bold">{{ $row->total_transactions }}</span>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-success text-xs font-weight-bold">Rp {{ number_format($row->total_revenue, 0, ',', '.') }}</span>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="text-center py-4">
                    <span class="text-secondary text-xs font-weight-bold">No location data available.</span>
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
@endsection
