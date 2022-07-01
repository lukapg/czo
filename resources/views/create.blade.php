@extends('layout.master')

@section('content')
<div class="card shadow mb-4 col-md-6 pl-0 pr-0">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Unos nove grupe</h6>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('grupa.store', $grupa->id) }}">
            @csrf
            <div class="table-responsive">
                <div class="form-group form-default">
                    <label for="pocetak_obuke">Početak obuke</label>
                    <input type="date" name="pocetak_obuke" id="pocetak_obuke" class="form-control" required />
                </div>
                <div class="form-group form-default">
                    <label for="kraj_obuke">Kraj obuke</label>
                    <input type="date" name="kraj_obuke" id="kraj_obuke" class="form-control" required />
                </div>
                <div class="form-group form-default">
                    <label for="zaposleni_id">Kandidati</label>
                        <select name="zaposleni[]" id="zaposleni_id" class="form-control" required multiple="multiple">
                    </select>
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
        $("#pocetak_obuke, #kraj_obuke").flatpickr({
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
                    url: '{{ route("api.zaposleni") }}',
                    dataType: 'json',
                },
            });
        });
    </script>
@endsection