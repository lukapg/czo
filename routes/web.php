<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\KomisijaController;
use App\Http\Controllers\PredavacController;
use App\Http\Controllers\ZaposleniController;
use App\Http\Controllers\SektorController;
use App\Http\Controllers\VrstaObukeController;
use App\Http\Controllers\GrupaController;
use App\Http\Controllers\EvidencijaController;
use App\Models\Zaposleni;
use Illuminate\Support\Facades\Route;

Route::get('/predavaci', [PredavacController::class, 'index'])->name('predavac.index')->middleware('auth', 'can:admin');
Route::get('/predavaci/create', [PredavacController::class, 'create'])->name('predavac.create')->middleware('auth', 'can:czo');
Route::post('/predavaci/create', [PredavacController::class, 'store'])->name('predavac.store')->middleware('auth', 'can:czo');
Route::get('/predavaci/{predavac}', [PredavacController::class, 'show'])->name('predavac.show')->middleware('auth', 'can:admin');
Route::get('/predavaci/{predavac}/edit', [PredavacController::class, 'edit'])->name('predavac.edit')->middleware('auth', 'can:czo');
Route::post('/predavaci/{predavac}/edit', [PredavacController::class, 'update'])->name('predavac.update')->middleware('auth', 'can:czo');
Route::get('/predavaci/{predavac}/delete', [PredavacController::class, 'getDelete'])->name('predavac.getDelete')->middleware('auth', 'can:czo');
Route::post('/predavaci/{predavac}/delete', [PredavacController::class, 'delete'])->name('predavac.delete')->middleware('auth', 'can:czo');

Route::get('/vrste_obuke', [VrstaObukeController::class, 'index'])->name('vrsta_obuke.index')->middleware('auth', 'can:admin');
Route::get('/vrste_obuke/create', [VrstaObukeController::class, 'create'])->name('vrsta_obuke.create')->middleware('auth', 'can:czo');
Route::post('/vrste_obuke/create', [VrstaObukeController::class, 'store'])->name('vrsta_obuke.store')->middleware('auth', 'can:czo');
Route::get('/vrste_obuke/{vrsta}', [VrstaObukeController::class, 'show'])->name('vrsta_obuke.show')->middleware('auth', 'can:admin');
Route::get('/vrste_obuke/{vrsta}/edit', [VrstaObukeController::class, 'edit'])->name('vrsta_obuke.edit')->middleware('auth', 'can:czo');
Route::post('/vrste_obuke/{vrsta}/edit', [VrstaObukeController::class, 'update'])->name('vrsta_obuke.update')->middleware('auth', 'can:czo');
Route::get('/vrste_obuke/{vrsta}/delete', [VrstaObukeController::class, 'getDelete'])->name('vrsta_obuke.getDelete')->middleware('auth', 'can:czo');
Route::post('/vrste_obuke/{vrsta}/delete', [VrstaObukeController::class, 'delete'])->name('vrsta_obuke.delete')->middleware('auth', 'can:czo');

Route::get('/', [ZaposleniController::class, 'index'])->name('zaposleni.index')->middleware('auth');
Route::get('/zaposleni/create', [ZaposleniController::class, 'create'])->name('zaposleni.create')->middleware('auth', 'can:admin');
Route::post('/zaposleni/create', [ZaposleniController::class, 'store'])->name('zaposleni.store')->middleware('auth', 'can:admin');
Route::get('/zaposleni/{zaposleni}', [ZaposleniController::class, 'show'])->name('zaposleni.show')->middleware('auth', 'can:pregled');
Route::get('/zaposleni/{zaposleni}/edit', [ZaposleniController::class, 'edit'])->name('zaposleni.edit')->middleware('auth', 'can:uljr');
Route::get('/zaposleni/{zaposleni}/delete', [ZaposleniController::class, 'delete'])->name('zaposleni.delete')->middleware('auth', 'can:admin');
Route::post('/zaposleni/{zaposleni}/delete', [ZaposleniController::class, 'postDelete'])->name('zaposleni.postDelete')->middleware('auth', 'can:admin');
Route::post('/zaposleni/{zaposleni}/edit', [ZaposleniController::class, 'update'])->name('zaposleni.update')->middleware('auth', 'can:admin');
Route::post('/zaposleni/brisanje_dokumenta', [ZaposleniController::class, 'brisanjeDokumenta'])->name('zaposleni.brisanjeDokumenta')->middleware('auth', 'can:admin');

Route::get('/sektor/{sektor}/sluzbe', [SektorController::class, 'getSluzbe'])->name('sektori.getSluzbe')->middleware('auth');

Route::get('/zaposleni/{zaposleni}/polaganja', [ZaposleniController::class, 'polaganja'])->name('zaposleni.polaganja')->middleware('auth', 'can:pregled');
Route::get('/zaposleni/{zaposleni}/polaganja/create', [ZaposleniController::class, 'createPolaganje'])->name('zaposleni.polaganja.create')->middleware('auth', 'can:admin');
Route::post('/zaposleni/{zaposleni}/polaganja/create', [ZaposleniController::class, 'storePolaganje'])->name('zaposleni.polaganja.store')->middleware('auth', 'can:admin');
Route::get('/zaposleni/{zaposleni}/polaganja/{polaganje}', [ZaposleniController::class, 'showPolaganje'])->name('zaposleni.polaganja.show')->middleware('auth', 'can:pregled');
Route::get('/zaposleni/{zaposleni}/polaganja/{polaganje}/edit', [ZaposleniController::class, 'editPolaganje'])->name('zaposleni.polaganja.edit')->middleware('auth', 'can:uljr');
Route::post('/zaposleni/{zaposleni}/polaganja/{polaganje}/edit', [ZaposleniController::class, 'updatePolaganje'])->name('zaposleni.polaganja.update')->middleware('auth', 'can:uljr');
Route::get('/zaposleni/{zaposleni}/polaganja/{polaganje}/delete', [ZaposleniController::class, 'deletePolaganje'])->name('zaposleni.polaganja.delete')->middleware('auth', 'can:admin');
Route::post('/zaposleni/{zaposleni}/polaganja/{polaganje}/delete', [ZaposleniController::class, 'postDeletePolaganje'])->name('zaposleni.polaganja.postDelete')->middleware('auth', 'can:admin');
Route::post('/polaganja/{polaganje}/dokumenti', [ZaposleniController::class, 'storeDokumenti'])->name('zaposleni.polaganja.dokumenti.store')->middleware('auth', 'can:uljr');

Route::get('/komisija', [KomisijaController::class, 'index'])->name('komisija.index')->middleware('auth', 'can:admin');
Route::get('/komisija/create', [KomisijaController::class, 'create'])->name('komisija.create')->middleware('auth', 'can:czo');
Route::post('/komisija/create', [KomisijaController::class, 'store'])->name('komisija.store')->middleware('auth', 'can:czo');
Route::get('/komisija/{clan}', [KomisijaController::class, 'show'])->name('komisija.show')->middleware('auth', 'can:admin');
Route::get('/komisija/{clan}/edit', [KomisijaController::class, 'edit'])->name('komisija.edit')->middleware('auth', 'can:czo');
Route::post('/komisija/{clan}/edit', [KomisijaController::class, 'update'])->name('komisija.update')->middleware('auth', 'can:czo');
Route::get('/komisija/{clan}/delete', [KomisijaController::class, 'getDelete'])->name('komisija.getDelete')->middleware('auth', 'can:czo');
Route::post('/komisija/{clan}/delete', [KomisijaController::class, 'delete'])->name('komisija.delete')->middleware('auth', 'can:czo');

Route::get('/grupe', [GrupaController::class, 'index'])->name('grupa.index')->middleware('auth', 'can:admin');
Route::get('/grupe/create', [GrupaController::class, 'create'])->name('grupa.create')->middleware('auth', 'can:admin');
Route::get('/grupe/create/{grupa}/confirm', [GrupaController::class, 'confirm'])->name('grupa.confirm')->middleware('auth', 'can:admin');
Route::post('/grupe/create/{grupa}/confirm', [GrupaController::class, 'storeConfirm'])->name('grupa.storeConfirm')->middleware('auth', 'can:admin');
Route::post('/grupe/create/{grupa}/confirm/delete/{zaposleni}', [GrupaController::class, 'deleteTempZaposleni'])->name('grupa.deleteTempZaposleni')->middleware('auth', 'can:admin');
Route::post('/grupe/create', [GrupaController::class, 'store'])->name('grupa.store')->middleware('auth', 'can:admin');
Route::get('/grupe/{grupa}', [GrupaController::class, 'show'])->name('grupa.show')->middleware('auth', 'can:admin');
Route::get('/grupe/{grupa}/edit', [GrupaController::class, 'edit'])->name('grupa.edit')->middleware('auth', 'can:admin');
Route::post('/grupe/{grupa}/edit', [GrupaController::class, 'update'])->name('grupa.update')->middleware('auth', 'can:admin');

Route::get('/evidencija', [EvidencijaController::class, 'index'])->name('evidencija.index')->middleware('auth', 'can:admin');
Route::get('/evidencija/{grupa}', [EvidencijaController::class, 'grupa'])->name('evidencija.grupa')->middleware('auth', 'can:admin');

Auth::routes(['register' => false]);

Route::get('logout', [LoginController::class, 'logout'])->name('logout');
