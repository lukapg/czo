<?php

namespace App\Service;
use App\Models\GrupaKomisija;
use App\Models\GrupaPredavac;
use App\Models\TempGrupaZaposleni;
use App\Models\GrupaZaposleni;
use Illuminate\Support\Facades\DB;

class GrupaService {
    public function store($unos, $komisija, $predavac, $zaposleni) {
		try {
			DB::beginTransaction();

			foreach ($komisija as $clan) {
				$unos_komisija = GrupaKomisija::create([
					'grupa_id' => $unos->id,
					'komisija_id' => $clan
				]);
	
				if (!$unos_komisija) {
					return false;
				}
			}
	
			foreach ($predavac as $predavac) {
				$unos_predavac = GrupaPredavac::create([
					'grupa_id' => $unos->id,
					'predavac_id' => $predavac
				]);
	
				if (!$unos_predavac) {
					return false;
				}
			}
	
			foreach($zaposleni as $zaposleni) {
				$unos_zaposleni = TempGrupaZaposleni::create([
					'grupa_id' => $unos->id,
					'zaposleni_id' => $zaposleni
				]);
				if (!$unos_zaposleni) {
					return false;
				}
			}
			DB::commit();

		} catch (\PDOException $e) {
			DB::rollback();
		}

        return true;
    }

    public function update($grupa, $komisija, $predavac, $zaposleni) {
		try {
			DB::beginTransaction();

			$deleteKomisijaResult = GrupaKomisija::where('grupa_id', $grupa->id)->delete();

			if (!$deleteKomisijaResult) {
				return false;
			}

			foreach ($komisija as $clan) {
				$unos_komisija = GrupaKomisija::create([
					'grupa_id' => $grupa->id,
					'komisija_id' => $clan
				]);

				if (!$unos_komisija) {
					return false;
				}
			}

			$deletePredavacResult = GrupaPredavac::where('grupa_id', $grupa->id)->delete();

			if (!$deletePredavacResult) {
				return false;
			}

			foreach ($predavac as $predavac) {
				$unos_predavac = GrupaPredavac::create([
					'grupa_id' => $grupa->id,
					'predavac_id' => $predavac
				]);

				if (!$unos_predavac) {
					return false;
				}
			}

			foreach($zaposleni as $zaposleni) {
				$unos_zaposleni = TempGrupaZaposleni::create([
					'grupa_id' => $grupa->id,
					'zaposleni_id' => $zaposleni
				]);
				if (!$unos_zaposleni) {
					return false;
				}
			}

			$deleteGrupaResult = GrupaZaposleni::where('grupa_id', $grupa->id)->delete();

			if (!$deleteGrupaResult) {
				return false;
			}

			DB::commit();

		} catch (\PDOException $e) {
			DB::rollback();
		}

        return true;
    }
}