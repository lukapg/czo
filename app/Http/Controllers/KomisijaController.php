<?php

namespace App\Http\Controllers;

use App\Http\Resources\KomisijaResource;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Komisija;
use Illuminate\Support\Facades\Session;

class KomisijaController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            return Datatables::of(Komisija::where('status', 1))
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    return '<a href="/komisija/'. $data->id .'" class="edit btn btn-primary btn-sm">Pregled</a>';
                })
                ->addColumn('action_izmjena', function($data){
                    return '<a href="/komisija/'. $data->id .'/edit" class="edit btn btn-primary btn-sm">Izmjena</a>';
                })
                ->addColumn('action_brisanje', function($data){
                    return '<a href="/komisija/'. $data->id .'/delete" class="edit btn btn-primary btn-sm">Brisanje</a>';
                })
                ->rawColumns(['action', 'action_izmjena', 'action_brisanje'])
                ->make(true);
        }

        return view('komisija.index');
    }

    public function create() {
        return view('komisija.create');
    }

    public function store(Request $request) {
        $clan = Komisija::create([
            'ime' => $request->ime,
            'prezime' => $request->prezime
        ]);
        Session::flash('success', "Član komisije uspješno dodat!");
        return redirect()->route('komisija.index');
    }

    public function edit(Request $request, Komisija $clan) {
        return view('komisija.edit', compact('clan'));
    }

    public function update(Request $request, Komisija $clan) {
        $clan->ime = $request->ime;
        $clan->prezime = $request->prezime;
        $clan->save();
        Session::flash('success', "Član komisije uspješno ažuriran!");
        return redirect()->route('komisija.index');
    }

    public function show(Request $request, Komisija $clan) {
        return view('komisija.show', compact('clan'));
    }

    public function getDelete(Request $request, Komisija $clan) {
        return view('komisija.delete', compact('clan'));
    }

    public function delete(Request $request, Komisija $clan) {
        $clan->status = 0;
        $clan->save();
        Session::flash('success', "Član komisije uspješno obrisan!");
        return redirect()->route('komisija.index');
    }

    public function api(Request $request) {
        return [
            'results' => KomisijaResource::collection(
                Komisija::where('ime', 'LIKE', '%'.$request->input('term', '').'%')
                ->orWhere('prezime', 'LIKE', '%'.$request->input('term', '').'%')
                ->get()
            )
        ];
    }
}
