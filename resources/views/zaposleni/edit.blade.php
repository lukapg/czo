@extends('layout.master')

@section('content')
@if(Session::has('success'))
<div class="alert alert-success" role="alert">
    {{ Session::get('success') }}
</div>
@endif
<div class="card shadow mb-4 col-md-6 pl-0 pr-0">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">{{ $zaposleni->ime }} {{ $zaposleni->prezime }}</h6>
      </div>
    <div class="card-body">
        @include('zaposleni.partial.osnovno')
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function()
    {
        $('select[name="sektor_id"]').on('change', function() {
            var sektor_id = $(this).val();
            if(sektor_id) {
                $.ajax({
                    url: window.location.origin + '/sektor/'+sektor_id+'/sluzbe',
                    type: "GET",
                    dataType: "json",
                    success:function(data) {                      
                        $('select[name="sluzba_id"]').empty();
                        $('select[name="sluzba_id"]').prop('disabled', false);
                        $.each(data, function(key, value) {
                            $('select[name="sluzba_id"]').append('<option value="'+ value.id +'">'+ value.naziv +'</option>');
                        });
                    }
                });
            }else{
                $('select[name="sluzba_id"]').empty();
                $('select[name="sluzba_id"]').prop('disabled', true);
            }
        });

        $('input[name="pripada_regionu"]').on('change', function() { 
            var vrijednost = $(this).val();
            if (vrijednost == 0) {
                $('select[name="region_id"]').prop('disabled', true);
                $('select[name="region_id"]').prop('required', false);
            }
            else {
                $('select[name="region_id"]').prop('disabled', false);
                $('select[name="region_id"]').prop('required', true);
            }
        });
    });
</script>
@endsection