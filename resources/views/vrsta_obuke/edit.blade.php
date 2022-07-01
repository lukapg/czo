@extends('layout.master')

@section('content')
<div class="card shadow mb-4 col-md-6 pl-0 pr-0">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{ $vrsta->naziv }}</h6>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('vrsta_obuke.update', $vrsta->id) }}">
            @csrf
            <div class="table-responsive">
                <div class="form-group form-default">
                    <label for="sluzba_id">Služba</label>
                    <select name="sluzba_id" id="sluzba_id" class="form-control" required>
                        @foreach ($sluzbe as $sluzba)
                            <option value="{{ $sluzba->id }}" {{ ($sluzba->id == $vrsta->sluzba_id) ? 'selected' : '' }} >{{ $sluzba->naziv }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group form-default">
                    <label for="naziv">Naziv</label>
                    <input type="text" name="naziv" id="naziv" class="form-control" value="{{ $vrsta->naziv }}" />
                </div>
            </div>
            <input type="submit" class="btn btn-success float-right" value="Sačuvaj" />
        </form>
    </div>
</div>
@endsection
