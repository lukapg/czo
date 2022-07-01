<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupaPredavac extends Model
{
	use HasFactory;

	protected $table = 'grupa_predavac';

	protected $fillable = [
		'grupa_id',
		'predavac_id'
	];

	public function grupa() {
		return $this->belongsTo('\App\Models\Grupa');
	}

	public function predavac() {
		return $this->belongsTo('\App\Models\Predavac');
	}
}
