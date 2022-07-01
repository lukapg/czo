@extends('layout.master')

@section('content')
<div class="card shadow mb-4 col-md-12 pl-0 pr-0">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Unos nove grupe - Potvrda kandidata</h6>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('grupa.storeConfirm', $grupa->id) }}">
            @csrf
	    <div class="table-responsive">
		<table class="table table-bordered">
			<thead>
				<th>Zaposleni</th>
				<th>Predlog sektora</th>
				<th>Služba</th>
				<th>Radno mjesto</th>
				<th>Zaštita na radu?</th>
				<th>Organizacija smještaja</th>
				<th></th>
			</thead>
			<tbody>		
                @foreach($zaposleni as $zap)
                    	<tr>
                        <td class="font-weight-bold"> 
                            {{$zap->ime}} {{$zap->prezime}}
			</td>
			<td>
			   {{ $zap->sektor }}
			</td>
			<td>
			   {{ $zap->sluzba }}
			</td>
			<td>
			   {{ $zap->radno_mjesto }}
			</td>
			<td>
			   {{ $zap->zastita_na_radu ? 'Da' : 'Ne' }}
			</td>
			<td>
			   {{ $zap->organizacija_smjestaja ? 'Da' : 'Ne' }}
			</td>
			<td class="text-center">
				<form></form>
				<form method="post" action="{{ route('grupa.deleteTempZaposleni', ['grupa' => $grupa->id, 'zaposleni' => $zap->id]) }}">
					@csrf
					<input type="submit" class="btn btn-primary show_confirm" value="Obriši" />
				</form>
			</td>
                    </tr>
		    @endforeach
		    </tbody>
		</table>
                <input type="submit" class="btn btn-success" value="Potvrdi" />
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
	$('.show_confirm').click(function(e) {
		if (!confirm('Da li ste sigurni?')) {
			e.preventDefault();
		}
	});
</script>

@endsection
