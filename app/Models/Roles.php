<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];

    public function RoleUser() {
        $this->belongsToMany(RoleUser::class);
    }

    public function User() {
        $this->belongsToMany(User::class);
    }   
}
