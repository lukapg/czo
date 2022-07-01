@extends('layout.master')

@section('content')
<div class="card shadow mb-4 col-md-6 pl-0 pr-0">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Unos nove grupe</h6>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('grupa.store') }}">
            @csrf
            <div class="table-responsive">
                <div class="form-group form-default">
                    <label for="vrsta_obuke_id">Vrsta obuke</label>
                    <select name="vrsta_obuke_id" id="vrsta_obuke_id" class="form-control" required>
                        <option value="">-- Odaberite vrstu obuke --</option>
                        @foreach ($vrste_obuke as $vrsta)
                        <option value="{{ $vrsta->id }}">{{ $vrsta->naziv }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group form-default">
                    <label for="komisija_id">Predavači</label>
                    <select name="predavac[]" id="predavac_id" class="form-control" required multiple="multiple">
                    </select>
                </div>
                <div class="form-group form-default">
                    <label for="komisija_id">Komisija</label>
                    <select name="komisija[]" id="komisija_id" class="form-control" required multiple="multiple">
                    </select>
                </div>
                <div class="form-group form-default">
                    <label for="status">Bodovi</label>
                    <div class="d-flex align-items-center">
                        <input type="number" name="bodova_za_prolaz" id="bodova_za_prolaz" class="form-control" required placeholder="Broj bodova za prolaz" />
                        <span class="px-2">/</span>
                        <input type="number" name="ukupno_bodova" id="ukupno_bodova" class="form-control" required placeholder="Ukupno bodova" />
                    </div>
                </div>
                <div class="form-group form-default">
                    <label for="pocetak_obuke">Početak obuke</label>
                    <input type="date" name="pocetak_obuke" id="pocetak_obuke" class="form-control" required />
                </div>
                <div class="form-group form-default">
                    <label for="kraj_obuke">Kraj obuke</label>
                    <input type="date" name="kraj_obuke" id="kraj_obuke" class="form-control" required />
                </div>
                <div class="form-group form-default">
                    <label for="datum_polaganja">Datum polaganja</label>
                    <input type="date" name="datum_polaganja" id="datum_polaganja" class="form-control" required />
                </div>
                <div class="form-group form-default">
                    <label for="zaposleni_id">Kandidati</label>
                    <select name="zaposleni[]" id="zaposleni_id" class="form-control" required multiple="multiple">
                    </select>
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
        $('#komisija_id').select2({
            ajax: {
                minimumInputLength: 3,
                url: '{{ route("api.komisija") }}',
                dataType: 'json'
            },
        });

        $('#predavac_id').select2({
            ajax: {
                minimumInputLength: 3,
                url: '{{ route("api.predavac") }}',
                dataType: 'json'
            },
        });

        $('#vrsta_obuke_id').on('change', function() {
            var vrsta_obuke = this.value;
            $('#zaposleni_id').select2({
                ajax: {
                    minimumInputLength: 3,
                    url: window.location.protocol + '//' + window.location.hostname + '/api/zaposleni/' + vrsta_obuke,
                    dataType: 'json'
                }
            });
        });
    });
</script>
@endsection