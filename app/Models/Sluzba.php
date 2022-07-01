<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sluzba extends Model
{
    use HasFactory;

    protected $table = 'sluzba';

    public function sektor() {
    	return $this->belongsTo('\App\Models\Sektor');
    }
}
