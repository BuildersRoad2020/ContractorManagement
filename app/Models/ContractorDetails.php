<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActiveUser;

class ContractorDetails extends Model

{
    use HasFactory;
    

    protected $fillable = [
        'contractors_id',
        'address',
        'city',
        'postcode',
        'state',
        'country',
        'abn',
        'name_primarycontact',
        'phone_primary',
        'email_primary',
        'name_secondarycontact',
        'phone_secondary',
        'email_secondary',
        'terms',
        'currency',
        'bankname',
        'branch',
        'accountname',
        'bsb',
        'accountnumber',
        'status'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new ActiveUser);
    }

    public function Contractors()
    {
        return $this->belongsTo(Contractors::class, 'id', 'contractors_id');
    }  

    public function Countries()
    {
        return $this->belongsTo(Countries::class, 'id', 'Country');
    }  

    public function Cities()
    {
        return $this->belongsTo(Cities::class, 'id', 'city');
    }  


}
