<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class States extends Model
{
    use HasFactory;

    public function Countries()
    {
        return $this->belongsTo(Countries::class);
    }   

    public function Cities()
    {
        return $this->hasMany(Cities::class);
    }  
}
