<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;

    public function encadrants()
    {
        return $this->belongsToMany(User::class, 'stage_encadrant', 'stage_id', 'encadrant_id');
    }
    public function etudiant()
    {
        return $this->belongsTo(User::class, 'etudiant_id');
    }
}
