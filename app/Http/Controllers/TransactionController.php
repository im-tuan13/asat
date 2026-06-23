<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\VehicleType;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;

class TransactionController extends Controller
{
    /**
     * Display the main transaction dashboard.
     */
    public function index()
    {
        $locations = Location::all();
        $vehicleTypes = VehicleType::all();
        $activeTickets = Transaction::whereNull('keluar')
            ->with(['location', 'vehicleType'])
            ->orderBy('masuk', 'desc')
            ->get();

        $transactions = Transaction::with(['location', 'vehicleType'])
            ->orderBy('masuk', 'desc')
            ->get();

        return view('transaction.index', compact('locations', 'activeTickets', 'vehicleTypes', 'transactions'));
    }

    /**
     * Handle check-in of a vehicle (Ambil Tiket).
     */
    public function enter(Request $request)
    {
        $request->validate([
            'id_lokasi' => 'required|exists:locations,id',
            'id_jenis' => 'required|exists:vehicle_types,id',
        ]);

        $location = Location::findOrFail($request->id_lokasi);
        $vehicleType = VehicleType::findOrFail($request->id_jenis);

        if ($location->availableSpots($vehicleType->jenis) <= 0) {
            return redirect()->back()->with('error', 'Location ' . $location->location_name . ' is full for ' . ucfirst($vehicleType->jenis) . '!');
        }

        $noTiket = date('Ymdis');

        $transaction = Transaction::create([
            'id_lokasi' => $request->id_lokasi,
            'id_jenis' => $request->id_jenis,
            'no_tiket' => $noTiket,
            'masuk' => now(),
            'perjam_pertama' => $vehicleType->perjam_pertama,
            'perjam_berikutnya' => $vehicleType->perjam_berikutnya,
            'max_perhari' => $vehicleType->max_perhari,
        ]);

        return redirect()->route('transaction.index')
            ->with('success', 'Ticket successfully created!')
            ->with('printed_ticket_id', $transaction->id);
    }

    /**
     * Handle check-out of a vehicle (Exit Vehicle).
     */
    public function exit(Request $request)
    {
        $request->validate([
            'no_tiket' => 'required|string',
            'no_polisi' => 'required|string|max:15',
        ]);

        $transaction = Transaction::where('no_tiket', $request->no_tiket)
            ->whereNull('keluar')
            ->first();

        if (!$transaction) {
            return redirect()->back()->withInput()->with('error', 'Active vehicle with Ticket Number: ' . $request->no_tiket . ' not found!');
        }

        $keluar = now();
        $masuk = $transaction->masuk;

        $diffInSeconds = $keluar->diffInSeconds($masuk);
        $diffInMinutes = (int) ceil($diffInSeconds / 60);
        $totalJam = $diffInMinutes <= 0 ? 1 : $diffInMinutes;

        $totalBayar = Transaction::calculateFee(
            $totalJam,
            $transaction->perjam_pertama,
            $transaction->perjam_berikutnya,
            $transaction->max_perhari
        );

        $transaction->update([
            'no_polisi' => strtoupper($request->no_polisi),
            'keluar' => $keluar,
            'total_jam' => $totalJam,
            'total_bayar' => $totalBayar,
        ]);

        return redirect()->route('transaction.index')->with('checkout_success', [
            'no_tiket' => $transaction->no_tiket,
            'no_polisi' => $transaction->no_polisi,
            'location' => $transaction->location->location_name,
            'jenis' => ucfirst($transaction->vehicleType->jenis),
            'masuk' => $transaction->masuk->format('Y-m-d H:i:s'),
            'keluar' => $transaction->keluar->format('Y-m-d H:i:s'),
            'total_jam' => $transaction->total_jam,
            'total_bayar' => number_format($transaction->total_bayar, 0, ',', '.'),
        ]);
    }

    /**
     * Show the form for editing the specified transaction.
     */
    public function edit($id)
    {
        $transaction = Transaction::with(['location', 'vehicleType'])->findOrFail($id);
        $locations = Location::all();
        $vehicleTypes = VehicleType::all();

        return view('transaction.edit', compact('transaction', 'locations', 'vehicleTypes'));
    }

    /**
     * Update the specified transaction in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_lokasi' => 'required|exists:locations,id',
            'id_jenis' => 'required|exists:vehicle_types,id',
            'no_polisi' => 'required|string|max:15',
        ]);

        $transaction = Transaction::findOrFail($id);
        $vehicleType = VehicleType::findOrFail($request->id_jenis);

        $updateData = [
            'id_lokasi' => $request->id_lokasi,
            'id_jenis' => $request->id_jenis,
            'no_polisi' => strtoupper($request->no_polisi),
            'perjam_pertama' => $vehicleType->perjam_pertama,
            'perjam_berikutnya' => $vehicleType->perjam_berikutnya,
            'max_perhari' => $vehicleType->max_perhari,
        ];

        if ($transaction->keluar && $transaction->total_jam !== null) {
            $updateData['total_bayar'] = Transaction::calculateFee(
                $transaction->total_jam,
                $vehicleType->perjam_pertama,
                $vehicleType->perjam_berikutnya,
                $vehicleType->max_perhari
            );
        }

        $transaction->update($updateData);

        return redirect()->route('transaction.index')->with('success', 'Transaction was successfully updated!');
    }

    /**
     * Remove the specified transaction from storage.
     */
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return redirect()->route('transaction.index')->with('success', 'Transaction was successfully deleted!');
    }

    /**
     * Stream printable ticket PDF.
     */
    public function ticket($id)
    {
        $transaction = Transaction::with(['location', 'vehicleType'])->findOrFail($id);

        $pdf = Pdf::loadView('transaction.ticket', compact('transaction'));

        $filename = 'ticket-' . $transaction->no_tiket . '.pdf';
        $saveFolder = storage_path('public/tickets');

        if (!File::exists($saveFolder)) {
            File::makeDirectory($saveFolder, 0755, true);
        }

        File::put($saveFolder . DIRECTORY_SEPARATOR . $filename, $pdf->output());

        return $pdf->stream($filename);
    }
}
