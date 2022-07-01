<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupaKomisija extends Model
{
	use HasFactory;

	protected $table = 'grupa_komisija';

	protected $fillable = [
		'grupa_id',
		'komisija_id'
	];

	public function grupa() {
		return $this->belongsTo('\App\Models\Grupa');
	}

	public function komisija() {
		return $this->belongsTo('\App\Models\Komisija');
	}
}
