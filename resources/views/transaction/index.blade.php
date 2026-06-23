@extends('layouts.app')

@section('title', 'Transaction')
@section('page_title', 'Transaction')

@section('header_actions')
  {{-- Vehicle Type + Enter Vehicle Form moved to navbar --}}
  <form action="{{ route('transaction.enter') }}" method="POST" id="enter-form" class="d-flex align-items-center gap-2 flex-wrap">
    @csrf
    <input type="hidden" name="id_lokasi" id="selected_id_lokasi" value="">
    <input type="hidden" name="id_jenis" id="selected_id_jenis" value="">
    <div class="d-flex align-items-center gap-2">
      @foreach($vehicleTypes as $type)
        <button type="button"
          class="btn btn-sm bg-white text-dark shadow-sm rounded-pill px-3 py-2 type-btn"
          data-id="{{ $type->id }}"
          id="type-btn-{{ $type->id }}"
          style="font-weight:700; letter-spacing:0.4px; border: 1px solid #e9ecef;">
          {{ strtoupper($type->jenis) }}
        </button>
      @endforeach
    </div>
    <button type="submit" class="btn btn-sm bg-gradient-danger text-white shadow-sm rounded-pill px-4 py-2"
      id="enter-btn"
      style="font-weight:700; letter-spacing:0.4px; border:none;">
      <i class="fas fa-plus me-1"></i> ENTER VEHICLE
    </button>
  </form>
@endsection

@section('content')

{{-- =========================================================
     ROW 1: Clock Card | Location Cards | Tickets Panel
     ========================================================= --}}
<div class="d-flex flex-wrap gap-3 mb-4 align-items-stretch" id="top-dashboard-row">

  {{-- ---- CLOCK CARD ---- --}}
  <div class="flex-shrink-0" style="width: 220px; min-width: 200px;">
    <div class="card h-100 overflow-hidden position-relative shadow" style="min-height: 160px; border-radius: 1rem;">
      {{-- Background curved image --}}
      <div class="position-absolute w-100 h-100" style="top:0;left:0;z-index:0;">
        <img src="{{ asset('assets/img/curved-images/curved-8.jpg') }}"
             class="w-100 h-100" style="object-fit:cover; opacity:0.85;" alt="bg">
        <div class="position-absolute w-100 h-100" style="top:0;left:0;background:linear-gradient(160deg,rgba(20,20,60,0.82) 0%,rgba(40,0,80,0.72) 100%);"></div>
      </div>
      {{-- Parking tower image top-right --}}
      <img src="{{ asset('assets/img/parkir.png') }}"
           alt="Parking Tower"
           class="position-absolute"
           style="width:90px;top:8px;right:6px;z-index:1;filter:drop-shadow(0 2px 8px rgba(0,0,0,0.35));opacity:0.9;">
      {{-- Text --}}
      <div class="card-body position-relative d-flex flex-column justify-content-end p-3" style="z-index:2;">
        <h6 class="text-white font-weight-bolder mb-0" id="clock-day" style="font-size:1rem;">Monday</h6>
        <p class="mb-2 text-white" id="clock-date" style="font-size:0.72rem;opacity:0.8;">8 June 2026</p>
        {{-- Segmented clock display --}}
        <div class="d-flex align-items-center" id="clock-display">
          <span class="clock-seg text-white font-weight-bolder" id="clock-hh" style="font-size:1.35rem;letter-spacing:1px;line-height:1;">00</span>
          <span class="clock-colon" style="font-size:1.35rem;font-weight:900;color:#ff0080;margin:0 2px;line-height:1;">:</span>
          <span class="clock-seg text-white font-weight-bolder" id="clock-mm" style="font-size:1.35rem;letter-spacing:1px;line-height:1;">00</span>
          <span class="clock-colon" style="font-size:1.35rem;font-weight:900;color:#ff0080;margin:0 2px;line-height:1;">:</span>
          <span class="clock-seg text-white font-weight-bolder" id="clock-ss" style="font-size:1.35rem;letter-spacing:1px;line-height:1;">00</span>
        </div>
      </div>
    </div>
  </div>

  {{-- ---- LOCATION CARDS ---- --}}
  @foreach($locations as $location)
  @php
    $activeMotorcycle = $location->activeTransactionsCount('motorcycle');
    $activeCar = $location->activeTransactionsCount('car');
    $activeOther = $location->activeTransactionsCount('other');
    $availableMotorcycle = $location->availableSpots('motorcycle');
    $availableCar = $location->availableSpots('car');
    $availableOther = $location->availableSpots('other');
  @endphp
  <div class="flex-shrink-0" style="width: 210px; min-width: 190px;">
    <div class="card h-100 shadow-sm location-card"
         data-id="{{ $location->id }}"
         id="loc-card-{{ $location->id }}"
         style="border: 1.5px solid #e9ecef; border-radius: 1.4rem; transition: border-color 0.2s, box-shadow 0.2s;">
      <div class="card-body p-3 d-flex flex-column justify-content-between" style="min-height: 225px;">
        <div>
          <div class="d-flex justify-content-between align-items-start mb-3">
            <div class="d-flex align-items-center justify-content-center"
                 style="width:58px;height:58px;border-radius:1rem;background:linear-gradient(310deg,#d63384,#a1005c);box-shadow:0 10px 25px rgba(214,51,132,0.18);">
              <i class="fas fa-building text-white" style="font-size:1.1rem;"></i>
            </div>
            <div class="d-flex gap-2">
              <a href="{{ route('location.edit', $location->id) }}" class="btn btn-sm btn-outline-primary p-1" title="Edit Gedung {{ $location->location_name }}" onclick="event.stopPropagation();">
                <i class="fas fa-edit" style="font-size:0.82rem;"></i>
              </a>
              <form action="{{ route('location.destroy', $location->id) }}" method="POST" onsubmit="event.stopPropagation(); return confirm('Hapus Gedung {{ $location->location_name }}?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger p-1" title="Delete Gedung {{ $location->location_name }}" onclick="event.stopPropagation();">
                  <i class="fas fa-trash" style="font-size:0.82rem;"></i>
                </button>
              </form>
            </div>
          </div>

          <div class="text-center mb-3">
            <h6 class="mb-1 font-weight-bolder text-dark" style="font-size:0.95rem;">{{ $location->location_name }}</h6>
          </div>

          <div class="d-flex justify-content-between align-items-center mb-3 text-secondary" style="font-size:0.78rem;">
            <div class="text-center" style="min-width:55px;">
              <i class="fas fa-motorcycle mb-1 d-block"></i>
              <span>{{ $location->max_motorcycle ?? 0 }}</span>
            </div>
            <div class="text-center" style="min-width:55px;">
              <i class="fas fa-car mb-1 d-block"></i>
              <span>{{ $location->max_car ?? 0 }}</span>
            </div>
            <div class="text-center" style="min-width:55px;">
              <i class="fas fa-truck mb-1 d-block"></i>
              <span>{{ $location->max_other ?? 0 }}</span>
            </div>
          </div>
        </div>

        <div class="d-flex justify-content-between align-items-center pt-3" style="border-top:1px solid #f4f4f7;">
          <div class="text-center" style="min-width:55px;">
            <i class="fas fa-motorcycle {{ $availableMotorcycle > 0 ? 'text-success' : 'text-danger' }}" style="font-size:0.88rem;"></i>
            <div class="font-weight-bolder text-dark" style="font-size:0.86rem;">{{ $availableMotorcycle }}</div>
          </div>
          <div class="text-center" style="min-width:55px;">
            <i class="fas fa-car {{ $availableCar > 0 ? 'text-success' : 'text-danger' }}" style="font-size:0.88rem;"></i>
            <div class="font-weight-bolder text-dark" style="font-size:0.86rem;">{{ $availableCar }}</div>
          </div>
          <div class="text-center" style="min-width:55px;">
            <i class="fas fa-truck {{ $availableOther > 0 ? 'text-success' : 'text-danger' }}" style="font-size:0.88rem;"></i>
            <div class="font-weight-bolder text-dark" style="font-size:0.86rem;">{{ $availableOther }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach

  {{-- ---- TICKETS PANEL ---- --}}
  <div class="flex-grow-1" style="min-width: 220px;">
    <div class="card h-100 shadow-sm" style="border-radius:1rem; border: 1.5px solid #e9ecef; max-height: 240px; overflow-y: auto;">
      <div class="card-header pb-0 d-flex justify-content-between align-items-center bg-white sticky-top" style="border-bottom:1px solid #f0f0f0; border-radius:1rem 1rem 0 0; z-index:2;">
        <h6 class="mb-0 font-weight-bolder text-dark" style="font-size:0.9rem;">Tickets</h6>
        <button type="button" id="viewAllTicketsBtn"
           class="btn btn-sm mb-0 font-weight-bold"
           style="border: 1.5px solid #d63384; color: #d63384; background: transparent; font-size: 0.72rem; padding: 0.2rem 0.7rem; border-radius: 0.5rem; letter-spacing:0.5px;"
           data-bs-toggle="modal" data-bs-target="#allTicketsModal">VIEW ALL</button>
      </div>
      <div class="card-body p-2">
        @forelse($activeTickets as $ticket)
          <div class="d-flex justify-content-between align-items-center ticket-item cursor-pointer p-2 mb-1"
               data-no-tiket="{{ $ticket->no_tiket }}"
               data-no-polisi="{{ $ticket->no_polisi }}"
               data-location="{{ $ticket->location->location_name ?? '-' }}"
               data-vehicle-type="{{ $ticket->vehicleType->jenis ?? '-' }}"
               data-entry-time="{{ $ticket->masuk->format('Y-m-d H:i:s') }}"
               data-ticket-id="{{ $ticket->id }}"
               style="border-radius: 0.6rem; border: 1px solid #f0f0f0; transition: background 0.15s;">
            <div>
              <div class="font-weight-bold text-dark" style="font-size: 0.75rem;">{{ $ticket->masuk->format('Y-m-d H:i:s') }}</div>
              <div class="text-secondary" style="font-size:0.7rem;">#{{ $ticket->no_tiket }}</div>
            </div>
            <a href="{{ route('transaction.ticket', $ticket->id) }}" target="_blank"
               class="d-flex flex-column align-items-center text-decoration-none ms-2"
               style="min-width:32px;">
              <i class="fas fa-file-pdf text-danger" style="font-size:1rem;"></i>
              <span style="font-size:0.62rem; color:#888; font-weight:700;">PDF</span>
            </a>
          </div>
        @empty
          <div class="text-center py-3">
            <img src="{{ asset('assets/img/parkir.png') }}" alt="No tickets" style="max-height:70px;opacity:0.55;margin-bottom:6px;" class="img-fluid d-block mx-auto">
            <p class="text-xs text-secondary mb-0 font-weight-bold">No active vehicles parked.</p>
          </div>
        @endforelse
      </div>
    </div>
  </div>

</div>{{-- end row 1 --}}


{{-- =========================================================
     ROW 2: Transaction Input Form (Check-out)
     ========================================================= --}}
<div class="card shadow-sm mb-4" style="border-radius:1rem; border:1.5px solid #e9ecef;">
  <div class="card-body p-4">
    <h6 class="mb-3" style="font-size:1rem;">
      <span style="color:#344767; font-weight:700;">Transaction</span>
      <span style="color:#d63384; font-weight:700;"> Input Form</span>
    </h6>
    <form action="{{ route('transaction.exit') }}" method="POST">
      @csrf
      <div class="row g-3 align-items-end">
        <div class="col-md-5">
          <label for="no_tiket" class="form-label text-xs font-weight-bold text-uppercase text-muted mb-1">Ticket Number</label>
          <input type="text" class="form-control" id="no_tiket" name="no_tiket"
                 value="{{ old('no_tiket') }}" placeholder="Ticket Number" required
                 style="border: 1.5px solid #d63384; border-radius: 0.6rem; font-size:0.88rem; padding: 0.55rem 0.85rem;">
        </div>
        <div class="col-md-5">
          <label for="no_polisi" class="form-label text-xs font-weight-bold text-uppercase text-muted mb-1">Police Number</label>
          <input type="text" class="form-control" id="no_polisi" name="no_polisi"
                 value="{{ old('no_polisi') }}" placeholder="Police Number" required
                 style="border: 1.5px solid #dee2e6; border-radius: 0.6rem; font-size:0.88rem; padding: 0.55rem 0.85rem;">
        </div>
        <div class="col-md-2 d-flex justify-content-end">
          <button type="submit" class="btn w-100 mb-0"
                  style="background:linear-gradient(310deg,#344767,#52607a); color:#fff; font-weight:700; border:none; border-radius:0.6rem; font-size:0.82rem; padding:0.55rem 0.85rem; letter-spacing:0.4px;">
            <i class="fas fa-sign-out-alt me-1"></i> EXIT VEHICLE
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

{{-- =========================================================
     MODAL: All Tickets Details
     ========================================================= --}}
<div class="modal fade" id="allTicketsModal" tabindex="-1" aria-labelledby="allTicketsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="border-radius: 1rem;">
      <div class="modal-header" style="background: linear-gradient(310deg,#d63384,#a1005c); border-radius: 1rem 1rem 0 0; border: none;">
        <h5 class="modal-title text-white font-weight-bolder" id="allTicketsModalLabel" style="font-size: 1.1rem;">
          <i class="fas fa-ticket-alt me-2"></i>All Transactions
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        <div class="table-responsive">
          <table class="table table-hover mb-0" style="border-collapse: collapse;">
            <thead class="bg-gray-100">
              <tr>
                <th class="text-xs font-weight-bolder text-uppercase text-secondary opacity-7 ps-3" style="padding-top: 0.75rem; padding-bottom: 0.75rem;">No.</th>
                <th class="text-xs font-weight-bolder text-uppercase text-secondary opacity-7" style="padding-top: 0.75rem; padding-bottom: 0.75rem;">Action</th>
                <th class="text-xs font-weight-bolder text-uppercase text-secondary opacity-7" style="padding-top: 0.75rem; padding-bottom: 0.75rem;">Ticket No</th>
                <th class="text-xs font-weight-bolder text-uppercase text-secondary opacity-7" style="padding-top: 0.75rem; padding-bottom: 0.75rem;">Police No</th>
                <th class="text-xs font-weight-bolder text-uppercase text-secondary opacity-7" style="padding-top: 0.75rem; padding-bottom: 0.75rem;">Location</th>
                <th class="text-xs font-weight-bolder text-uppercase text-secondary opacity-7" style="padding-top: 0.75rem; padding-bottom: 0.75rem;">Vehicle Type</th>
                <th class="text-xs font-weight-bolder text-uppercase text-secondary opacity-7 text-center" style="padding-top: 0.75rem; padding-bottom: 0.75rem;">Time In</th>
                <th class="text-xs font-weight-bolder text-uppercase text-secondary opacity-7 text-center" style="padding-top: 0.75rem; padding-bottom: 0.75rem;">Time Out</th>
                <th class="text-xs font-weight-bolder text-uppercase text-secondary opacity-7 text-center" style="padding-top: 0.75rem; padding-bottom: 0.75rem;">First Hour Charges</th>
                <th class="text-xs font-weight-bolder text-uppercase text-secondary opacity-7 text-center" style="padding-top: 0.75rem; padding-bottom: 0.75rem;">Next Hourly Charges</th>
                <th class="text-xs font-weight-bolder text-uppercase text-secondary opacity-7 text-center" style="padding-top: 0.75rem; padding-bottom: 0.75rem;">Max Cost Per Day</th>
                <th class="text-xs font-weight-bolder text-uppercase text-secondary opacity-7 text-center" style="padding-top: 0.75rem; padding-bottom: 0.75rem;">Total Hours</th>
                <th class="text-xs font-weight-bolder text-uppercase text-secondary opacity-7 text-center" style="padding-top: 0.75rem; padding-bottom: 0.75rem;">Total Days</th>
                <th class="text-xs font-weight-bolder text-uppercase text-secondary opacity-7 text-center" style="padding-top: 0.75rem; padding-bottom: 0.75rem;">Total Pays</th>
              </tr>
            </thead>
            <tbody>
              @forelse($transactions as $index => $tx)
                @php
                  $totalDays = $tx->total_jam ? (int) floor($tx->total_jam / 24) : 0;
                @endphp
                <tr>
                  <td class="text-sm font-weight-bold text-dark ps-3" style="padding-top: 0.75rem; padding-bottom: 0.75rem;">{{ $index + 1 }}</td>
                  <td class="text-sm text-center" style="padding-top: 0.75rem; padding-bottom: 0.75rem;">
                    <div class="d-flex justify-content-center gap-2">
                      <a href="{{ route('transaction.edit', $tx->id) }}" class="btn btn-sm btn-outline-primary mb-0" title="Edit Transaction">
                        <i class="fas fa-edit"></i>
                      </a>
                      <form action="{{ route('transaction.destroy', $tx->id) }}" method="POST" onsubmit="return confirm('Hapus transaksi ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger mb-0" title="Delete Transaction">
                          <i class="fas fa-trash"></i>
                        </button>
                      </form>
                      <a href="{{ route('transaction.ticket', $tx->id) }}" target="_blank" class="btn btn-sm btn-outline-danger mb-0" title="View PDF">
                        <i class="fas fa-file-pdf"></i> PDF
                      </a>
                    </div>
                  </td>
                  <td class="text-sm text-dark" style="padding-top: 0.75rem; padding-bottom: 0.75rem;">{{ $tx->no_tiket }}</td>
                  <td class="text-sm text-dark" style="padding-top: 0.75rem; padding-bottom: 0.75rem;">{{ $tx->no_polisi ?? '-' }}</td>
                  <td class="text-sm text-dark" style="padding-top: 0.75rem; padding-bottom: 0.75rem;">{{ $tx->location->location_name ?? '-' }}</td>
                  <td class="text-sm text-dark" style="padding-top: 0.75rem; padding-bottom: 0.75rem;">{{ ucfirst($tx->vehicleType->jenis ?? '') }}</td>
                  <td class="text-sm text-center text-secondary" style="padding-top: 0.75rem; padding-bottom: 0.75rem;">{{ $tx->masuk->format('Y-m-d H:i:s') }}</td>
                  <td class="text-sm text-center text-secondary" style="padding-top: 0.75rem; padding-bottom: 0.75rem;">{{ $tx->keluar ? $tx->keluar->format('Y-m-d H:i:s') : '-' }}</td>
                  <td class="text-sm text-center text-dark" style="padding-top: 0.75rem; padding-bottom: 0.75rem;">Rp {{ number_format($tx->perjam_pertama, 0, ',', '.') }}</td>
                  <td class="text-sm text-center text-dark" style="padding-top: 0.75rem; padding-bottom: 0.75rem;">Rp {{ number_format($tx->perjam_berikutnya, 0, ',', '.') }}</td>
                  <td class="text-sm text-center text-dark" style="padding-top: 0.75rem; padding-bottom: 0.75rem;">Rp {{ number_format($tx->max_perhari, 0, ',', '.') }}</td>
                  <td class="text-sm text-center font-weight-bold" style="padding-top: 0.75rem; padding-bottom: 0.75rem;">{{ $tx->total_jam ?? '-' }}</td>
                  <td class="text-sm text-center" style="padding-top: 0.75rem; padding-bottom: 0.75rem;">{{ $totalDays }}</td>
                  <td class="text-sm text-center font-weight-bold text-success" style="padding-top: 0.75rem; padding-bottom: 0.75rem;">@if($tx->total_bayar !== null) Rp {{ number_format($tx->total_bayar, 0, ',', '.') }} @else - @endif</td>
                </tr>
              @empty
                <tr>
                  <td colspan="14" class="text-center py-5">
                    <span class="text-secondary text-xs font-weight-bold">No transaction records available.</span>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer" style="border-top: 1px solid #e9ecef;">
        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<style>
  /* Smooth type button active state */
  .type-btn.active-type {
    background: linear-gradient(310deg,#7928ca,#ff0080) !important;
    color: #fff !important;
    border-color: transparent !important;
    box-shadow: 0 8px 20px rgba(121,40,202,0.2) !important;
  }
  /* Location card hover */
  .location-card:hover {
    box-shadow: 0 4px 20px rgba(214,51,132,0.15) !important;
    cursor: pointer;
  }
  .location-card.selected-loc {
    border-color: #d63384 !important;
    border-width: 2px !important;
    box-shadow: 0 4px 20px rgba(214,51,132,0.2) !important;
  }
  /* Ticket item hover */
  .ticket-item:hover {
    background: #fdf0f6 !important;
  }
  /* Clock colon blink animation */
  @keyframes colonBlink {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.3; }
  }
  .clock-colon { animation: colonBlink 1s step-start infinite; }
</style>

<script>
  // =====================
  // 1. Dynamic Clock
  // =====================
  function updateClock() {
    const now = new Date();
    const days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
    const months = ['January','February','March','April','May','June','July','August','September','October','November','December'];

    document.getElementById('clock-day').textContent  = days[now.getDay()];
    document.getElementById('clock-date').textContent = now.getDate() + ' ' + months[now.getMonth()] + ' ' + now.getFullYear();
    document.getElementById('clock-hh').textContent   = String(now.getHours()).padStart(2,'0');
    document.getElementById('clock-mm').textContent   = String(now.getMinutes()).padStart(2,'0');
    document.getElementById('clock-ss').textContent   = String(now.getSeconds()).padStart(2,'0');
  }
  setInterval(updateClock, 1000);
  updateClock();

  // =====================
  // 2. Selection Logic
  // =====================
  let selectedLocationId = null;
  let selectedTypeId     = null;

  // Location card selection
  document.querySelectorAll('.location-card').forEach(card => {
    card.addEventListener('click', function () {
      document.querySelectorAll('.location-card').forEach(c => c.classList.remove('selected-loc'));
      const id = this.getAttribute('data-id');
      if (selectedLocationId === id) {
        selectedLocationId = null;
        document.getElementById('selected_id_lokasi').value = '';
      } else {
        selectedLocationId = id;
        document.getElementById('selected_id_lokasi').value = id;
        this.classList.add('selected-loc');
      }
    });
  });

  // Vehicle type button selection
  document.querySelectorAll('.type-btn').forEach(btn => {
    btn.addEventListener('click', function () {
      document.querySelectorAll('.type-btn').forEach(b => b.classList.remove('active-type'));
      const id = this.getAttribute('data-id');
      if (selectedTypeId === id) {
        selectedTypeId = null;
        document.getElementById('selected_id_jenis').value = '';
      } else {
        selectedTypeId = id;
        document.getElementById('selected_id_jenis').value = id;
        this.classList.add('active-type');
      }
    });
  });

  // Enter form validation
  document.getElementById('enter-form').addEventListener('submit', function (e) {
    if (!selectedLocationId) {
      e.preventDefault();
      Swal.fire({ title: 'Selection Required', text: 'Please select a parking location card first!', icon: 'warning', confirmButtonText: 'OK', customClass: { confirmButton: 'btn bg-gradient-warning' }, buttonsStyling: false });
      return false;
    }
    if (!selectedTypeId) {
      e.preventDefault();
      Swal.fire({ title: 'Selection Required', text: 'Please select a vehicle type first!', icon: 'warning', confirmButtonText: 'OK', customClass: { confirmButton: 'btn bg-gradient-warning' }, buttonsStyling: false });
      return false;
    }
  });

  // =====================
  // 4. Ticket Autofill
  // =====================
  document.querySelectorAll('.ticket-item').forEach(item => {
    item.addEventListener('click', function (e) {
      if (e.target.closest('a')) return;
      document.getElementById('no_tiket').value = this.getAttribute('data-no-tiket');
      document.getElementById('no_polisi').focus();
    });
  });

  // =====================
  // 4. Session Handlers
  // =====================
  @if(session('printed_ticket_id'))
    window.open("{{ route('transaction.ticket', session('printed_ticket_id')) }}", "_blank");
  @endif

  @if(session('checkout_success'))
    window.addEventListener('load', function () {
      const details = @json(session('checkout_success'));
      Swal.fire({
        title: 'Total Bayar : Rp ' + details.total_bayar,
        html: `
          <div class="text-start mt-3 p-3 bg-gray-100 border-radius-md" style="font-size:13px;">
            <p class="mb-1 text-dark"><strong>Ticket No:</strong> ${details.no_tiket}</p>
            <p class="mb-1 text-dark"><strong>Police No:</strong> ${details.no_polisi}</p>
            <p class="mb-1 text-dark"><strong>Location:</strong> ${details.location}</p>
            <p class="mb-1 text-dark"><strong>Vehicle Type:</strong> ${details.jenis}</p>
            <p class="mb-1 text-dark"><strong>Entry:</strong> ${details.masuk}</p>
            <p class="mb-1 text-dark"><strong>Exit:</strong> ${details.keluar}</p>
            <p class="mb-1 text-dark"><strong>Duration:</strong> ${details.total_jam} Hour(s)</p>
          </div>`,
        icon: 'success',
        confirmButtonText: 'OK',
        customClass: { confirmButton: 'btn bg-gradient-primary px-4' },
        buttonsStyling: false
      });
    });
  @endif
</script>
@endsection
