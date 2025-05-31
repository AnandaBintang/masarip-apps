@extends('layout.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4 fw-bold">Profil Desa</h2>
        <form method="POST" action="{{ route('profil_desa.store') }}" id="profil-desa-form" enctype="multipart/form-data"
            class="bg-white p-4 rounded shadow-sm">
            @csrf
            <div class="mb-3">
                <label for="nama-kantor" class="form-label fw-semibold">Nama Kantor Desa:</label>
                <input type="text" id="nama-kantor" name="nama_kantor_desa" class="form-control"
                    value="{{ old('nama_kantor_desa', $profilDesa->nama_kantor_desa ?? '') }}" required maxlength="255" />
                @error('nama_kantor_desa')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="nama-website" class="form-label fw-semibold">Nama Website:</label>
                <input type="text" id="nama-website" name="nama_website" class="form-control"
                    value="{{ old('nama_website', $profilDesa->nama_website ?? '') }}" required maxlength="255" />
                @error('nama_website')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="logo-desa" class="form-label fw-semibold">Logo Desa (gambar):</label>
                <input type="file" id="logo-desa" name="logo" accept="image/*" class="form-control"
                    onchange="previewLogo(event)" />
                <div class="mt-3">
                    @if (!empty($profilDesa) && $profilDesa->logo)
                        <img id="preview-logo" src="{{ asset($profilDesa->logo) }}" alt="Preview Logo"
                            style="max-width:150px; border:1px solid #ccc; padding:5px;" />
                    @else
                        <img id="preview-logo" src="" alt="Preview Logo"
                            style="max-width:150px; display:none; border:1px solid #ccc; padding:5px;" />
                    @endif
                </div>
                @error('logo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="alamat-kantor" class="form-label fw-semibold">Alamat Kantor:</label>
                <input type="text" id="alamat-kantor" name="alamat_kantor" class="form-control"
                    value="{{ old('alamat_kantor', $profilDesa->alamat_kantor ?? '') }}" required maxlength="255" />
                @error('alamat_kantor')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="deskripsi-website" class="form-label fw-semibold">Deskripsi Website:</label>
                <br>
                <textarea id="deskripsi-website" name="deskripsi_website" style="width: 100%" rows="4" class="form-control">{{ old('deskripsi_website', $profilDesa->deskripsi_website ?? '') }}</textarea>
                @error('deskripsi_website')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <br>
            <button type="submit" class="btn btn-success px-4">Simpan</button>
        </form>
        <p id="pesan-profil-desa" style="color:green; display:none; margin-top:10px;"></p>
    </div>

    <script>
        function previewLogo(event) {
            const preview = document.getElementById('preview-logo');
            preview.src = URL.createObjectURL(event.target.files[0]);
            preview.style.display = 'block';
        }
    </script>
@endsection
