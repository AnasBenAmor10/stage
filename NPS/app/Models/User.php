<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'email',
        'password',
        'Numero',
        'adresse',
        'image',
        'cin',
        'role',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_superadmin' => 'boolean',
        'is_admin' => 'boolean',
    ];
    protected $attributes = [
        'is_superadmin' => false,
        'is_admin' => false,
    ];

    public function stagesAsEtudiant()
    {
        return $this->hasMany(Stage::class, 'etudiant_id');
    }

    public function stagesAsEncadrant()
    {
        return $this->belongsToMany(Stage::class, 'stage_encadrant', 'encadrant_id', 'stage_id');
    }
}
