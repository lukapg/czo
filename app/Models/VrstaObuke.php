<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VrstaObuke extends Model
{
    use HasFactory;

    protected $table = 'vrsta_obuke';

    protected $fillable = [
    	'sluzba_id',
	'naziv',
	'status'
    ];

    public function sluzba() {
    	return $this->belongsTo('\App\Models\Sluzba');
    }

    public function predavaci() {
        return $this->belongsToMany(Predavac::class, 'predavac_vrsta_obuke');
    }
}
