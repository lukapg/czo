@extends('layout.master')

@section('content')
<div class="card shadow mb-4 col-md-6 pl-0 pr-0">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{ $zaposleni->ime }} {{ $zaposleni->prezime }}</h6>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('zaposleni.store') }}">
            @csrf
            <div class="table-responsive">
                <div class="form-group form-default">
                    <label for="ime">Ime</label>
                    <input type="text" name="ime" id="ime" class="form-control" value="{{ $zaposleni->ime }}" disabled />
                </div>
                <div class="form-group form-default">
                    <label for="prezime">Prezime</label>
                    <input type="text" name="prezime" id="prezime" class="form-control" value="{{ $zaposleni->prezime }}" disabled />
                </div>
                <div class="form-group form-default">
                    <label for="prezime">Telefon</label>
                    <input type="text" name="telefon" id="telefon" class="form-control" value="{{ $zaposleni->telefon }}" disabled />
                </div>
                <div class="form-group form-default">
                    <label for="prezime">E-mail adresa</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $zaposleni->email }}" disabled />
                </div>
                <div class="form-group form-default">
                    <label for="prezime">Adresa</label>
                    <input type="text" name="adresa" id="adresa" class="form-control" value="{{ $zaposleni->adresa }}" disabled />
                </div>
                <div class="form-group form-default">
                    <label for="sektor_id">Sektor</label>
                    <select name="sektor_id" id="sektor_id" class="form-control" disabled>
                        @foreach ($sektori as $sektor)
                            <option value="{{ $sektor->id }}" {{ ( $sektor->id == $zaposleni->sektor_id) ? 'selected' : '' }}>{{ $sektor->naziv }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group form-default">
                    <label for="sluzba_id">Služba</label>
                    <select name="sluzba_id" id="sluzba_id" class="form-control" disabled>
                        @foreach ($sluzbe as $sluzba)
                            <option value="{{ $sluzba->id }}" {{ ($sluzba->id == $zaposleni->sluzba_id) ? 'selected' : '' }} >{{ $sluzba->naziv }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group form-default">
                    <label for="region_id">Region</label>
                    <div class="d-flex align-items-center">
                        <div class="mr-4">
                            <input type="radio" id="pripada" name="pripada_regionu" value="1" {{ ($zaposleni->pripada_regionu == 1) ? "checked" : "" }} onclick="return false;">
                            <label for="pripada">Pripada regionu</label>
                        </div>
                        <div>
                            <input type="radio" id="ne_pripada" name="pripada_regionu" value="0" {{ ($zaposleni->pripada_regionu == 0) ? "checked" : "" }} onclick="return false;">
                            <label for="ne_pripada">Ne pripada regionu</label>
                        </div>
                    </div>
                    <select name="region_id" id="region_id" class="form-control" disabled>
                        @foreach ($regioni as $region)
                            <option value="{{ $region->id }}" {{ ( $region->id == $zaposleni->region_id) ? 'selected' : '' }}>{{ $region->naziv }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group form-default">
                    <label for="radno_mjesto">Radno mjesto</label>
                    <input type="text" name="radno_mjesto" id="radno_mjesto" class="form-control" value="{{ $zaposleni->radno_mjesto }}" disabled />
                </div>
                <div class="form-group form-default">
                    <label for="mjesto_rada">Mjesto rada</label>
                    <input type="text" name="mjesto_rada" id="mjesto_rada" class="form-control" value="{{ $zaposleni->mjesto_rada }}" disabled />
                </div>
                <div class="form-group form-default">
                    <input type="checkbox" name="zastita_na_radu" id="zastita_na_radu" {{ ($zaposleni->zastita_na_radu == 1) ? "checked" : "" }} disabled /><span class="pl-2">Zaštita na radu?</span>
                </div>
                <div class="form-group form-default">
                    <input type="checkbox" name="organizacija_smjestaja" id="organizacija_smjestaja" {{ ($zaposleni->organizacija_smjestaja == 1) ? "checked" : "" }} disabled /><span class="pl-2">Organizacija smještaja?</span>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection