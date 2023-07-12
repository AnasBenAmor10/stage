<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stage_encadrant extends Model
{
    use HasFactory;
    protected $table = 'encadrant_stage';

    protected $fillable = [
        'encadrant_id',
        'stage_id',
    ];

    public $timestamps = false;

    public function encadrant()
    {
        return $this->belongsTo(User::class, 'encadrant_id');
    }

    public function stage()
    {
        return $this->belongsTo(Stage::class, 'stage_id');
    }
}
