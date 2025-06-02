@extends('layout.app')

@section('content')
    <form method="POST" action="{{ route('category.update', $category->id) }}" id="kategori-form">
        @csrf
        @method('PUT')
        <h3>Edit Kategori</h3>

        <div style="margin-bottom: 10px;">
            <label for="kategori-nama">Kategori:</label>
            <select name="nama" id="kategori-nama" style="width: 100%;">
                <option value="">-- Pilih Kategori --</option>
                <option value="Surat Masuk" {{ old('nama', $category->nama) == 'Surat Masuk' ? 'selected' : '' }}>Surat
                    Masuk</option>
                <option value="Surat Keluar" {{ old('nama', $category->nama) == 'Surat Keluar' ? 'selected' : '' }}>Surat
                    Keluar</option>
                <option value="Keputusan Kades" {{ old('nama', $category->nama) == 'Keputusan Kades' ? 'selected' : '' }}>
                    Keputusan
                    Kades</option>
            </select>
            @error('nama')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 10px;">
            <label for="kategori-perihal">Perihal:</label>
            <input type="text" name="perihal" id="kategori-perihal" style="width: 100%;"
                value="{{ old('perihal', $category->perihal) }}" />
            @error('perihal')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label for="kategori-tujuan">Tujuan:</label>
            <textarea name="tujuan" id="kategori-tujuan" style="width: 100%;">{{ old('tujuan', $category->tujuan) }}</textarea>
            @error('tujuan')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" style="margin-right: 10px;">Update</button>
        <button type="button" onclick="window.location.href='{{ url()->previous() }}'">Batal</button>
    </form>
@endsection
