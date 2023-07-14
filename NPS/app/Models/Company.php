<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'adresse',
        'description',
    ];

    protected $hidden = [
        'password',
    ];
    public function stages()
    {
        return $this->hasMany(Stage::class);
    }
}
