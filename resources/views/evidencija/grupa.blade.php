@extends('layout.master')

@section('content')
@if(Session::has('success'))
<div class="alert alert-success" role="alert">
	{{ Session::get('success') }}
</div>
@endif

<!-- Modal -->
<div class="modal fade" id="modalUnosRezultata" tabindex="-1" role="dialog" aria-labelledby="modalUnosRezultataTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalUnosRezultataTitle">Unos rezultata sa polaganja</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Zatvori">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		  <form id="unos_rezultata">
			  <input type="hidden" name="zaposleni_id" id="zaposleni_id">
	<div class="form-group form-default">
		<label>Broj bodova (teorijski dio): </label>
		<input type="number" class="form-control" name="broj_bodova" id="broj_bodova" class="broj_bodova" />
	</div>
	<div class="form-group form-default">
		<label>Praktični dio:</label>
		<div class="d-flex align-items-center">
			<div class="mr-4">
				<input type="radio" id="polozio" name="prakticni_dio" value="1" class="prakticni_dio" />
				<label for="polozio">Položio</label>
			</div>
			<div>
				<input type="radio" id="nije_polozio" name="prakticni_dio" value="0" class="prakticni_dio" />
				<label for="nije_polozio">Nije položio</label>
			</div>
		</div>
	</div>
	<div class="d-flex align-items-center form-group form-default">
		<label class="mb-0 pr-2">Rezultat:</label>
		<div id="rezultat" name="rezultat"></div>
	</div>
	<div class="form-group form-default">
		<label>Komentar</label>
		<textarea class="form-control" name="komentar" id="komentar" rows="4"></textarea>
	</div>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
        <button type="button" class="btn btn-primary">Sačuvaj</button>
      </div>
    </div>
  </div>
</div>

<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex justify-content-between align-items-center">
		<h6 class="m-0 font-weight-bold text-primary">Grupa {{ $grupa->naziv }}</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered data-table" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Ime</th>
						<th>Prezime</th>
						<th>Sektor</th>
						<th>Služba</th>
						<th>Region</th>
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
			processing: true,
			serverSide: false,
			ajax: "{{ route('evidencija.grupa', $grupa->id) }}",
			columns: [{
					data: 'ime',
					name: 'ime'
				},
				{
					data: 'prezime',
					name: 'prezime'
				},
				{
					data: 'sektor_id',
					name: 'sektor_id'
				},
				{
					data: 'sluzba_id',
					name: 'sluzba_id'
				},
				{
					data: 'region_id',
					name: 'region_id'
				},
				{
					data: 'action',
					name: 'action',
					orderable: false,
					searchable: false,
					class: 'akcija'
				},
			],
			columnDefs: [{
				width: 150,
				targets: 5
			}],
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
	$(document).on('click', '.openModalBtn', function() {
		var zaposleniId = $(this).data('id');
		$("#zaposleni_id").val(zaposleniId);
	});
	$('.prakticni_dio').on('change', function() {
		var prakticni_dio = $('input[name=prakticni_dio]:checked').val();
		var bodovi = $('#broj_bodova').val();
		if (bodovi > 50 && prakticni_dio == 1) {
			$('#rezultat').text('POLOŽIO');
			$('#rezultat').css('color', 'green').css('font-weight', 'bold');
		}
		else {
			$('#rezultat').text('NIJE POLOŽIO');
			$('#rezultat').css('color', 'red').css('font-weight', 'bold');
		}
	});
	$('#broj_bodova').on('change', function() {
		var bodovi = $(this).val();
		var prakticni_dio = $('input[name=prakticni_dio]:checked').val();
		if (bodovi > 50 && prakticni_dio == 1) {
			$('#rezultat').text('POLOŽIO');
			$('#rezultat').css('color', 'green').css('font-weight', 'bold');
		}
		else {
			$('#rezultat').text('NIJE POLOŽIO');
			$('#rezultat').css('color', 'red').css('font-weight', 'bold');
		}
	});

	$("#unos_rezultata").submit(function(e) {
		e.preventDefault();
		var date = uzmiDatum();
		$('#datum').val(date);
		$.ajax({
			type: "POST",
			url: "{{ route('evidencija.unos_rezultata') }}",
			data: $('#unos_rezultata').serialize(),
			success: function(response) {
				$('#myModal').modal('hide');
				alert(response);
				$('#unos_rezultata input[type="text"], select, #unos_rezultata input[type="radio"]').val('');
			},
			error: function() {
				alert('Greška!');
			}
		});
    });
</script>
@endsection
