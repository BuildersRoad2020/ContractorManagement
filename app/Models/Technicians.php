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
        'status',
        'address',
        'city',
        'state',
        'country',
        'postcode',
        'phone',
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

    public function Countries() {
        return $this->belongsTo(Countries::class, 'country', 'id');
    }

    public function States() {
        return $this->belongsTo(States::class, 'state','id' );
    }

    public function Cities() {
        return $this->belongsTo(Cities::class, 'city', 'id');
    }

    public function TechnicianSkills()
    {
        return $this->belongsToMany(Skills::class, 'technician__skills', 'technicians_id','skills_id');
    } 

    public function TechnicianDocuments()
    {
        return $this->belongsToMany(Documents::class, 'technician_documents', 'technicians_id','documents_id');
    } 
}
