<?php

namespace App\Http\Controllers;

use App\Models\Sluzba;
use App\Models\VrstaObuke;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class VrstaObukeController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            return Datatables::of(VrstaObuke::where('status', 1)->with('sluzba')->get())
                ->addIndexColumn()
                ->editColumn('sluzba_id', function($data){
                    return $data->sluzba->naziv;
                })
                ->addColumn('action', function($data){
                    return '<a href="/vrste_obuke/'. $data->id .'" class="edit btn btn-primary btn-sm">Pregled</a>';
                })
                ->addColumn('action_izmjena', function($data){
                    return '<a href="/vrste_obuke/'. $data->id .'/edit" class="edit btn btn-primary btn-sm">Izmjena</a>';
                })
                ->addColumn('action_brisanje', function($data){
                    return '<a href="/vrste_obuke/'. $data->id .'/delete" class="edit btn btn-primary btn-sm">Brisanje</a>';
                })
                ->rawColumns(['action', 'action_izmjena', 'action_brisanje'])
                ->make(true);
        }

        return view('vrsta_obuke.index');
    }

    public function create() {
        $sluzbe = Sluzba::all();
        return view('vrsta_obuke.create', compact('sluzbe'));
    }

    public function store(Request $request) {
        $vrsta = VrstaObuke::create([
            'sluzba_id' => $request->sluzba_id,
            'naziv' => $request->naziv
        ]);
        Session::flash('success', "Predavač uspješno dodat!");
        return redirect()->route('vrsta_obuke.index');
    }

    public function show(Request $request, VrstaObuke $vrsta) {
        $sluzbe = Sluzba::all();
        return view('vrsta_obuke.show', compact('vrsta', 'sluzbe'));
    }

    public function edit(Request $request, VrstaObuke $vrsta) {
        $sluzbe = Sluzba::all();
        return view('vrsta_obuke.edit', compact('vrsta', 'sluzbe'));
    }

    public function update(Request $request, VrstaObuke $vrsta) {
        $vrsta->ime = $request->ime;
        $vrsta->prezime = $request->prezime;
        $vrsta->save();
        Session::flash('success', "Izmjene uspješno sačuvane!");
        return redirect()->route('vrsta_obuke.index');
    }

    public function getDelete(Request $request, VrstaObuke $vrsta) {
        return view('vrsta_obuke.delete', compact('vrsta'));
    }

    public function delete(Request $request, VrstaObuke $vrsta) {
        $vrsta->status = 0;
        $vrsta->save();
        Session::flash('success', "Vrsta obuke uspješno obrisana!");
        return redirect()->route('vrsta_obuke.index');
    }
}
