@extends('layout.master')

@section('content')
    @if(Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('success') }}
    </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
          <h6 class="m-0 font-weight-bold text-primary">Predavači</h6>
          @if (auth()->user()->rola_id == 1 || auth()->user()->rola_id == 2 )    
          <a href="/predavaci/create" class="btn btn-success">Novi predavač</a>
          @endif
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered data-table" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Ime</th>
                        <th>Prezime</th>
                        <th width="100px"></th>  
                        @if (auth()->user()->rola_id == 1 || auth()->user()->rola_id == 2 )                      
                        <th width="100px"></th>
                        <th width="100px"></th>
                        @endif
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
@if (auth()->user()->rola_id == 1 || auth()->user()->rola_id == 2 )
<script type="text/javascript">
    $(function () {
      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: false,
          ajax: "{{ route('predavac.index') }}",
          columns: [
              {data: 'ime', name: 'ime'},
              {data: 'prezime', name: 'prezime'},
              {data: 'action', name: 'action', orderable: false, searchable: false, class: 'akcija'},
              {data: 'action_izmjena', name: 'action_izmjena', orderable: false, searchable: false, class: 'akcija'},
              {data: 'action_brisanje', name: 'action_brisanje', orderable: false, searchable: false, class: 'akcija'},
          ],
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
@else 
<script type="text/javascript">
    $(function () {
      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: false,
          ajax: "{{ route('predavac.index') }}",
          columns: [
              {data: 'ime', name: 'ime'},
              {data: 'prezime', name: 'prezime'},
              {data: 'action', name: 'action', orderable: false, searchable: false, class: 'akcija'},
          ],
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
@endif
@endsection
