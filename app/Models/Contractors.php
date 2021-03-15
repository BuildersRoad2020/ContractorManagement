<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Scopes\ActiveUser;

class Contractors extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'name',
        'status'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new ActiveUser);
    }

    public function User() 
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function Technicians()
    {
        return $this->hasMany(Technicians::class, 'contractors_id', 'id');
    }

    public function ContractorDetails() 
    {
        return $this->hasOne(ContractorDetails::class, 'contractors_id', 'id');
    }

    public function ContractorSkills()
    {
        return $this->belongsToMany(Skills::class, 'contractor__skills', 'contractors_id','skills_id');
    } 

    public function ContractorDocuments()
    {
        return $this->belongsToMany(Documents::class, 'contractor_documents', 'contractors_id','documents_id');
    } 


    public function Countries()
    {
        return $this->belongsToMany(Countries::class, 'contractor_details', 'contractors_id', 'country');
    }

    public function States()
    {
        return $this->belongsToMany(States::class, 'contractor_details', 'contractors_id', 'state');
    }

    public function Cities()
    {
        return $this->belongsToMany(Cities::class, 'contractor_details', 'contractors_id', 'city');
    }


}
