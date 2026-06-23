<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleType extends Model
{
    use HasFactory;

    protected $table = 'vehicle_types';

    protected $fillable = [
        'jenis',
        'perjam_pertama',
        'perjam_berikutnya',
        'max_perhari',
    ];

    /**
     * Get the transactions for the vehicle type.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'id_jenis');
    }
}
