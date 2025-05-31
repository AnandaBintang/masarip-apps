@extends('layout.app')

@section('content')
    <form method="POST" action="{{ route('sarana_simpan.store') }}" id="sarana-simpan-form">
        @csrf
        <h3>Tambah Sarana Simpan</h3>

        <div style="margin-bottom: 10px;">
            <label for="kode-nomenklatur">Kode Nomenklatur:</label>
            <input name="kode_nomenklatur" type="text" id="kode-nomenklatur" style="width: 100%;"
                value="{{ old('kode_nomenklatur') }}" />
            @error('kode_nomenklatur')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 10px;">
            <label for="keterangan">Keterangan:</label>
            <textarea name="keterangan" id="keterangan" style="width: 100%; min-height: 100px;">{{ old('keterangan') }}</textarea>
            @error('keterangan')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" style="margin-right: 10px;">Simpan</button>
        <button type="button" onclick="window.location.href='{{ url()->previous() }}'">Batal</button>
    </form>
@endsection
