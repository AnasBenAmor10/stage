<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'end_of_internship_certificate',
        'company_id',
        'rapport',
        'etudiant_id',
        'journal',
        'affected',
        'letter',
        'dateD_stage',
        'dateF_stage',
        'dateS',
    ];

    public function Supervisor()
    {
        return $this->belongsToMany(User::class, 'stage_encadrant', 'stage_id', 'encadrant_id');
    }
    public function etudiant()
    {
        return $this->belongsTo(User::class, 'etudiant_id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function jury()
    {
        return $this->belongsToMany(Jury::class, 'stage_id');
    }
}
