@extends('layout.master')

@section('content')
<div class="card shadow mb-4 col-md-6 pl-0 pr-0">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Unos novog člana komisije</h6>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('komisija.store') }}">
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
                <input type="submit" class="btn btn-success float-right" value="Sačuvaj" />
            </div>
        </form>
    </div>
</div>
@endsection
