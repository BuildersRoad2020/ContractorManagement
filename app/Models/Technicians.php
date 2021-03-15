<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActiveUser;

class Technicians extends Model
{
    use HasFactory;

    protected $fillable = [
        'contractors_id',
        'name',
        'users_id',
        'status'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new ActiveUser);
    }

    public function Contractors() {
        return $this->belongsTo(Contractors::class, 'contractors_id', 'id');
    }

    public function User() {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
