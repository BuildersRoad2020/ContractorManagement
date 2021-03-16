<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActiveUser;


class ContractorDocuments extends Model
{
    use HasFactory;

    protected $fillable = [
        'documents_id',
        'contractors_id',
        'status',
        'file_path',
        'expiration'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new ActiveUser);
    }

    public function Contractors()
    {
        return $this->belongsTo(Contractors::class, 'contractors_id');
    }

    public function Documents()
    {
        return $this->belongsTo(Documents::class, 'documents_id', 'id');
    }   

  
}
