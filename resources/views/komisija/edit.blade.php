@extends('layout.master')

@section('content')
<div class="card shadow mb-4 col-md-6 pl-0 pr-0">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{ $clan->ime }} {{ $clan->prezime }}</h6>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('komisija.update', $clan->id) }}">
            @csrf
            <div class="table-responsive">
                <div class="form-group form-default">
                    <label for="ime">Ime</label>
                    <input type="text" name="ime" id="ime" class="form-control" value="{{ $clan->ime }}" />
                </div>
                <div class="form-group form-default">
                    <label for="prezime">Prezime</label>
                    <input type="text" name="prezime" id="prezime" class="form-control" value="{{ $clan->prezime }}" />
                </div>
            </div>
            <input type="submit" class="btn btn-success float-right" value="Sačuvaj" />
        </form>
    </div>
</div>
@endsection
