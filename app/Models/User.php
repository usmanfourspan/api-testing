<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Hash;
use App\Traits\UseUuid;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UseUuid;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];


    protected $hidden = [
        'id',
        'password',
        'remember_token',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Hash::make($value),
        );
    }
}
