@extends('layout.master')

@section('content')
<div class="card shadow mb-4 col-md-6 pl-0 pr-0">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Grupa {{ $grupa->naziv }} - {{ \Carbon\Carbon::parse($grupa->pocetak_obuke)->format('d.m.Y') }} - {{ \Carbon\Carbon::parse($grupa->kraj_obuke)->format('d.m.Y') }}</h6>
    </div>
    <div class="card-body">
        <ul class="nav nav-tabs" id="tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="osnovno-tab" data-toggle="tab" href="#osnovno" role="tab" aria-controls="osnovno" aria-selected="true">Osnovni podaci</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="kandidati-tab" data-toggle="tab" href="#kandidati" role="tab" aria-controls="kandidati" aria-selected="false">Kandidati</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="komisija-tab" data-toggle="tab" href="#komisija" role="tab" aria-controls="komisija" aria-selected="false">Komisija</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="predavac-tab" data-toggle="tab" href="#predavac" role="tab" aria-controls="predavac" aria-selected="false">Predavači</a>
            </li>
        </ul>
        <div class="tab-content" id="tabsContent">
            <div class="tab-pane fade show active" id="osnovno" role="tabpanel" aria-labelledby="osnovno-tab">
                <div class="mt-4">
                    <div class="table-responsive">
                        <div class="form-group form-default">
                            <label for="naziv">Naziv obuke</label>
                            <input type="text" name="naziv" id="naziv" class="form-control" value="{{ $grupa->naziv }}" disabled />
                        </div>
                        <div class="form-group form-default">
                            <label for="vrsta_obuke_id">Vrsta obuke</label>
                            <select name="vrsta_obuke_id" id="vrsta_obuke_id" class="form-control" disabled>
                                <option value="">Odaberite vrstu obuke</option>
                                @foreach ($vrste_obuke as $vrsta)
                                <option value="{{ $vrsta->id }}" {{ ($vrsta->id == $grupa->vrsta_obuke_id) ? 'selected' : '' }}>{{ $vrsta->naziv }}</option>
                                @endforeach
                            </select>
                            </div>
                        <div class="form-group form-default">
                            <label for="status">Bodovi</label>
                            <div class="d-flex align-items-center">
                                <input type="number" name="bodova_za_prolaz" id="bodova_za_prolaz" class="form-control" disabled value="{{ $grupa->bodova_za_prolaz }}" />
                                <span class="px-2">/</span>
                                <input type="number" name="ukupno_bodova" id="ukupno_bodova" class="form-control" disabled value="{{ $grupa->ukupno_bodova }}" />
                            </div>
                        </div>
                        <div class="form-group form-default">
                            <label for="pocetak_obuke">Početak obuke</label>
                            <input type="date" name="pocetak_obuke" id="pocetak_obuke" class="form-control" value="{{ $grupa->pocetak_obuke}}" disabled />
                        </div>
                        <div class="form-group form-default">
                            <label for="kraj_obuke">Kraj obuke</label>
                            <input type="date" name="kraj_obuke" id="kraj_obuke" class="form-control" value="{{ $grupa->kraj_obuke }}" disabled />
                        </div>
                        <div class="form-group form-default">
                            <label for="datum_polaganja">Datum polaganja</label>
                            <input type="date" name="datum_polaganja" id="datum_polaganja" class="form-control" value="{{ $grupa->datum_polaganja }}" disabled />
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="kandidati" role="tabpanel" aria-labelledby="kandidati-tab">
                <table class="table table-bordered mt-4">
                    <thead>
                        <th>Zaposleni</th>
                        <th>Predlog sektora</th>
                        <th>Radno mjesto</th>
			<th>Zaštita na radu?</th>
			<th>Organizacija smještaja</th>
                    </thead>
                    <tbody>
                        @foreach($zaposleni as $zap)
                        <tr>
                            <td class="font-weight-bold">
                                {{$zap->ime}} {{$zap->prezime}}
                            </td>
                            <td>
                                {{ $zap->sektor }} - {{ $zap->sluzba }}
                            </td>
                            <td>
                                {{ $zap->radno_mjesto }}
                            </td>
                            <td>
                                {{ $zap->zastita_na_radu ? 'Da' : 'Ne' }}
			    </td>
			    <td>
				{{ $zap->organizacija_smjestaja ? 'Da' : 'Ne' }}
			    </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="komisija" role="tabpanel" aria-labelledby="komisija-tab">
                <table class="table table-bordered mt-4">
                    <thead>
                        <th>Ime</th>
                        <th>Prezime</th>
                    </thead>
                    <tbody>
                        @foreach($komisija as $clan)
                        <tr>
                            <td>
                                {{$clan->ime}}
                            </td>
                            <td>
                                {{$clan->prezime}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="predavac" role="tabpanel" aria-labelledby="predavac-tab">
                <div class="mt-4">
                    <div class="table-responsive">
                        <div class="form-group form-default">
                            <label for="predavac_id" class="d-block">Predavači</label>
                            <select name="predavac[]" id="predavac_id" class="form-control" required multiple="multiple">
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script type="text/javascript">
    $(document).ready(function() {
        $('#zaposleni_id').select2({
            ajax: {
                minimumInputLength: 3,
                url: '{{ route("api.zaposleni", $grupa->vrsta_obuke_id) }}',
                dataType: 'json',
            },
        });

        $('#komisija_id').select2({
            ajax: {
                minimumInputLength: 3,
                url: '{{ route("api.komisija") }}',
                dataType: 'json',
            },
        });

        $('#predavac_id').select2({
            ajax: {
                minimumInputLength: 3,
                url: '{{ route("api.predavac") }}',
                dataType: 'json',
            },
        });
    });
</script>
