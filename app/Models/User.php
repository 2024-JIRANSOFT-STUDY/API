<?php

namespace App\Models;

// use Illuminate\Foundation\Auth\User as Authenticatable;
use MongoDB\Laravel\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements JWTSubject
{
    use SoftDeletes;

    protected $connection = 'mongodb';
    protected $collection = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'created_at', 
        'updated_at',
        'deleted_at',
        'is_admin',
    ];
    protected $hidden = [
        'password',
    ];
    
    protected $attributes = [
        'is_admin' => false,
    ];
    
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    
    public function letters()
    {
        return $this->hasMany(Letter::class);
    }
}
