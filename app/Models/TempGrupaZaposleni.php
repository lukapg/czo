<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempGrupaZaposleni extends Model
{
	use HasFactory;

	protected $table = 'temp_grupa_zaposleni';

	protected $fillable = [
		'grupa_id',
		'zaposleni_id'
	];

	public function zaposleni() {
		return $this->belongsTo('\App\Models\Zaposleni');
	}

	public function grupa() {
		return $this->belongsTo('\App\Models\Grupa');
	}
}
