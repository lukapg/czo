@extends('layout.master')

@section('content')
<div class="card shadow mb-4 col-md-6 pl-0 pr-0">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Unos novog zaposlenog</h6>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('zaposleni.store') }}">
            @csrf
            <div class="table-responsive">
                <div class="form-group form-default">
                    <label for="ime">Ime</label>
                    <input type="text" name="ime" id="ime" class="form-control" required />
                </div>
                <div class="form-group form-default">
                    <label for="prezime">Prezime</label>
                    <input type="text" name="prezime" id="prezime" class="form-control" required />
                </div>
                <div class="form-group form-default">
                    <label for="sektor_id">Sektor</label>
                    <select name="sektor_id" id="sektor_id" class="form-control" required>
                        <option value="">Odaberite sektor</option>
                        @foreach ($sektori as $sektor)
                        <option value="{{ $sektor->id }}">{{ $sektor->naziv }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group form-default">
                    <label for="prezime">Telefon</label>
                    <input type="text" name="telefon" id="telefon" class="form-control" />
                </div>
                <div class="form-group form-default">
                    <label for="prezime">E-mail adresa</label>
                    <input type="text" name="email" id="email" class="form-control" />
                </div>
                <div class="form-group form-default">
                    <label for="prezime">Adresa</label>
                    <input type="text" name="adresa" id="adresa" class="form-control" />
                </div>
                <div class="form-group form-default">
                    <label for="sluzba_id">Služba</label>
                    <select name="sluzba_id" id="sluzba_id" class="form-control" required disabled>
                    </select>
                </div>
                <div class="form-group form-default">
                    <label for="region_id">Region</label>
                    <div class="d-flex align-items-center">
                        <div class="mr-4">
                            <input type="radio" id="pripada" name="pripada_regionu" value="1" checked>
                            <label for="pripada">Pripada regionu</label>
                        </div>
                        <div>
                            <input type="radio" id="ne_pripada" name="pripada_regionu" value="0">
                            <label for="ne_pripada">Ne pripada regionu</label>
                        </div>
                    </div>
                    <select name="region_id" id="region_id" class="form-control" required>
                        @foreach ($regioni as $region)
                        <option value="{{ $region->id }}">{{ $region->naziv }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group form-default">
                    <label for="radno_mjesto">Radno mjesto</label>
                    <input type="text" name="radno_mjesto" id="radno_mjesto" class="form-control" required />
                </div>
                <div class="form-group form-default">
                    <label for="mjesto_rada">Mjesto rada</label>
                    <input type="text" name="mjesto_rada" id="mjesto_rada" class="form-control" required />
                </div>
                <div class="form-group form-default">
                    <input type="checkbox" name="zastita_na_radu" id="zastita_na_radu" /><span class="pl-2">Zaštita na radu?</span>
                </div>
                <div class="form-group form-default">
                    <input type="checkbox" name="organizacija_smjestaja" id="organizacija_smjestaja" /><span class="pl-2">Organizacija smještaja?</span>
                </div>
                <input type="submit" class="btn btn-success float-right" value="Sačuvaj" />
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="sektor_id"]').on('change', function() {
            var sektor_id = $(this).val();
            if (sektor_id) {
                $.ajax({
                    url: window.location.origin + '/sektor/' + sektor_id + '/sluzbe',
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="sluzba_id"]').empty();
                        $('select[name="sluzba_id"]').prop('disabled', false);
                        $.each(data, function(key, value) {
                            $('select[name="sluzba_id"]').append('<option value="' + value.id + '">' + value.naziv + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="sluzba_id"]').empty();
                $('select[name="sluzba_id"]').prop('disabled', true);
            }
        });

        $('input[name="pripada_regionu"]').on('change', function() {
            var vrijednost = $(this).val();
            if (vrijednost == 0) {
                $('select[name="region_id"]').prop('disabled', true);
                $('select[name="region_id"]').prop('required', false);
            } else {
                $('select[name="region_id"]').prop('disabled', false);
                $('select[name="region_id"]').prop('required', true);
            }
        });
    });
</script>
@endsection