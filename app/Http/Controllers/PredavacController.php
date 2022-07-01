<?php

namespace App\Http\Controllers;

use App\Models\Predavac;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
use App\Http\Resources\PredavacResource;

class PredavacController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            return Datatables::of(Predavac::where('status', 1))
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    return '<a href="/predavaci/'. $data->id .'" class="edit btn btn-primary btn-sm">Pregled</a>';
                })
                ->addColumn('action_izmjena', function($data){
                    return '<a href="/predavaci/'. $data->id .'/edit" class="edit btn btn-primary btn-sm">Izmjena</a>';
                })
                ->addColumn('action_brisanje', function($data){
                    return '<a href="/predavaci/'. $data->id .'/delete" class="edit btn btn-primary btn-sm">Brisanje</a>';
                })
                ->rawColumns(['action', 'action_izmjena', 'action_brisanje'])
                ->make(true);
        }

        return view('predavac.index');
    }

    public function create() {
        return view('predavac.create');
    }

    public function store(Request $request) {
        $predavac = Predavac::create([
            'ime' => $request->ime,
            'prezime' => $request->prezime
        ]);
        Session::flash('success', "Predavač uspješno dodat!");
        return redirect()->route('predavac.index');
    }

    public function show(Request $request, Predavac $predavac) {
        return view('predavac.show', compact('predavac'));
    }

    public function edit(Request $request, Predavac $predavac) {
        return view('predavac.edit', compact('predavac'));
    }

    public function update(Request $request, Predavac $predavac) {
        $predavac->ime = $request->ime;
        $predavac->prezime = $request->prezime;
        $predavac->save();
        Session::flash('success', "Izmjene uspješno sačuvane!");
        return redirect()->route('predavac.index');
    }

    public function getDelete(Request $request, Predavac $predavac) {
        return view('predavac.delete', compact('predavac'));
    }

    public function delete(Request $request, Predavac $predavac) {
        $predavac->status = 0;
        $predavac->save();
        Session::flash('success', "Predavač uspješno obrisan!");
        return redirect()->route('predavac.index');
    }

    public function api(Request $request) {
    	return [
		'results' => PredavacResource::collection(
			Predavac::where('ime', 'LIKE', '%'.$request->input('term', '').'%')
			->orWhere('prezime', 'LIKE', '%'.$request->input('term', '').'%')
			->get()
		)
	];
    }
}
