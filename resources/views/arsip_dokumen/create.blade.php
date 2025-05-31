@extends('layout.app')

@section('content')
    <form method="POST" action="{{ route('arsip_dokumen.store') }}" id="arsip-dokumen-form" enctype="multipart/form-data">
        @csrf
        <h3>Tambah Arsip Dokumen</h3>

        <div style="margin-bottom: 10px;">
            <label for="kode-dokumen">Kode Nomenklatur:</label>
            <select name="kode_dokumen" id="kode-dokumen" style="width: 100%;" onchange="autoFillFields(this.value)">
                <option value="">Pilih Kode Nomenklatur</option>
                @foreach ($saranaSimpan as $sarana)
                    <option value="{{ $sarana->kode_nomenklatur }}" data-keterangan="{{ $sarana->keterangan }}"
                        {{ old('kode_dokumen') == $sarana->kode_nomenklatur ? 'selected' : '' }}>
                        {{ $sarana->kode_nomenklatur }}
                    </option>
                @endforeach

            </select>
            @error('kode_dokumen')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 10px;">
            <label for="keterangan">Keterangan:</label>
            <textarea name="keterangan" id="keterangan" style="width: 100%; min-height: 100px;" readonly>{{ old('keterangan') }}</textarea>
            @error('keterangan')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 10px;">
            <label for="kategori">Kategori:</label>
            <select name="kategori" id="kategori" style="width: 100%;">
                <option value="">Pilih Kategori</option>
                @foreach ($category as $cat)
                    <option value="{{ $cat->nama }}" data-perihal="{{ $cat->perihal }}"
                        {{ old('kategori') == $cat->nama ? 'selected' : '' }}>
                        {{ $cat->nama }}
                    </option>
                @endforeach

            </select>
            @error('kategori')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 10px;">
            <label for="perihal">Perihal:</label>
            <input name="perihal" type="text" id="perihal" style="width: 100%;" value="{{ old('perihal') }}"
                readonly />
            @error('perihal')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 10px;">
            <label for="nama-dokumen">Nama Dokumen:</label>
            <input name="nama_dokumen" type="text" id="nama-dokumen" style="width: 100%;"
                value="{{ old('nama_dokumen') }}" />
            @error('nama_dokumen')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 10px;">
            <label for="tanggal-upload">Tanggal Upload:</label>
            <input name="tanggal_upload" type="date" id="tanggal-upload" style="width: 100%;"
                value="{{ old('tanggal_upload') }}" />
            @error('tanggal_upload')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 10px;">
            <label for="file">File:</label>
            <input name="file" type="file" id="file" style="width: 100%;" />
            @error('file')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" style="margin-right: 10px;">Simpan</button>
        <button type="button" onclick="window.location.href='{{ url()->previous() }}'">Batal</button>
    </form>

    <script>
        document.getElementById('kode-dokumen').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const keterangan = selectedOption.getAttribute('data-keterangan') || '';
            document.getElementById('keterangan').value = keterangan;
        });

        document.getElementById('kategori').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const perihal = selectedOption.getAttribute('data-perihal') || '';
            document.getElementById('perihal').value = perihal;
        });
    </script>
@endsection
