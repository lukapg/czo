<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Predavac extends Model
{
    use HasFactory;

    protected $table = 'predavac';

    protected $fillable = [
        'ime',
        'prezime',
        'sluzba_id'
    ];

    public function vrste_obuke() {
        return $this->belongsToMany(VrstaObuke::class, 'predavac_vrsta_obuke');
    }
}
