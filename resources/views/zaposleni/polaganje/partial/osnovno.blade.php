<form method="POST" action="{{ route('zaposleni.polaganja.update', [$zaposleni->id, $polaganje->id]) }}" class="mt-4">
    @csrf
    <div class="table-responsive">
        <div class="form-group form-default">
            <label for="datum_polaganja">Datum polaganja</label>
            <input type="date" name="datum_polaganja" id="datum_polaganja" class="form-control" required  value="{{ $polaganje->datum_polaganja }}" @if ($switch == 'view') {{ 'disabled' }} @endif/>
        </div>
        <div class="form-group form-default">
            <label for="status">Ocjena teorijski dio</label>
            <div class="d-flex align-items-center">
                <input type="text" name="ocjena_teorija_osvojeno" id="ocjena_teorija_osvojeno" class="form-control" value="{{ $polaganje->ocjena_teorija_osvojeno }}" @if ($switch == 'view') {{ 'disabled' }}  @endif required placeholder="Osvojeno..." />
                <span class="px-2">/</span>
                <input type="text" name="ocjena_teorija_ukupno" id="ocjena_teorija_ukupno" class="form-control" value="{{ $polaganje->ocjena_teorija_ukupno }}" @if ($switch == 'view') {{ 'disabled' }}  @endif required placeholder="Ukupno..." />
            </div>
        </div>
        <div class="form-group form-default">
            <label for="prakticna_ocjena_id">Ocjena praktični dio</label>
            <select name="prakticna_ocjena_id" id="prakticna_ocjena_id" class="form-control" required @if ($switch == 'view') {{ 'disabled' }} @endif>
                <option value="">Odaberite ocjenu</option>
                @foreach ($ocjene as $ocjena)
                    <option value="{{ $ocjena->id }}" {{ ( $ocjena->id == $polaganje->prakticna_ocjena_id) ? 'selected' : '' }}>{{ $ocjena->naziv }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group form-default">
            <label for="rezultat_id">Rezultat</label>
            <select name="rezultat_id" id="rezultat_id" class="form-control" required @if ($switch == 'view') {{ 'disabled' }} @endif>
                @foreach ($rezultati as $rezultat)
                    <option value="{{ $rezultat->id }}" {{ ( $rezultat->id == $polaganje->rezultat_id) ? 'selected' : '' }}>{{ $rezultat->naziv }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group form-default">
            <label for="komentar">Komentar</label>
            <textarea class="form-control" name="komentar" id="komentar" rows="6" @if ($switch == 'view') {{ 'disabled' }} @endif>{{ $polaganje->komentar }}</textarea>
        </div>
        @if ($switch == 'edit')
        <input type="submit" class="btn btn-primary" value="Sačuvaj" />
        @endif
    </div>
</form>
