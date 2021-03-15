<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents_Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function Documents()
    {
        return $this->hasMany(Documents::class);
    } 
}
