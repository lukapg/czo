<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KomisijaController;
use App\Http\Controllers\ZaposleniController;
use App\Http\Controllers\GrupaController;
use App\Http\Controllers\PredavacController;

Route::get('/komisija', [KomisijaController::class, 'api'])->name('api.komisija');
Route::get('/predavac', [PredavacController::class, 'api'])->name('api.predavac');
Route::get('/zaposleni/{vrsta_obuke}', [ZaposleniController::class, 'api'])->name('api.zaposleni');

Route::get('/grupe/{grupa}/komisija', [GrupaController::class, 'apiKomisija'])->name('api.grupaKomisija');

Route::get('/grupe/{grupa}/zaposleni', [GrupaController::class, 'apiGrupaZaposleni'])->name('api.grupaZaposleni');

Route::get('/grupe/{grupa}/predavaci', [GrupaController::class, 'apiGrupaPredavaci'])->name('api.grupaPredavaci');

Route::post('/grupa/update_organizacija_smjestaja', [GrupaController::class, 'updateZaposleniOrganizacijaSmjestaja'])->name('api.updateZaposleniOrganizacijaSmjestaja');
