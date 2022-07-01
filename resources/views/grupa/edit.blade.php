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
        <form method="POST" action="{{ route('grupa.update', $grupa->id) }}">
            @csrf
            <div class="tab-content" id="tabsContent">
                <div class="tab-pane fade show active" id="osnovno" role="tabpanel" aria-labelledby="osnovno-tab">
                    <div class="mt-4">
                        <div class="table-responsive">
                            <div class="form-group form-default">
                                <label for="naziv">Naziv obuke</label>
                                <input type="text" name="naziv" id="naziv" class="form-control" value="{{ $grupa->naziv }}" />
                            </div>
                            <div class="form-group form-default">
                                <label for="vrsta_obuke_id">Vrsta obuke</label>
                                <select name="vrsta_obuke_id" id="vrsta_obuke_id" class="form-control" required>
                                    <option value="">Odaberite vrstu obuke</option>
                                    @foreach ($vrste_obuke as $vrsta)
                                    <option value="{{ $vrsta->id }}" {{ ($vrsta->id == $grupa->vrsta_obuke_id) ? 'selected' : '' }}>{{ $vrsta->naziv }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group form-default">
                                <label for="status">Bodovi</label>
                                <div class="d-flex align-items-center">
                                    <input type="number" name="bodova_za_prolaz" id="bodova_za_prolaz" class="form-control" required value="{{ $grupa->bodova_za_prolaz }}" />
                                    <span class="px-2">/</span>
                                    <input type="number" name="ukupno_bodova" id="ukupno_bodova" class="form-control" required value="{{ $grupa->ukupno_bodova }}" />
                                </div>
                            </div>
                            <div class="form-group form-default">
                                <label for="pocetak_obuke">Početak obuke</label>
                                <input type="date" name="pocetak_obuke" id="pocetak_obuke" class="form-control" required value="{{ $grupa->pocetak_obuke }}" />
                            </div>
                            <div class="form-group form-default">
                                <label for="kraj_obuke">Kraj obuke</label>
                                <input type="date" name="kraj_obuke" id="kraj_obuke" class="form-control" required value="{{ $grupa->kraj_obuke }}" />
                            </div>
                            <div class="form-group form-default">
                                <label for="datum_polaganja">Datum polaganja</label>
                                <input type="date" name="datum_polaganja" id="datum_polaganja" class="form-control" required value="{{ $grupa->datum_polaganja }}" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="kandidati" role="tabpanel" aria-labelledby="kandidati-tab">
                    <div class="mt-4">
                        <div class="table-responsive">
                            <div class="form-group form-default">
                                <label for="zaposleni_id" class="d-block">Kandidati</label>
                                <select name="zaposleni[]" id="zaposleni_id" class="form-control" required multiple="multiple">
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="komisija" role="tabpanel" aria-labelledby="komisija-tab">
                    <div class="mt-4">
                        <div class="table-responsive">
                            <div class="form-group form-default">
                                <label for="komisija_id" class="d-block">Komisija</label>
                                <select name="komisija[]" id="komisija_id" class="form-control" required multiple="multiple">
                                </select>
                            </div>
                        </div>
                    </div>
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
                <input type="submit" class="btn btn-success float-right" value="Sačuvaj" />
            </div>
        </form>

    </div>
</div>
@endsection

@section('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/sr.js"></script>
<script type="text/javascript">
    $("#pocetak_obuke, #kraj_obuke, #datum_polaganja").flatpickr({
        altInput: true,
        altFormat: "d.m.Y",
        "locale": "sr"
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#zaposleni_id').select2({
            ajax: {
                minimumInputLength: 3,
                url: '{{ route("api.zaposleni", $grupa->vrsta_obuke_id) }}',
                dataType: 'json',
            },
        });

        $('#vrsta_obuke_id').on('change', function() {
            var vrsta_obuke = this.value;
            $('#zaposleni_id').empty();
            $('#zaposleni_id').select2({
                ajax: {
                    minimumInputLength: 3,
                    url: window.location.protocol + '//' + window.location.hostname + '/api/zaposleni/' + vrsta_obuke,
                    dataType: 'json'
                }
            });

        });

        $.ajax({
            type: 'GET',
            url: '{{ route("api.grupaZaposleni", $grupa->id) }}'
        }).then(function(data) {
            let results = data.results;
            results.forEach(item => {
                let option = new Option(item.text, item.id, true, true);
                $('#zaposleni_id').append(option).trigger('change');

                $('#zaposleni_id').trigger({
                    type: 'select2:select',
                    params: {
                        data: item
                    }
                });
            });

        });

        $('#komisija_id').select2({
            ajax: {
                minimumInputLength: 3,
                url: '{{ route("api.komisija") }}',
                dataType: 'json',
            },
        });

        $.ajax({
            type: 'GET',
            url: '{{ route("api.grupaKomisija", $grupa->id) }}'
        }).then(function(data) {
            let results = data.results;
            results.forEach(item => {
                let option = new Option(item.text, item.id, true, true);
                $('#komisija_id').append(option).trigger('change');

                $('#komisija_id').trigger({
                    type: 'select2:select',
                    params: {
                        data: item
                    }
                });
            });

        });

        $('#predavac_id').select2({
            ajax: {
                minimumInputLength: 3,
                url: '{{ route("api.predavac") }}',
                dataType: 'json',
            },
        });

        $.ajax({
            type: 'GET',
            url: '{{ route("api.grupaPredavaci", $grupa->id) }}'
        }).then(function(data) {
            let results = data.results;
            results.forEach(item => {
                let option = new Option(item.text, item.id, true, true);
                $('#predavac_id').append(option).trigger('change');

                $('#predavac_id').trigger({
                    type: 'select2:select',
                    params: {
                        data: item
                    }
                });
            });

        });
    });
</script>
@endsection
