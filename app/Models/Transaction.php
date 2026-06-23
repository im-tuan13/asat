<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_lokasi',
        'no_tiket',
        'no_polisi',
        'id_jenis',
        'masuk',
        'keluar',
        'perjam_pertama',
        'perjam_berikutnya',
        'max_perhari',
        'total_jam',
        'total_bayar',
    ];

    protected $casts = [
        'masuk' => 'datetime',
        'keluar' => 'datetime',
    ];

    /**
     * Get the location for this transaction.
     */
    public function location()
    {
        return $this->belongsTo(Location::class, 'id_lokasi');
    }

    /**
     * Get the vehicle type for this transaction.
     */
    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class, 'id_jenis');
    }

    /**
     * Static method to calculate parking fee based on hours and rate structure.
     */
    public static function calculateFee($hours, $perjam_pertama, $perjam_berikutnya, $max_perhari)
    {
        $hours = (int) ceil($hours);
        if ($hours <= 0) {
            $hours = 1;
        }

        if ($hours <= 24) {
            $fee = $perjam_pertama + ($hours - 1) * $perjam_berikutnya;
            if ($fee > $max_perhari) {
                $fee = $max_perhari;
            }
            return $fee;
        } else {
            // "Jika lama parkir melebihi 24 jam maka Total Bayar dihitung jumlah hari dikalikan 60% dari max_perhari"
            $days = (int) floor($hours / 24);
            $fee = $days * (0.60 * $max_perhari);
            return $fee;
        }
    }
}
