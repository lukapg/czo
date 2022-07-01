<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupa extends Model
{
	use HasFactory;

	protected $table = 'grupa';

	protected $fillable = [
		'naziv',
		'pocetak_obuke',
		'kraj_obuke',
		'datum_polaganja',
		'ukupno_bodova',
		'bodova_za_prolaz',
		'vrsta_obuke_id'
	];

	public function zaposleni() {
		return $this->hasMany('\App\Models\GrupaZaposleni');
	}

	public function vrsta_obuke() {
		return $this->belongsTo('\App\Models\VrstaObuke');
	}
}
