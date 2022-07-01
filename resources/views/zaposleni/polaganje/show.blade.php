@extends('layout.master')

@section('content')
<div class="card shadow mb-4 col-md-6 pl-0 pr-0">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Polaganje - {{ $zaposleni->ime }} {{ $zaposleni->prezime }} - {{ \Carbon\Carbon::parse($polaganje->datum_polaganja)->format('d.m.Y') }}</h6>
    </div>
    <div class="card-body">
        <ul class="nav nav-tabs" id="tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="osnovno-tab" data-toggle="tab" href="#osnovno" role="tab" aria-controls="osnovno" aria-selected="true">Osnovni podaci</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="dokumenti-tab" data-toggle="tab" href="#dokumenti" role="tab" aria-controls="dokumenti" aria-selected="false">Dokumenti</a>
            </li>
        </ul>
        <div class="tab-content" id="tabsContent">
            <div class="tab-pane fade show active" id="osnovno" role="tabpanel" aria-labelledby="osnovno-tab">
                @include('zaposleni.polaganje.partial.osnovno')
            </div>
            <div class="tab-pane fade" id="dokumenti" role="tabpanel" aria-labelledby="dokumenti-tab">
                @include('zaposleni.polaganje.partial.dokumenti')
            </div>
        </div>
    </div>
</div>
@endsection