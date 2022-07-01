<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Test extends Model
{
    use HasFactory;

    protected $table = 'test';

    protected $guarded = [];

    public function zaposleni() {
        return $this->belongsTo('\App\Model\Zaposleni');
    }

    public function predavac() {
        return $this->belongsTo('\App\Models\Predavac');
    }

    public function rezultat() {
        return $this->belongsTo('\App\Models\Rezultat');
    }

    public function vrsta_obuke() {
        return $this->belongsTo('\App\Models\VrstaObuke');
    }

    public function test_dokuments() {
        return $this->hasMany('\App\Models\TestDokument');
    }

    public function prakticna_ocjena() {
        return $this->belongsTo('\App\Models\PrakticnaOcjena');
    }

    public function komisija_clanovi()
    {   
        return $this->belongsToMany('\App\Models\Komisija', 'test_komisija', 'test_id', 'komisija_id');
    }
}
