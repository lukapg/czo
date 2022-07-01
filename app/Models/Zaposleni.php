<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zaposleni extends Model
{
    use HasFactory;

    protected $table = 'zaposleni';

    protected $fillable = [
        'ime',
	'prezime',
	'telefon',
	'email',
	'adresa',
        'sektor_id',
        'sluzba_id',
        'region_id',
	'radno_mjesto',
	'mjesto_rada',
	'zastita_na_radu',
	'organizacija_smjestaja'
    ];

    public function sektor() {
        return $this->belongsTo('\App\Models\Sektor');
    }

    public function sluzba() {
    	return $this->belongsTo('\App\Models\Sluzba');
    }

    public function region() {
        return $this->belongsTo('\App\Models\Region');
    }

    public function tests() {
        return $this->hasMany('\App\Models\Test');
    }

    public function setZastitaNaRaduAttribute($value) {
    	$this->attributes['zastita_na_radu'] = ($value == 'on');
    }

    public function setOrganizacijaSmjestajaAttribute($value) {
    	$this->attributes['organizacija_smjestaja'] = ($value == 'on');
    }
}
