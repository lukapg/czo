@extends('layout.master')

@section('content')
    @if(Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('success') }}
    </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Kandidati</h6>
            @if (Gate::check('admin') || Gate::check('administrator'))
            <a href="/zaposleni/create" class="btn btn-success">Novi kandidat</a>
            @endif
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered data-table" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Ime</th>
                        <th>Prezime</th>
                        <th>Sektor</th>
                        <th>Region</th>
                        <th>Status</th>
                        <th>Posljednje polaganje</th>
                        <th>Naredna obuka</th>
                        <th class="kolona-100"></th>
                        <th class="kolona-100"></th>
                        <th class="kolona-100"></th>
                        <th class="kolona-100"></th>
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
<script src="https://cdn.datatables.net/plug-ins/1.10.11/sorting/date-eu.js"></script>
<script type="text/javascript">
    $(function () {
      var table = $('.data-table').DataTable({
          "columnDefs" : [{"targets":5, "type":"date-eu"}],
          order: [[ 5, "asc" ]],
          processing: true,
          serverSide: false,
          ajax: "{{ route('zaposleni.index') }}",
          columns: [
              {data: 'ime', name: 'ime'},
              {data: 'prezime', name: 'prezime'},
              {data: 'sektor_id', name: 'sektor_id'},
              {data: 'region_id', name: 'region_id'},
              {data: 'status', name: 'status', class: 'rezultat'},
              {data: 'zadnje_polaganje', name: 'zadnje_polaganje'},
              {data: 'naredna_obuka', name: 'naredna_obuka'},
              {data: 'action', name: 'action', orderable: false, searchable: false, class: 'akcija'},
              {data: 'action_izmjena', name: 'action_izmjena', orderable: false, searchable: false, class: 'akcija'},
              {data: 'action_brisanje', name: 'action_brisanje', orderable: false, searchable: false, class: 'akcija'},
              {data: 'action_polaganja', name: 'action_polaganja', orderable: false, searchable: false, class: 'akcija'},
          ],
          'rowCallback': function(row, data, index){
            if(data['status'] == "Položio/la"){
                $(row).find('td:eq(4)').css('backgroundColor', 'green');
            }
            else if(data['status'] == "Nije položio/la") {
                $(row).find('td:eq(4)').css('backgroundColor', 'red');
            }
            else {
                $(row).find('td:eq(4)').css('backgroundColor', 'lightgrey').css('color', '#333');
            }
            $(row).find('td:eq(5)').css('textAlign', 'center');
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
