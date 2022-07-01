<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Zaposleni;
use App\Models\Grupa;
use App\Models\GrupaZaposleni;
use Carbon\Carbon;

class EvidencijaController extends Controller
{
	public function index(Request $request) {
		if ($request->ajax()) {
			return Datatables::of(Grupa::all())
				->addIndexColumn()
				->editColumn('datum_polaganja', function($data) {
					return Carbon::parse($data->datum_polaganja)->format('d.m.Y');
				})
				->addColumn('broj_kandidata', function($data) {
					return $data->zaposleni->count();
				})
				->addColumn('action', function($data) {
					return '<a href="/evidencija/' . $data->id . '" class="edit btn btn-primary btn-sm">Pregled</a>';
				})
				->rawColumns(['action'])
				->make(true);
		}

		return view('evidencija.index');
	}

	public function grupa(Request $request, Grupa $grupa) {
		$zaposleni = GrupaZaposleni::where('grupa_id', $grupa->id)->pluck('zaposleni_id');
		if ($request->ajax()) {
			return Datatables::of(Zaposleni::whereIn('id', $zaposleni)->get())
				->addIndexColumn()
				->editColumn('region_id', function($data) {
					if (!$data->region) {
						return '';
					}
					return $data->region->naziv;
				})
				->editColumn('sektor_id', function($data) {
					return $data->sektor->naziv;
				})
				->editColumn('sluzba_id', function($data) {
					return $data->sluzba->naziv;
				})
				->addColumn('action', function($data) {
					return '<button class="edit btn btn-primary btn-sm openModalBtn" data-toggle="modal" data-target="#modalUnosRezultata" data-id="' . $data->id . '">Unos rezultata</button>';
				})
				->rawColumns(['action'])
				->make(true);
		}
		return view('evidencija.grupa', compact('grupa'));
	}

	public function unos_rezultata(Request $request)
}
