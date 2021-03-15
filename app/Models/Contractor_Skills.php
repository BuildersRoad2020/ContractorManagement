<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contractor_Skills extends Model
{
    use HasFactory;

    protected $fillable = [
        'skills_id',
        'contractors_id',
    ];

    public function Skills()
    {
        return $this->belongsTo(Skills::class, 'skills_id', 'id');
    }      


    public function Contractors()
    {
        return $this->belongsTo(Contractors::class, 'id' , 'contractors_id');
    }
}
