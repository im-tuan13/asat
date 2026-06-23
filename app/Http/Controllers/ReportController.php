<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\VehicleType;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display location report showing capacity, occupancy, and revenue per location.
     */
    public function locationReport()
    {
        return response('', 200);
    }

    /**
     * Display a filterable transaction report.
     */
    public function transactionReport(Request $request)
    {
        return response('', 200);
    }
}
