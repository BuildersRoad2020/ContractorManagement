<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Scopes\ActiveUser;


class Documents extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'file_path',
        'required',
        'status'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new ActiveUser);
    }

    public function Documents_Category()
    {
        return $this->belongsTo(Documents_Category::class);
    }  
}
