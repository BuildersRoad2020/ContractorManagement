<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

use App\Scopes\ActiveUser;


class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'password_changed_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new ActiveUser);
    }

    public function RoleUser() 
    {
        return $this->hasMany(RoleUser::class, 'users_id');
    }

    public function Roles() 
    {
        return $this->belongsToMany(Roles::class, 'role_users', 'users_id', 'roles_id'); //table name, foreign key related to local table, foreign key related to  foreign table
    }

    public function Contractors() 
    {
        return $this->hasOne(Contractors::class, 'users_id');
    }

    public function Technicians() 
    {
        return $this->hasOne(Technicians::class, 'users_id');
    }


}
