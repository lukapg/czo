@extends('layout.master')

@section('content')
@if(Session::has('success'))
<div class="alert alert-success" role="alert">
    {{ Session::get('success') }}
</div>
@endif
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">{{ $zaposleni->ime }} {{ $zaposleni->prezime }}</h6>
        @if (Gate::check('admin') || Gate::check('administrator'))
        <a href="/zaposleni/{{ $zaposleni->id }}/polaganja/create" class="btn btn-primary">Novo polaganje</a>
        @endif
      </div>
    <div class="card-body">
        @include('zaposleni.partial.polaganja')
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.datatables.net/plug-ins/1.10.11/sorting/date-eu.js"></script>
<script type="text/javascript">
    $(function () {
      var table = $('.data-table-polaganja').DataTable({
          "columnDefs" : [{"targets":0, "type":"date-eu"}],
          order: [[ 0, "asc" ]],
          processing: true,
          serverSide: true,
          ajax: "{{ route('zaposleni.polaganja', $zaposleni->id) }}",
          columns: [
              {data: 'datum_polaganja', name: 'datum_polaganja'},
              {data: 'rezultat_id', name: 'rezultat_id', class: 'rezultat'},
              {data: 'obrasci_prilozeni', name: 'obrasci_prilozeni', class: 'rezultat'},
              {data: 'action', name: 'action', orderable: false, searchable: false, class: 'akcija'},
              {data: 'action_brisanje', name: 'action_brisanje', orderable: false, searchable: false, class: 'akcija'},
              {data: 'action_izmjena', name: 'action_izmjena', orderable: false, searchable: false, class: 'akcija'},
          ],
          'rowCallback': function(row, data, index){
            if(data['rezultat_id'] == "Uspješno"){
                $(row).find('td:eq(1)').css('backgroundColor', 'green');
            }
            else {
                $(row).find('td:eq(1)').css('backgroundColor', 'red');
            }
            if(data['obrasci_prilozeni'] == "Da"){
                $(row).find('td:eq(2)').css('backgroundColor', 'green');
            }
            else {
                $(row).find('td:eq(2)').css('backgroundColor', 'red');
            }
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
<script>
    $( document ).ready(function() {
        $("span.uspjesno").html('<span>sdfdsffd</span>');
    });
</script>
@endsection
