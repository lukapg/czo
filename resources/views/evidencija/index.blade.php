@extends('layout.master')

@section('content')
@if(Session::has('success'))
<div class="alert alert-success" role="alert">
	{{ Session::get('success') }}
</div>
@endif

<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex justify-content-between align-items-center">
		<h6 class="m-0 font-weight-bold text-primary">Grupe</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered data-table" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Naziv grupe</th>
						<th>Broj kandidata</th>
						<th>Datum polaganja</th>
						<th width="100px"></th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script type="text/javascript">
	$(function() {
		var table = $('.data-table').DataTable({
			order: [
				[2, 'asc']
			],
			processing: true,
			serverSide: false,
			ajax: "{{ route('evidencija.index') }}",
			columns: [{
					data: 'naziv',
					name: 'naziv'
				},
				{
					data: 'broj_kandidata',
					name: 'broj_kandidata'
				},
				{
					data: 'datum_polaganja',
					name: 'datum_polaganja'
				},
				{
					data: 'action',
					name: 'action',
					orderable: false,
					searchable: false,
					class: 'akcija'
				},
			],
			language: {
				"sEmptyTable": "Nema podataka u tabeli",
				"sInfo": "Prikaz _START_ do _END_ od ukupno _TOTAL_ zapisa",
				"sInfoEmpty": "Prikaz 0 do 0 od ukupno 0 zapisa",
				"sInfoFiltered": "(filtrirano od ukupno _MAX_ zapisa)",
				"sInfoPostFix": "",
				"sInfoThousands": ".",
				"sLengthMenu": "Prikaži _MENU_ zapisa",
				"sLoadingRecords": "Učitavanje...",
				"sProcessing": "Obrada...",
				"sSearch": "Pretraga:",
				"sZeroRecords": "Nisu pronađeni odgovarajući zapisi",
				"oPaginate": {
					"sFirst": "Početna",
					"sLast": "Poslednja",
					"sNext": "Sledeća",
					"sPrevious": "Predhodna"
				},
				"oAria": {
					"sSortAscending": ": aktivirajte da sortirate kolonu uzlazno",
					"sSortDescending": ": aktivirajte da sortirate kolonu silazno"
				}
			}
		});

	});
</script>
@endsection