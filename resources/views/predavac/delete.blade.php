@extends('layout.master')

@section('content')
<div class="card shadow mb-4 col-md-6 pl-0 pr-0">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">{{ $predavac->ime }} {{ $predavac->prezime }}</h6>
      </div>
    <div class="card-body">
        <form method="POST" action="{{ route('predavac.delete', $predavac->id) }}">
            @csrf
            <div class="table-responsive">
                <div class="form-group form-default">
                    <p>Da li ste sigurni da želite obrisati predavača?</p>
                </div>
                <input type="submit" class="btn btn-primary" value="Obriši" />
                <a href="{{ route('predavac.index') }}" class="btn btn-secondary">Nazad</a>
            </div>
        </form>
    </div>
</div>
@endsection