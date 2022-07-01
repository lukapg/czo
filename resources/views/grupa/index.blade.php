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
          <a href="/grupe/create" class="btn btn-success">Nova grupa</a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered data-table" id="dataTable" width="100%" cellspacing="0">
                <thead>
		    <tr>
			<th>Naziv grupe</th>
                        <th>Početak obuke</th>
                        <th>Kraj obuke</th>
                        <th>Broj kandidata</th>
                        <th>Status</th>
                        <th width="100px"></th>
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
    $(function () {
	  var table = $('.data-table').DataTable({
	  order: [[ 0, 'desc' ]],
          processing: true,
          serverSide: false,
	  ajax: "{{ route('grupa.index') }}",
	  columns: [
	      {data: 'naziv', name: 'naziv'},
              {data: 'pocetak_obuke', name: 'pocetak_obuke'},
    	      {data: 'kraj_obuke', name: 'kraj_obuke'},
	          {data: 'broj_kandidata', name: 'broj_kandidata'},
              {data: 'status', name: 'status'},
              {data: 'action', name: 'action', orderable: false, searchable: false, class: 'akcija'},
              {data: 'action_izmjena', name: 'action_izmjena', orderable: false, searchable: false, class: 'akcija'},
          ],
          'rowCallback': function(row, data, index){
            if(data['status'] == "Završeno"){
                $(row).find('td:eq(4)').css('backgroundColor', 'red').css('color', '#fff').css('vertical-align', 'middle');
            }
            else if(data['status'] == "U toku") {
                $(row).find('td:eq(4)').css('backgroundColor', 'darkgray').css('color', '#fff').css('vertical-align', 'middle');
            }
            else {
                $(row).find('td:eq(4)').css('backgroundColor', 'green').css('color', '#fff').css('vertical-align', 'middle');
            }
            $(row).find('td:eq(4)').css('textAlign', 'center');
          },
          language: {
                "sEmptyTable":     "Nema podataka u tabeli",
                "sInfo":           "Prikaz _START_ do _END_ od ukupno _TOTAL_ zapisa",
                "sInfoEmpty":      "Prikaz 0 do 0 od ukupno 0 zapisa",
                "sInfoFiltered":   "(filtrirano od ukupno _MAX_ zapisa)",
                "sInfoPostFix":    "",
                "sInfoThousands":  ".",
                "sLengthMenu":     "Prikaži _MENU_ zapisa",
                "sLoadingRecords": "Učitavanje...",
                "sProcessing":     "Obrada...",
                "sSearch":         "Pretraga:",
                "sZeroRecords":    "Nisu pronađeni odgovarajući zapisi",
                "oPaginate": {
                    "sFirst":    "Početna",
                    "sLast":     "Poslednja",
                    "sNext":     "Sledeća",
                    "sPrevious": "Predhodna"
                },
                "oAria": {
                    "sSortAscending":  ": aktivirajte da sortirate kolonu uzlazno",
                    "sSortDescending": ": aktivirajte da sortirate kolonu silazno"
                }
           }
      });
      
    });
</script>
@endsection
