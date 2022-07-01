@extends('layout.master')

@section('content')
<div class="card shadow mb-4 col-md-6 pl-0 pr-0">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Polaganje - {{ $zaposleni->ime }} {{ $zaposleni->prezime }} - {{ \Carbon\Carbon::parse($polaganje->datum_polaganja)->format('d.m.Y') }}</h6>
    </div>
    <div class="card-body">
        <ul class="nav nav-tabs" id="tabs" role="tablist">
            @if(Gate::check('admin'))
            <li class="nav-item">
                <a class="nav-link active" id="osnovno-tab" data-toggle="tab" href="#osnovno" role="tab" aria-controls="osnovno" aria-selected="true">Osnovni podaci</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="dokumenti-tab" data-toggle="tab" href="#dokumenti" role="tab" aria-controls="dokumenti" aria-selected="false">Dokumenti</a>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link active" id="dokumenti-tab" data-toggle="tab" href="#dokumenti" role="tab" aria-controls="dokumenti" aria-selected="false">Dokumenti</a>
            </li>
            @endif
        </ul>
        <div class="tab-content" id="tabsContent">
            @if(Gate::check('admin'))
            <div class="tab-pane fade show active" id="osnovno" role="tabpanel" aria-labelledby="osnovno-tab">
                @include('zaposleni.polaganje.partial.osnovno')
            </div>
            <div class="tab-pane fade" id="dokumenti" role="tabpanel" aria-labelledby="dokumenti-tab">
                @include('zaposleni.polaganje.partial.dokumenti')
            </div>
            @else
            <div class="tab-pane fade show active" id="dokumenti" role="tabpanel" aria-labelledby="dokumenti-tab">
                @include('zaposleni.polaganje.partial.dokumenti')
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<link href="{{ asset('css/fileinput.css') }}" media="all" rel="stylesheet" type="text/css" />
<script src="{{ asset('js/vendor/fileinput.js') }}" type="text/javascript"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/sr.js"></script>
<script>
    $("#dokumenti-btn").click(function(e){
        e.preventDefault();
        let forma =  $("#dokumenti-form")[0];
        let postUrl =  "/polaganja/" + {!! json_encode($polaganje->id) !!} + "/dokumenti";

        $.ajax({
            method: "POST",
            url: postUrl,
            data: new FormData(forma),
            contentType: false,
            processData: false,
            success: function(data) {
                $("#dokument").val(null);
                Swal.fire(data.message_title, data.message_content, data.message_type);
            },
            error: function(data)
            {
                console.log(data);
                Swal.fire(data.message_title, data.message_content, data.message_type);
            }
        })
    });

    function brisanje(id) {
        var token = $('input[name=_token]').val();
        var data = {
            idDokumenta: id,
            _token: token
        }

        Swal.fire({
            title: 'Upozorenje',
            text: 'Da li ste sigurni da zelite da obrisete ovaj dokument?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Da',
            cancelButtonText: 'Otkazi'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '/zaposleni/brisanje_dokumenta',
                    type: 'POST',
                    data: data,
                    success: function(data) {
                        $("#" + id).closest('div').remove();
                        Swal.fire(data.message_title, data.message_content, data.message_type);
                    },
                    error: function(data) {
                        console.log(data);
                        Swal.fire(data.message_title, data.message_content, data.message_type);
                    }
                });
            }
        });
    }
    $(document).ready(function() {
        $("#dokument").fileinput({
            showUpload: false,
            uploadAsync: false,
            showCancel: false,
            previewFileType: "",
            browseClass: "btn btn-success",
            browseLabel: "Izaberite fajlove",
            browseIcon: "<i class='fa fa-plus'></i>",
            removeClass: "btn btn-danger",
            removeLabel: "Obriši",
            removeIcon: "<i class='far fa-trash-alt'></i>",
            zoomIndicator: "<i class='fas fa-search-plus'></i>",
            layoutTemplates: {
                progress: ''
            },
            overwriteInitial: false
        });
    });
</script>
<script type="text/javascript">
    $("#datum_polaganja").flatpickr({
        altInput: true,
        altFormat: "d.m.Y",
        "locale": "sr"
    });
</script>
@endsection
