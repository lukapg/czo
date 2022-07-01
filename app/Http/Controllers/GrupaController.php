<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupa;
use App\Http\Resources\ZaposleniResource;
use App\Http\Resources\KomisijaResource;
use App\Http\Resources\PredavacResource;
use App\Models\Zaposleni;
use App\Models\Predavac;
use App\Models\Komisija;
use App\Models\VrstaObuke;
use App\Models\GrupaZaposleni;
use App\Models\GrupaKomisija;
use App\Models\TempGrupaZaposleni;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\GrupaPredavac;
use App\Service\GrupaService;

class GrupaController extends Controller
{
	protected $grupaService;

    public function __construct(GrupaService $grupaService)
    {
        $this->grupaService = $grupaService;
    }

	public function index(Request $request) {
		if ($request->ajax()) {
			return Datatables::of(Grupa::all())
				->addIndexColumn()
				->editColumn('pocetak_obuke', function($data) {
					return Carbon::parse($data->pocetak_obuke)->format('d.m.Y');
				})
				->editColumn('kraj_obuke', function($data) {
					return Carbon::parse($data->kraj_obuke)->format('d.m.Y');
				})
				->editColumn('status', function($data) {
					$pocetak_obuke = Carbon::parse($data->pocetak_obuke);
					$kraj_obuke = Carbon::parse($data->kraj_obuke);
					$danas = Carbon::now();

					if ($danas->between($pocetak_obuke, $kraj_obuke)) {
						return 'U toku';
					}

					if ($danas->lt($pocetak_obuke)) {
						return 'Planirano';
					}

					return 'Završeno';
				})
				->addColumn('broj_kandidata', function($data) {
					return $data->zaposleni->count();
				})
				->addColumn('action', function($data) {
					return '<a href="/grupe/' . $data->id . '" class="edit btn btn-primary btn-sm">Pregled</a>';
				})
				->addColumn('action_izmjena', function($data) {
				return '<a href="/grupe/'. $data->id . '/edit" class="edit btn btn-primary btn-sm">Izmjena</a>';
				})
				->rawColumns(['action', 'action_izmjena'])
				->make(true);
		}

		return view('grupa.index');
	}

	public function create(Request $request) {
		$predavaci = Predavac::all();
		$vrste_obuke = VrstaObuke::all();
		return view('grupa.create', compact('predavaci', 'vrste_obuke'));
	}

	public function confirm(Request $request, Grupa $grupa) {
		$zaposleni = DB::table('zaposleni')
			->select('zaposleni.id', 'zaposleni.ime', 'zaposleni.prezime', 'zaposleni.radno_mjesto', 'zaposleni.zastita_na_radu', 'zaposleni.organizacija_smjestaja', 'sektor.naziv as sektor', 'sluzba.naziv as sluzba')
			->join('temp_grupa_zaposleni', 'temp_grupa_zaposleni.zaposleni_id', '=', 'zaposleni.id')
			->join('sektor', 'sektor.id', '=', 'zaposleni.sektor_id')
			->join('sluzba', 'sluzba.id', '=', 'zaposleni.sluzba_id')
			->where('temp_grupa_zaposleni.grupa_id', $grupa->id)
			->get();
		return view('grupa.confirm', compact('zaposleni', 'grupa'));
	}

	public function store(Request $request) {

		$naziv_vrste_obuke = VrstaObuke::where('id', $request->vrsta_obuke_id)->value('naziv');

		$naziv_grupe = $naziv_vrste_obuke . '_' . Carbon::parse($request->datum_polaganja)->format('d.m.Y');

		$unos = Grupa::create([
			'naziv' => $naziv_grupe,
			'predavac_id' => $request->predavac_id,
			'vrsta_obuke_id' => $request->vrsta_obuke_id,
			'pocetak_obuke' => Carbon::parse($request->pocetak_obuke)->format('Y-m-d'),
			'kraj_obuke' => Carbon::parse($request->kraj_obuke)->format('Y-m-d'),
			'datum_polaganja' => Carbon::parse($request->datum_polaganja)->format('Y-m-d'),
			'ukupno_bodova' => $request->ukupno_bodova,
			'bodova_za_prolaz' => $request->bodova_za_prolaz
		]);

		if (!$unos) {
			abort(500, 'Doslo je do greske prilikom cuvanja podataka');
		}

		if (!$this->grupaService->store($unos, $request->komisija, $request->predavac, $request->zaposleni)) {
			abort(500, 'Doslo je do greske prilikom cuvanja podataka');
		}

		return redirect()->route('grupa.confirm', ['grupa' => $unos->id]);
	}

	public function storeConfirm(Request $request, Grupa $grupa) {
		$tempZaposleni = TempGrupaZaposleni::where('grupa_id', $grupa->id)->get();
		foreach($tempZaposleni as $zaposleni) {
			$unos_zaposleni = GrupaZaposleni::create([
				'grupa_id' => $grupa->id,
				'zaposleni_id' => $zaposleni->zaposleni_id
			]);

			if (!$unos_zaposleni) {
				abort(500, "Došlo je do greške prilikom čuvanja podataka!");
			}
		}

		$deleteTempGrupaResult = TempGrupaZaposleni::where('grupa_id', $grupa->id)->delete();
		if (!$deleteTempGrupaResult) {
			abort(500, 'Doslo je do greske prilikom cuvanja podataka!');
		}
		Session::flash("Grupa uspješno sačuvana");
		return redirect()->route('grupa.index');	
	}

	public function updateZaposleniOrganizacijaSmjestaja(Request $request) {
		TempGrupaZaposleni::where('grupa_id', $request->grupa_id)
		->where('zaposleni_id', $request->zaposleni_id)
		->update(['organizacija_smjestaja' => ($request->organizacija_smjestaja === 'true' ? 1 : 0)]);
		return response()->json(($request->organizacija_smjestaja === 'true' ? 1 : 0));
	}

	public function deleteTempZaposleni(Request $request, Grupa $grupa, Zaposleni $zaposleni) {
		$deleteResult = TempGrupaZaposleni::where('grupa_id', $grupa->id)->where('zaposleni_id', $zaposleni->id)->delete();

		if (!$deleteResult) {
			abort(500, 'Doslo je do greske prilikom brisanja podataka');
		}

		return redirect()->route('grupa.confirm', ['grupa' => $grupa->id]);
	}

	public function edit(Request $request, Grupa $grupa) {
		$zaposleni = DB::table('zaposleni')
			->select('zaposleni.*', 'sektor.naziv as sektor', 'sluzba.naziv as sluzba')
			->join('grupa_zaposleni', 'grupa_zaposleni.zaposleni_id', '=', 'zaposleni.id')
			->join('sektor', 'sektor.id', '=', 'zaposleni.sektor_id')
			->join('sluzba', 'sluzba.id', '=', 'zaposleni.sluzba_id')
			->where('grupa_zaposleni.grupa_id', $grupa->id)
			->get();
		$predavaci = Predavac::all();
		$vrste_obuke = VrstaObuke::all();
		return view('grupa.edit', compact('grupa', 'zaposleni', 'predavaci', 'vrste_obuke'));
	}

	public function show(Request $request, Grupa $grupa) {
		$zaposleni = DB::table('zaposleni')
			->select('zaposleni.*', 'sektor.naziv as sektor', 'sluzba.naziv as sluzba')
			->join('grupa_zaposleni', 'grupa_zaposleni.zaposleni_id', '=', 'zaposleni.id')
			->join('sektor', 'sektor.id', '=', 'zaposleni.sektor_id')
			->join('sluzba', 'sluzba.id', '=', 'zaposleni.sluzba_id')
			->where('grupa_zaposleni.grupa_id', $grupa->id)
			->get();
		$predavaci = Predavac::all();
		$vrste_obuke = VrstaObuke::all();
		$komisija = DB::table('komisija')
			  ->select('komisija.ime', 'komisija.prezime')
			  ->join('grupa_komisija', 'grupa_komisija.komisija_id', '=', 'komisija.id')
			  ->where('grupa_komisija.grupa_id', $grupa->id)
			  ->get();
		return view('grupa.show', compact('grupa', 'zaposleni', 'predavaci', 'vrste_obuke', 'komisija'));
	}

	public function update(Request $request, Grupa $grupa) {
		$grupa->naziv = $request->naziv;
		$grupa->pocetak_obuke = Carbon::parse($request->pocetak_obuke)->format('Y-m-d');
		$grupa->kraj_obuke = Carbon::parse($request->kraj_obuke)->format('Y-m-d');
		$grupa->datum_polaganja = Carbon::parse($request->datum_polaganja)->format('Y-m-d');
		$grupa->vrsta_obuke_id = $request->vrsta_obuke_id;
		$grupa->ukupno_bodova = $request->ukupno_bodova;
		$grupa->bodova_za_prolaz = $request->bodova_za_prolaz;

		if (!$grupa->save()) {
			abort(500, 'Doslo je do greske prilikom cuvanja podataka!');
		}

		if (!$this->grupaService->update($grupa, $request->komisija, $request->predavac, $request->zaposleni)) {
			abort(500, 'Doslo je do greske prilikom cuvanja podataka!');
		}
		
		return redirect()->route('grupa.confirm', ['grupa' => $grupa->id]);
	}

	public function apiGrupaZaposleni(Request $request, Grupa $grupa, VrstaObuke $vrsta_obuke) {
		$zaposleni = GrupaZaposleni::where('grupa_id', $grupa->id)->pluck('zaposleni_id');
		return [
			'results' => ZaposleniResource::collection(Zaposleni::whereIn('id', $zaposleni)->get())
		];
	}

	public function apiKomisija(Request $request, Grupa $grupa) {
		$clanovi = GrupaKomisija::where('grupa_id', $grupa->id)->pluck('komisija_id');
		return [
			'results' => KomisijaResource::collection(Komisija::whereIn('id', $clanovi)->get())
		];
	}

	public function apiGrupaPredavaci(Request $request, Grupa $grupa) {
		$predavaci = GrupaPredavac::where('grupa_id', $grupa->id)->pluck('predavac_id');
		return [
			'results' => PredavacResource::collection(Predavac::whereIn('id', $predavaci)->get())
		];
	}
}
