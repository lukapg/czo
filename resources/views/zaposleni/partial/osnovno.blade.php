<form method="POST" action="{{ route('zaposleni.update', $zaposleni->id) }}">
    @csrf
    <div class="table-responsive">
        <div class="form-group form-default">
            <label for="ime">Ime</label>
            <input type="text" name="ime" id="ime" class="form-control" value="{{ $zaposleni->ime }}" required />
        </div>
        <div class="form-group form-default">
            <label for="prezime">Prezime</label>
            <input type="text" name="prezime" id="prezime" class="form-control" value="{{ $zaposleni->prezime }}" required />
        </div>
        <div class="form-group form-default">
            <label for="prezime">Telefon</label>
            <input type="text" name="telefon" id="telefon" class="form-control" value="{{ $zaposleni->telefon }}" required />
        </div>
        <div class="form-group form-default">
            <label for="prezime">E-mail adresa</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $zaposleni->email }}" required />
        </div>
        <div class="form-group form-default">
            <label for="prezime">Adresa</label>
            <input type="text" name="adresa" id="adresa" class="form-control" value="{{ $zaposleni->adresa }}" required />
        </div>
        <div class="form-group form-default">
            <label for="sektor_id">Sektor</label>
            <select name="sektor_id" id="sektor_id" class="form-control" required>
                @foreach ($sektori as $sektor)
                    <option value="{{ $sektor->id }}" {{ ($sektor->id == $zaposleni->sektor_id) ? 'selected' : '' }} >{{ $sektor->naziv }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group form-default">
            <label for="sluzba_id">Služba</label>
            <select name="sluzba_id" id="sluzba_id" class="form-control" required>
                @foreach ($sluzbe as $sluzba)
                    <option value="{{ $sluzba->id }}" {{ ($sluzba->id == $zaposleni->sluzba_id) ? 'selected' : '' }} >{{ $sluzba->naziv }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group form-default">
            <label for="region_id">Region</label>
            <div class="d-flex align-items-center">
                <div class="mr-4">
                    <input type="radio" id="pripada" name="pripada_regionu" value="1" {{ ($zaposleni->pripada_regionu == 1) ? "checked" : "" }}>
                    <label for="pripada">Pripada regionu</label>
                </div>
                <div>
                    <input type="radio" id="ne_pripada" name="pripada_regionu" value="0" {{ ($zaposleni->pripada_regionu == 0) ? "checked" : "" }}>
                    <label for="ne_pripada">Ne pripada regionu</label>
                </div>
            </div>
            <select name="region_id" id="region_id" class="form-control" required {{ ($zaposleni->pripada_regionu == 0) ? "disabled" : "" }}>
                @foreach ($regioni as $region)
                    <option value="{{ $region->id }}" {{ ( $region->id == $zaposleni->region_id) ? 'selected' : '' }}>{{ $region->naziv }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group form-default">
            <label for="radno_mjesto">Radno mjesto</label>
            <input type="text" name="radno_mjesto" id="radno_mjesto" class="form-control" value="{{ $zaposleni->radno_mjesto }}" required />
        </div>
        <div class="form-group form-default">
            <label for="mjesto_rada">Mjesto rada</label>
            <input type="text" name="mjesto_rada" id="mjesto_rada" class="form-control" value="{{ $zaposleni->mjesto_rada }}" required />
        </div>
        <div class="form-group form-default">
            <input type="checkbox" name="zastita_na_radu" id="zastita_na_radu" {{ ($zaposleni->zastita_na_radu == 1) ? "checked" : "" }} /><span class="pl-2">Zaštita na radu?</span>
        </div>
        <div class="form-group form-default">
            <input type="checkbox" name="organizacija_smjestaja" id="organizacija_smjestaja" {{ ($zaposleni->organizacija_smjestaja == 1) ? "checked" : "" }} /><span class="pl-2">Organizacija smještaja?</span>
        </div>
        <input type="submit" class="btn btn-success float-right" value="Sačuvaj" />
    </div>
</form>
