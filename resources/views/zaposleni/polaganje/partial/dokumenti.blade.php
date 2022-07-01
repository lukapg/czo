<form method="POST" class="mt-4" name="dokumenti-form" id="dokumenti-form">
    @csrf
    <div class="form-group form-primary">
        @forelse ($dokumenti as $dokument)
            <div>
                <a style="btn" id="{{ $dokument->id }}" onclick="brisanje({{ $dokument->id }})" style="margin-bottom: 5px">
                    <i class="fa fa-trash-o"></i>
                </a>
                <a style="color: #007bff" href="{{ URL::to('/') }}/obrasci/{{ $dokument->putanja . $dokument->naziv }}" target="_blank">
                    | {{ $dokument->original_naziv }}<br />
                </a>
            </div>
        @empty
            <p>Nema postavljenih dokumenata</p>
        @endforelse
    </div>
    @if($switch == 'edit')
    <div class="form-group form-primary">
        <input name="dokument[]" id="dokument" type="file" accept="" value="" class="file-loading" multiple="multiple" />
    </div>
    <input type="submit" class="btn btn-primary" value="Sačuvaj" id="dokumenti-btn" name="dokumenti-btn" />
    @endif
</form>