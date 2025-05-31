@extends('layout.app')

@section('content')
    <form method="POST" action="{{ route('arsip_dokumen.update', $arsipDokumen->id) }}" id="arsip-dokumen-form"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <h3>Edit Arsip Dokumen</h3>

        <div style="margin-bottom: 10px;">
            <label for="kode-dokumen">Kode Dokumen:</label>
            <input name="kode_dokumen" type="text" id="kode-dokumen" style="width: 100%;"
                value="{{ old('kode_dokumen', $arsipDokumen->kode_dokumen) }}" />
            @error('kode_dokumen')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 10px;">
            <label for="keterangan">Keterangan:</label>
            <textarea name="keterangan" id="keterangan" style="width: 100%; min-height: 100px;">{{ old('keterangan', $arsipDokumen->keterangan) }}</textarea>
            @error('keterangan')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 10px;">
            <label for="kategori">Kategori:</label>
            <select name="kategori" id="kategori" style="width: 100%;">
                <option value="">Pilih Kategori</option>
                <option value="Surat Masuk"
                    {{ old('kategori', $arsipDokumen->kategori) == 'Surat Masuk' ? 'selected' : '' }}>Surat Masuk</option>
                <option value="Surat Keluar"
                    {{ old('kategori', $arsipDokumen->kategori) == 'Surat Keluar' ? 'selected' : '' }}>Surat Keluar</option>
                <option value="Lainnya" {{ old('kategori', $arsipDokumen->kategori) == 'Lainnya' ? 'selected' : '' }}>
                    Lainnya</option>
            </select>
            @error('kategori')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 10px;">
            <label for="perihal">Perihal:</label>
            <input name="perihal" type="text" id="perihal" style="width: 100%;"
                value="{{ old('perihal', $arsipDokumen->perihal) }}" />
            @error('perihal')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 10px;">
            <label for="nama-dokumen">Nama Dokumen:</label>
            <input name="nama_dokumen" type="text" id="nama-dokumen" style="width: 100%;"
                value="{{ old('nama_dokumen', $arsipDokumen->nama_dokumen) }}" />
            @error('nama_dokumen')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 10px;">
            <label for="tanggal-upload">Tanggal Upload:</label>
            <input name="tanggal_upload" type="date" id="tanggal-upload" style="width: 100%;"
                value="{{ old('tanggal_upload', $arsipDokumen->tanggal_upload) }}" />
            @error('tanggal_upload')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 10px;">
            <label for="file">File:</label>
            <input name="file" type="file" id="file" style="width: 100%;" />
            @if ($arsipDokumen->file)
                <small>File saat ini: {{ $arsipDokumen->file }}</small>
            @endif
            @error('file')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" style="margin-right: 10px;">Update</button>
        <button type="button" onclick="window.location.href='{{ url()->previous() }}'">Batal</button>
    </form>
@endsection
