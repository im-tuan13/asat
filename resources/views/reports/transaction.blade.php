@extends('layouts.app')

@section('title', 'Transaction Report')
@section('page_title', 'Transaction Report')

@section('content')
<!-- Filter Section -->
<div class="row mb-4">
  <div class="col-12">
    <div class="card">
      <div class="card-header pb-0">
        <h6>Filter <span class="text-primary">Transactions</span></h6>
      </div>
      <div class="card-body">
        <form method="GET" action="{{ route('report.transaction') }}">
          <div class="row">
            <div class="col-md-2 mb-3">
              <label for="start_date" class="form-label text-xs font-weight-bold text-uppercase">Start Date</label>
              <input type="date" class="form-control form-control-sm" id="start_date" name="start_date" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-2 mb-3">
              <label for="end_date" class="form-label text-xs font-weight-bold text-uppercase">End Date</label>
              <input type="date" class="form-control form-control-sm" id="end_date" name="end_date" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-3 mb-3">
              <label for="id_lokasi" class="form-label text-xs font-weight-bold text-uppercase">Location</label>
              <select class="form-control form-control-sm" id="id_lokasi" name="id_lokasi">
                <option value="">All Locations</option>
                @foreach ($locations as $loc)
                  <option value="{{ $loc->id }}" {{ request('id_lokasi') == $loc->id ? 'selected' : '' }}>
                    {{ $loc->location_name }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="col-md-2 mb-3">
              <label for="id_jenis" class="form-label text-xs font-weight-bold text-uppercase">Vehicle Type</label>
              <select class="form-control form-control-sm" id="id_jenis" name="id_jenis">
                <option value="">All Types</option>
                @foreach ($vehicleTypes as $type)
                  <option value="{{ $type->id }}" {{ request('id_jenis') == $type->id ? 'selected' : '' }}>
                    {{ ucfirst($type->jenis) }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="col-md-3 mb-3">
              <label for="status" class="form-label text-xs font-weight-bold text-uppercase">Status</label>
              <select class="form-control form-control-sm" id="status" name="status">
                <option value="">All Statuses</option>
                <option value="parked" {{ request('status') === 'parked' ? 'selected' : '' }}>Currently Parked</option>
                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Checked Out</option>
              </select>
            </div>
          </div>
          <div class="d-flex justify-content-end gap-2 mt-2">
            <a href="{{ route('report.transaction') }}" class="btn btn-outline-secondary btn-xs mb-0">RESET</a>
            <button type="submit" class="btn bg-gradient-primary btn-xs mb-0">FILTER</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Metrics Cards -->
<div class="row mb-4">
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Transactions</p>
              <h5 class="font-weight-bolder mb-0">
                {{ $totalTransactions }}
              </h5>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
              <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true" style="top: 8px;"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Revenue</p>
              <h5 class="font-weight-bolder mb-0">
                Rp {{ number_format($totalRevenue, 0, ',', '.') }}
              </h5>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-success shadow text-center border-radius-md">
              <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true" style="top: 8px;"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-capitalize font-weight-bold">Currently Parked</p>
              <h5 class="font-weight-bolder mb-0">
                {{ $currentlyParked }}
              </h5>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-warning shadow text-center border-radius-md">
              <i class="ni ni-world text-lg opacity-10" aria-hidden="true" style="top: 8px;"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-capitalize font-weight-bold">Checked Out</p>
              <h5 class="font-weight-bolder mb-0">
                {{ $completedCount }}
              </h5>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
              <i class="ni ni-cart text-lg opacity-10" aria-hidden="true" style="top: 8px;"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Transactions Data Grid -->
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>All <span class="text-primary">Transactions</span></h6>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0 text-xs">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">No.</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Action</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ticket Number</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Police Number</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Location Name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Vehicle Type</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Time In</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Time Out</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">First Hour Charges</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Next Hourly Charges</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Max Cost Per Day</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Total Hours</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Total Days</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Total Payment</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($transactions as $index => $tx)
                @php
                  $totalDays = $tx->total_jam > 24 ? (int) floor($tx->total_jam / 24) : 0;
                @endphp
                <tr>
                  <td class="align-middle text-center font-weight-bold text-secondary">
                    {{ $index + 1 }}
                  </td>
                  <td class="align-middle text-center">
                    <a href="{{ route('transaction.ticket', $tx->id) }}" target="_blank" class="text-secondary font-weight-bold text-xxs me-2">
                      <i class="fas fa-file-pdf text-danger me-1"></i> PDF
                    </a>
                  </td>
                  <td>
                    <span class="font-weight-bold text-dark">{{ $tx->no_tiket }}</span>
                  </td>
                  <td>
                    <span class="font-weight-bold">{{ $tx->no_polisi ?? '-' }}</span>
                  </td>
                  <td>
                    <span>{{ $tx->location->location_name }}</span>
                  </td>
                  <td>
                    <span>{{ ucfirst($tx->vehicleType->jenis) }}</span>
                  </td>
                  <td class="align-middle text-center text-secondary">
                    {{ $tx->masuk->format('Y-m-d H:i:s') }}
                  </td>
                  <td class="align-middle text-center text-secondary">
                    {{ $tx->keluar ? $tx->keluar->format('Y-m-d H:i:s') : '-' }}
                  </td>
                  <td class="align-middle text-center">
                    Rp {{ number_format($tx->perjam_pertama, 0, ',', '.') }}
                  </td>
                  <td class="align-middle text-center">
                    Rp {{ number_format($tx->perjam_berikutnya, 0, ',', '.') }}
                  </td>
                  <td class="align-middle text-center">
                    Rp {{ number_format($tx->max_perhari, 0, ',', '.') }}
                  </td>
                  <td class="align-middle text-center font-weight-bold">
                    {{ $tx->total_jam ?? '-' }}
                  </td>
                  <td class="align-middle text-center">
                    {{ $totalDays }}
                  </td>
                  <td class="align-middle text-center font-weight-bold text-success">
                    @if($tx->total_bayar !== null)
                      Rp {{ number_format($tx->total_bayar, 0, ',', '.') }}
                    @else
                      -
                    @endif
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="14" class="text-center py-4">
                    <span class="text-secondary text-xs font-weight-bold">No transaction data matched the filters.</span>
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
