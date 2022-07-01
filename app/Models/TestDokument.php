<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestDokument extends Model
{
    use HasFactory;

    protected $table = 'test_dokument';

    public function test() {
        return $this->belongsTo('\App\Models\Test');
    }
}
