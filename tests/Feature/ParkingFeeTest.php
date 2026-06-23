<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Transaction;

class ParkingFeeTest extends TestCase
{
    /**
     * Test parking fee calculations for motorcycle.
     * Rates: first hour = 2000, next hourly = 1000, max per day = 10000
     */
    public function test_motorcycle_fee_calculation(): void
    {
        $perjam_pertama = 2000;
        $perjam_berikutnya = 1000;
        $max_perhari = 10000;

        // Case 1: 6 hours (below 24h, not capped)
        // Expected: 2000 + 5 * 1000 = 7000
        $fee1 = Transaction::calculateFee(6, $perjam_pertama, $perjam_berikutnya, $max_perhari);
        $this->assertEquals(7000, $fee1);

        // Case 2: 15 hours (below 24h, capped at daily max)
        // Calculated: 2000 + 14 * 1000 = 16000 -> Capped: 10000
        $fee2 = Transaction::calculateFee(15, $perjam_pertama, $perjam_berikutnya, $max_perhari);
        $this->assertEquals(10000, $fee2);

        // Case 3: 75 hours (above 24h)
        // Calculated: floor(75/24) = 3 days -> 3 * (60% of 10000) = 3 * 6000 = 18000
        $fee3 = Transaction::calculateFee(75, $perjam_pertama, $perjam_berikutnya, $max_perhari);
        $this->assertEquals(18000, $fee3);
        
        // Case 4: 0 or less than 1 hour should default to 1 hour
        // Expected: 2000
        $fee4 = Transaction::calculateFee(0.5, $perjam_pertama, $perjam_berikutnya, $max_perhari);
        $this->assertEquals(2000, $fee4);
    }
}
