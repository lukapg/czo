@extends('layout.master')

@section('content')
<div class="card shadow mb-4 col-md-6 pl-0 pr-0">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Unos novog polaganja - {{ $zaposleni->ime }} {{ $zaposleni->prezime }}</h6>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('zaposleni.polaganja.store', $zaposleni->id) }}">
            @csrf
            <div class="table-responsive">
                <div class="form-group form-default">
                    <label for="datum_polaganja">Datum polaganja</label>
                    <input type="date" name="datum_polaganja" id="datum_polaganja" class="form-control" required />
                </div>
                <div class="form-group form-default">
                    <label for="status">Ocjena teorijski dio</label>
                    <div class="d-flex align-items-center">
                        <input type="number" name="ocjena_teorija_osvojeno" id="ocjena_teorija_osvojeno" class="form-control" required placeholder="Osvojeno..." />
                        <span class="px-2">/</span>
                        <input type="number" name="ocjena_teorija_ukupno" id="ocjena_teorija_ukupno" class="form-control" required placeholder="Ukupno..." />
                    </div>
                </div>
                <div class="form-group form-default">
                    <label for="prakticna_ocjena_id">Ocjena praktični dio</label>
                    <select name="prakticna_ocjena_id" id="prakticna_ocjena_id" class="form-control" required>
                        <option value="">Odaberite ocjenu</option>
                        @foreach ($ocjene as $ocjena)
                            <option value="{{ $ocjena->id }}">{{ $ocjena->naziv }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group form-default">
                    <label for="rezultat_id">Rezultat</label>
                    <select name="rezultat_id" id="rezultat_id" class="form-control" required>
                        @foreach ($rezultati as $rezultat)
                            <option value="{{ $rezultat->id }}">{{ $rezultat->naziv }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group form-default">
                    <label for="komentar">Komentar</label>
                    <textarea class="form-control" name="komentar" id="komentar" rows="6"></textarea>
                </div>
                <input type="submit" class="btn btn-primary" value="Sačuvaj" />
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
        $("#datum_polaganja").flatpickr({
            altInput: true,
            altFormat: "d.m.Y",
            "locale": "sr"
        });
    </script>
@endsection
