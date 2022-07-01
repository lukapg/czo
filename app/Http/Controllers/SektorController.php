<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sektor;
use App\Models\Sluzba;

class SektorController extends Controller
{
    public function getSluzbe(Request $request, Sektor $sektor) {
    	$sluzbe = Sluzba::where('sektor_id', $sektor->id)->get();
	    return response()->json($sluzbe);
    }
}
