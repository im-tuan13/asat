<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_name',
        'max_motorcycle',
        'max_car',
        'max_other',
    ];

    /**
     * Get the transactions for the location.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'id_lokasi');
    }

    /**
     * Get count of currently parked vehicles of a specific type.
     */
    public function activeTransactionsCount($jenis)
    {
        return $this->transactions()
            ->whereNull('keluar')
            ->whereHas('vehicleType', function ($query) use ($jenis) {
                $query->where('jenis', $jenis);
            })
            ->count();
    }

    /**
     * Get available spots for a specific vehicle type.
     */
    public function availableSpots($jenis)
    {
        $maxColumn = 'max_' . $jenis;
        if (!in_array($jenis, ['motorcycle', 'car', 'other'])) {
            return 0;
        }
        
        $max = $this->$maxColumn ?? 0;
        $occupied = $this->activeTransactionsCount($jenis);
        return max(0, $max - $occupied);
    }
}
