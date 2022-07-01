@extends('layout.master')

@section('content')
<div class="card shadow mb-4 col-md-6 pl-0 pr-0">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Unos nove vrste obuke</h6>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('vrsta_obuke.store') }}">
            @csrf
            <div class="table-responsive">
                <div class="form-group form-default">
                    <label for="sluzba_id">Služba</label>
                    <select name="sluzba_id" id="sluzba_id" class="form-control" required>
                        <option value="">Odaberite službu</option>
                        @foreach ($sluzbe as $sluzba)
                            <option value="{{ $sluzba->id }}">{{ $sluzba->naziv }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group form-default">
                    <label for="naziv">Naziv</label>
                    <input type="text" name="naziv" id="naziv" class="form-control" required />
                </div>
                <input type="submit" class="btn btn-success float-right" value="Sačuvaj" />
            </div>
        </form>
    </div>
</div>
@endsection
