<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestKomisija extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_id',
        'komisija_id'
    ];

    protected $table = 'test_komisija';

    public function test() {
        return $this->belongsTo('\App\Models\Test');
    }

    public function komisija() {
        return $this->belongsTo('\App\Models\Komisija');
    }
}
