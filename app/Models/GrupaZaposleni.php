<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupaZaposleni extends Model
{
	use HasFactory;

	protected $table = 'grupa_zaposleni';

	protected $fillable = [
		'zaposleni_id',
		'grupa_id'
	];

	public function grupa() {
		return $this->belongsTo('\App\Models\Grupa');
	}

	public function zaposleni() {
		return $this->belongsTo('\App\Models\Zaposleni');
	}
}
