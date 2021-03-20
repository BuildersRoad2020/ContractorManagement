<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Scopes\ActiveUser;

class Documents_Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new ActiveUser);
    }

    public function Documents()
    {
        return $this->hasMany(Documents::class);
    } 
}
