@extends('layout.app')

@section('content')
    <form method="POST" action="{{ route('category.store') }}" id="kategori-form">
        @csrf
        <h3>Tambah Kategori</h3>

        <div style="margin-bottom: 10px;">
            <label for="kategori-nama">Kategori:</label>
            <select name="nama" id="kategori-nama" style="width: 100%;">
                <option value="">-- Pilih Kategori --</option>
                <option value="Surat Masuk" {{ old('nama') == 'Surat Masuk' ? 'selected' : '' }}>Surat Masuk</option>
                <option value="Surat Keluar" {{ old('nama') == 'Surat Keluar' ? 'selected' : '' }}>Surat Keluar</option>
            </select>
            @error('nama')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 10px;">
            <label for="kategori-perihal">Perihal:</label>
            <input type="text" name="perihal" id="kategori-perihal" style="width: 100%;" value="{{ old('perihal') }}" />
            @error('perihal')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label for="kategori-tujuan">Tujuan:</label>
            <textarea name="tujuan" id="kategori-tujuan" style="width: 100%;">{{ old('tujuan') }}</textarea>
            @error('tujuan')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" style="margin-right: 10px;">Simpan</button>
        <button type="button" onclick="window.location.href='{{ url()->previous() }}'">Batal</button>
    </form>
@endsection
