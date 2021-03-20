<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractorRates extends Model
{
    use HasFactory;

    protected $fillable = [
        'contractors_id',
        'rate',
        'rate2',
        'city',
        'state',
        'country',
    ];

    public function Contractors()
    {
        return $this->belongsTo(Contractors::class, 'contractors_id');
    }

    public function Countries() {
        return $this->belongsTo(Countries::class, 'country', 'id');
    }

    public function States() {
        return $this->belongsTo(States::class, 'state','id' );
    }

    public function Cities() {
        return $this->belongsTo(Cities::class, 'city', 'id');
    }

}
