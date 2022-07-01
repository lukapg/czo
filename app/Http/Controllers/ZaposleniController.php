<?php

namespace App\Http\Controllers;

use App\Http\Requests\PolaganjeRequest;
use App\Http\Requests\ZaposleniRequest;
use App\Http\Resources\KomisijaResource;
use App\Http\Resources\ZaposleniResource;
use App\Jobs\Podsjetnik;
use App\Mail\PodsjetnikPolaganje;
use App\Models\Komisija;
use App\Models\PrakticnaOcjena;
use Carbon\Carbon;
use App\Models\Test;
use App\Models\Region;
use App\Models\Sektor;
use App\Models\Predavac;
use App\Models\Rezultat;
use App\Models\TestDokument;
use App\Models\Zaposleni;
use App\Models\VrstaObuke;
use App\Models\Sluzba;
use App\Models\TestKomisija;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Service\StoreDocument;

class ZaposleniController extends Controller
{

    protected $documentService;

    public function __construct(StoreDocument $documentService)
    {
        $this->documentService = $documentService;
    }

    public function index(Request $request) {
        if ($request->ajax()) {
            return Datatables::of(Zaposleni::where('status', 1)->with('sektor', 'region', 'tests')->get())
                ->addIndexColumn()
                ->editColumn('region_id', function($data){
                    if (!$data->region) {
                        return "";
                    }

                    return $data->region->naziv;
                })
                ->editColumn('sektor_id', function($data){
                    return $data->sektor->naziv;
                })
                ->editColumn('status', function($data){
                    if ($data->tests->count() == 0) {
                        return "Nema podataka";
                    }
                    else {
                        if ($data->tests->where('rezultat_id', 1)->count() > 0) {
                            if ($data->tests->last()->rezultat_id == 1) {
                                return "Položio/la";
                            }
                            else {
                                return "Nije položio/la";
                            }
                        }
                        else {
                            return "Nije položio/la";
                        }
                    }
                })
                ->editColumn('zadnje_polaganje', function($data){
                    if ($data->tests->where('zaposleni_id', $data->id)->where('status', 1)->count() < 1) {
                        return "-";
                    }

                    $datum_polaganja = new Carbon($data->tests->last()->datum_polaganja);
                    return $datum_polaganja->format('d.m.Y');
                })
                ->editColumn('naredna_obuka', function($data){
                    if ($data->tests->where('rezultat_id', 1)->where('status', 1)->count() < 1) {
                        return "-";
                    }
                    else {
                        if ($data->tests->last()->rezultat_id == 1) {
                            $datum_polaganja = new Carbon($data->tests->last()->datum_polaganja);
                            return $datum_polaganja->addYears(3)->format('d.m.Y');
                        }
                        else {
                            return "-";
                        }
                    }
                })
                ->addColumn('action', function($data){
                    return '<a href="/zaposleni/'. $data->id .'" class="edit btn btn-primary btn-sm">Pregled</a>';
                })
                ->addColumn('action_izmjena', function($data){
                    if(!Gate::check('admin')) {
                        return '';
                    }
                    return '<a href="/zaposleni/'. $data->id .'/edit" class="edit btn btn-primary btn-sm">Izmjena</a>';
                })
                ->addColumn('action_brisanje', function($data){
                    if(!Gate::check('admin')) {
                        return '';
                    }
                    return '<a href="/zaposleni/'. $data->id .'/delete" class="edit btn btn-primary btn-sm">Brisanje</a>';
                })
                ->addColumn('action_polaganja', function($data){
                    if(!Gate::check('pregled')) {
                        return '';
                    }
                    return '<a href="/zaposleni/'. $data->id .'/polaganja" class="edit btn btn-primary btn-sm">Polaganja</a>';
                })
                ->rawColumns(['action', 'action_izmjena', 'action_brisanje', 'action_polaganja'])
                ->make(true);
        }

        return view('zaposleni.index');
    }

    public function create() {
        $sektori = Sektor::all();
        $regioni = Region::all();
        $sluzbe = Sluzba::all();
        return view('zaposleni.create', compact('sektori', 'regioni', 'sluzbe'));
    }

    public function store(ZaposleniRequest $request) {
        $zaposleni = Zaposleni::create($request->validated());
        Session::flash('success', "Zaposleni uspješno dodat!");
        return redirect()->route('zaposleni.index');
    }

    public function show(Request $request, Zaposleni $zaposleni) {
        $sektori = Sektor::all();
        $regioni = Region::all();
	    $sluzbe = Sluzba::all();
        return view('zaposleni.show', compact('zaposleni', 'sektori', 'regioni', 'sluzbe'));
    }

    public function edit(Request $request, Zaposleni $zaposleni) {
        $sektori = Sektor::all();
        $regioni = Region::all();
	    $sluzbe = Sluzba::all();
        return view('zaposleni.edit', compact('zaposleni', 'sektori', 'regioni', 'sluzbe'));
    }

    public function delete(Request $request, Zaposleni $zaposleni) {
        return view('zaposleni.delete', compact('zaposleni'));
    }

    public function postDelete(Request $request, Zaposleni $zaposleni) {
        $zaposleni->status = 0;
        $zaposleni->save();
        Session::flash('success', "Zaposleni uspješno obrisan!");
        return redirect()->route('zaposleni.index');
    }

    public function update(Request $request, Zaposleni $zaposleni) {
        $zaposleni->fill($request->validated());
        $zaposleni->save();
        Session::flash('success', "Izmjene uspješno sačuvane!");
        return redirect()->route('zaposleni.index');
    }

    public function polaganja(Request $request, Zaposleni $zaposleni) {
        if ($request->ajax()) {
            return Datatables::of(Test::where('status', 1)->where('zaposleni_id', $zaposleni->id)->with('predavac', 'vrsta_obuke', 'rezultat')->get())
                ->addIndexColumn()
                ->editColumn('datum_polaganja', function($data){
                    return Carbon::parse($data->datum_polaganja)->format('d.m.Y');
                })
                ->editColumn('rezultat_id', function($data){
                    return $data->rezultat->naziv;
                })
                ->editColumn('obrasci_prilozeni', function($data){
                    if ($data->test_dokuments->count() > 0) {
                        return "Da";
                    }
                    else {
                        return "Ne";
                    }
                })
                ->addColumn('action', function($data){
                    return '<a href="/zaposleni/'. $data->zaposleni_id .'/polaganja/'. $data->id .'" class="edit btn btn-primary btn-sm">Pregled</a>';
                })
                ->addColumn('action_izmjena', function($data){
                    if(!Gate::check('uljr')) {
                        return '';
                    }
                    return '<a href="/zaposleni/'. $data->zaposleni_id .'/polaganja/'. $data->id .'/edit" class="edit btn btn-primary btn-sm">Izmjena</a>';
                })
                ->addColumn('action_brisanje', function($data){
                    if(!Gate::check('admin')) {
                        return '';
                    }
                    return '<a href="/zaposleni/'. $data->zaposleni_id .'/polaganja/'. $data->id .'/delete" class="edit btn btn-primary btn-sm">Brisanje</a>';
                })
                ->rawColumns(['action', 'action_izmjena', 'action_brisanje'])
                ->make(true);
        }

        return view('zaposleni.polaganja', compact('zaposleni'));
    }

    public function createPolaganje(Zaposleni $zaposleni) {
        $rezultati = Rezultat::all();
        $ocjene = PrakticnaOcjena::all();
        return view('zaposleni.polaganje.create', compact('zaposleni', 'rezultati', 'ocjene'));
    }

    public function storePolaganje(PolaganjeRequest $request, Zaposleni $zaposleni) {
        $datum_polaganja = Carbon::parse($request->datum_polaganja);

        $polaganje = Test::create($request->validated());

        if (!$polaganje) {
            abort(500, 'Došlo je do greške prilikom čuvanja podataka!');
        }

        $zaposleni->datum_polaganja = $datum_polaganja;

        if ($request->rezultat_id == 1) {
            Podsjetnik::dispatch($zaposleni)->delay($datum_polaganja->addMinutes(3));
        }

        Session::flash('success', "Polaganje uspješno dodato!");
        return redirect()->route('zaposleni.edit', $zaposleni->id);
    }

    public function editPolaganje(Request $request, Zaposleni $zaposleni, Test $polaganje) {
        $switch = 'edit';
        $dokumenti = TestDokument::where('test_id', $polaganje->id)->get();
        $rezultati = Rezultat::all();
        $ocjene = PrakticnaOcjena::all();
        return view('zaposleni.polaganje.edit', compact('zaposleni', 'rezultati', 'polaganje', 'dokumenti', 'switch', 'ocjene'));
    }

    public function showPolaganje(Request $request, Zaposleni $zaposleni, Test $polaganje) {
        $switch = 'view';
        $dokumenti = TestDokument::where('test_id', $polaganje->id)->get();
        $rezultati = Rezultat::all();
        $ocjene = PrakticnaOcjena::all();
        return view('zaposleni.polaganje.show', compact('zaposleni', 'rezultati', 'polaganje', 'dokumenti', 'switch', 'ocjene'));
    }

    public function updatePolaganje(Request $request, Zaposleni $zaposleni, Test $polaganje) {
        $polaganje->fill($request->validated());
        
        if (!$polaganje->save()) {
            abort(500, 'Došlo je do greške prilikom čuvanja podataka!');
        }

        Session::flash('success', "Izmjena uspješno sačuvana!");
        return redirect()->route('zaposleni.edit', $zaposleni->id);
    }

    public function deletePolaganje(Request $request, Zaposleni $zaposleni, Test $polaganje) {
        return view('zaposleni.polaganje.delete', compact('zaposleni', 'polaganje'));
    }

    public function postDeletePolaganje(Request $request, Zaposleni $zaposleni, Test $polaganje) {
        $polaganje->status = 0;
        $polaganje->save();
        Session::flash('success', "Polaganje uspješno obrisano!");
        return redirect()->route('zaposleni.edit', $zaposleni->id);
    }

    public function storeDokumenti(Request $request, Test $polaganje) {
        if($request->file('dokument')) {

            if (!$this->documentService->store($request->file('dokument'), $polaganje)) {
                return response()->json([
                    'message_type' => 'error',
                    'message_title' => 'Greska',
                    'message_content' => 'Doslo je do greske prilikom dodavanja dokumenta'
                ], 500);
            }

            return response()->json([
                'message_type' => 'success',
                'message_title' => 'Sačuvano',
                'message_content' => 'Dokumenta uspješno sačuvana.'
            ]);
        }
    }

    public function brisanjeDokumenta(Request $request) {
	    if ($request->ajax()) {
            if (!TestDokument::where('id', $request->idDokumenta)->delete()) {
                return response()->json([
                    'message_type' => 'error',
                    'message_title' => 'Greska',
                    'message_content' => 'Doslo je do greske prilikom brisanja dokumenta'
                ], 500);
            }

            return response()->json([
                'message_type' => 'success',
                'message_title' => 'Izbrisano',
                'message_content' => 'Dokument uspješno obrisana.'
            ]);
	    }
    }

    public function apiKomisija(Request $request, Test $polaganje) {
        $clanovi = TestKomisija::where('test_id', $polaganje->id)->pluck('komisija_id');
        return [
            'results' => KomisijaResource::collection(Komisija::whereIn('id', $clanovi)->get())
        ];
    }

    public function api(Request $request, VrstaObuke $vrsta_obuke) {
	    return [
		    /*
		'results' => ZaposleniResource::collection(
			Zaposleni::where('ime', 'LIKE', '%'.$request->input('term', '').'%')
			->orWhere('prezime', 'LIKE', '%'.$request->input('term', '').'%')
			->get()
		)*/

		'results' => ZaposleniResource::collection(
			DB::select(DB::raw("select zaposleni.* from zaposleni, vrsta_obuke, sluzba where zaposleni.sluzba_id = sluzba.id and vrsta_obuke.sluzba_id = sluzba.id and vrsta_obuke.id = $vrsta_obuke->id and (zaposleni.ime LIKE '%".$request->input('term', '')."%' or zaposleni.prezime LIKE '%".$request->input('term', '')."%')" ))
		)
	];
    }
}
