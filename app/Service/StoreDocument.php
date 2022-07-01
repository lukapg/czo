<?php

namespace App\Service;
use App\Models\TestDokument;

class StoreDocument {
    public function store($document, $polaganje) {
        foreach ($document as $file) { 
            $ekstenzija = $file->extension();
            $originalni_naziv = $file->getClientOriginalName();
            $novi_naziv = time() . uniqid(rand()) . "." . $ekstenzija;

            if (TestDokument::where('test_id', $polaganje->id)->where('naziv', $novi_naziv)->count() < 1) {
                //file upload
                $file->move(public_path() . '/obrasci/', $novi_naziv);
                
                //insert u tabelu dokumentacije
                $dokumentacija = new TestDokument;
                $dokumentacija->test_id = $polaganje->id;
                $dokumentacija->naziv = $novi_naziv;
                $dokumentacija->original_naziv = $originalni_naziv;

                if (!$dokumentacija->save()) {
                    return false;
                }
            }
        }

        return true;
    }
}