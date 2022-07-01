<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komisija extends Model
{
    use HasFactory;

    protected $table = 'komisija';

    protected $fillable = [
        'ime',
        'prezime'
    ];

    public function testovi() {
        return $this->belongsToMany('\App\Models\Test', 'test_komisija', 'komisija_id', 'test_id');
    }
}
