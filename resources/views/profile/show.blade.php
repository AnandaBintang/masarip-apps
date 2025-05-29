@extends('layout.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4 fw-bold">{{ $title ?? 'Profil Pengguna' }}</h2>
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-4 rounded shadow-sm">
            @csrf
            <div style="margin-bottom:22px;">
                <label for="foto-profil" style="display:block; font-weight:500; margin-bottom:8px;">Foto Profil:</label>
                <input type="file" id="foto-profil" name="foto_profil" accept="image/*"
                    onchange="previewFotoProfil(event)" style="display:block; margin-bottom:10px;" />
                <div>
                    @if (!empty($foto_profil))
                        <img id="preview-foto" src="{{ asset('storage/' . $foto_profil) }}" alt="Preview Foto"
                            style="max-width:120px; border-radius:8px; border:1px solid #e0e0e0; padding:6px; background:#fafafa;" />
                    @else
                        <img id="preview-foto" src="" alt="Preview Foto"
                            style="max-width:120px; display:none; border-radius:8px; border:1px solid #e0e0e0; padding:6px; background:#fafafa;" />
                    @endif
                </div>
                @error('foto_profil')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:18px;">
                <label for="jabatan" style="display:block; font-weight:500; margin-bottom:6px;">Jabatan:</label>
                <input type="text" id="jabatan" name="jabatan" class="form-control"
                    style="width:100%; padding:8px 10px; border:1px solid #ccc; border-radius:6px;"
                    value="{{ old('jabatan', $jabatan ?? '') }}" maxlength="255" />
                @error('jabatan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:18px;">
                <label for="no-telpon" style="display:block; font-weight:500; margin-bottom:6px;">No Telepon:</label>
                <input type="tel" id="no-telpon" name="no_telpon" class="form-control"
                    style="width:100%; padding:8px 10px; border:1px solid #ccc; border-radius:6px;"
                    value="{{ old('no_telpon', $no_telpon ?? '') }}" maxlength="15" />
                @error('no_telpon')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:18px;">
                <label for="nama-lengkap" style="display:block; font-weight:500; margin-bottom:6px;">Nama Lengkap:<span
                        style="color:red">*</span></label>
                <input type="text" id="nama-lengkap" name="nama_lengkap" class="form-control"
                    style="width:100%; padding:8px 10px; border:1px solid #ccc; border-radius:6px;"
                    value="{{ old('nama_lengkap', $nama_lengkap ?? '') }}" maxlength="255" required />
                @error('nama_lengkap')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:18px;">
                <label for="username" style="display:block; font-weight:500; margin-bottom:6px;">Username:<span
                        style="color:red">*</span></label>
                <input type="text" id="username" name="username" class="form-control"
                    style="width:100%; padding:8px 10px; border:1px solid #ccc; border-radius:6px;"
                    value="{{ old('username', $username ?? '') }}" maxlength="255" required />
                @error('username')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:24px;">
                <label for="password-baru" style="display:block; font-weight:500; margin-bottom:6px;">
                    Password Baru: <span style="font-weight:400; color:#888; font-size:0.95em;">(biarkan kosong jika tidak
                        ingin mengganti)</span>
                </label>
                <div style="position:relative;">
                    <input type="password" id="password-baru" name="password" class="form-control"
                        style="width:100%; padding:8px 38px 8px 10px; border:1px solid #ccc; border-radius:6px;"
                        minlength="8" autocomplete="new-password" />
                    <span onclick="togglePassword('password-baru')"
                        style="position:absolute; right:10px; top:50%; transform:translateY(-50%); cursor:pointer;">
                        <svg id="eye-password-baru" xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 0c0 3.866-3.582 7-8 7s-8-3.134-8-7 3.582-7 8-7 8 3.134 8 7z" />
                        </svg>
                    </span>
                </div>
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:24px;">
                <label for="password-baru_confirmation" style="display:block; font-weight:500; margin-bottom:6px;">
                    Konfirmasi Password Baru: <span style="font-weight:400; color:#888; font-size:0.95em;">(biarkan kosong
                        jika tidak
                        ingin mengganti)</span>
                </label>
                <div style="position:relative;">
                    <input type="password" id="password-baru_confirmation" name="password_confirmation"
                        class="form-control"
                        style="width:100%; padding:8px 38px 8px 10px; border:1px solid #ccc; border-radius:6px;"
                        minlength="8" autocomplete="new-password" />
                    <span onclick="togglePassword('password-baru_confirmation')"
                        style="position:absolute; right:10px; top:50%; transform:translateY(-50%); cursor:pointer;">
                        <svg id="eye-password-baru_confirmation" xmlns="http://www.w3.org/2000/svg" width="22"
                            height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 0c0 3.866-3.582 7-8 7s-8-3.134-8-7 3.582-7 8-7 8 3.134 8 7z" />
                        </svg>
                    </span>
                </div>
                @error('password_confirmation')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit"
                style="width:100%; padding:12px 0; background:#007bff; color:#fff; font-size:1.1rem; font-weight:600; border:none; border-radius:6px; cursor:pointer; transition:background 0.2s;">
                Simpan
            </button>
        </form>
        <p id="pesan-profil-desa" style="color:green; display:none; margin-top:10px;"></p>
    </div>

    <script>
        function previewFotoProfil(event) {
            const preview = document.getElementById('preview-foto');
            preview.src = URL.createObjectURL(event.target.files[0]);
            preview.style.display = 'block';
        }

        function togglePassword(id) {
            const input = document.getElementById(id);
            const eye = document.getElementById('eye-' + id);
            if (input.type === "password") {
                input.type = "text";
                eye.innerHTML =
                    `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.418 0-8-3.134-8-7 0-1.306.417-2.523 1.125-3.535m1.885-2.385A9.956 9.956 0 0112 5c4.418 0 8 3.134 8 7 0 1.306-.417 2.523-1.125 3.535M15 12a3 3 0 11-6 0 3 3 0 016 0zm-6.364 6.364l12.728-12.728"/>`;
            } else {
                input.type = "password";
                eye.innerHTML =
                    `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 0c0 3.866-3.582 7-8 7s-8-3.134-8-7 3.582-7 8-7 8 3.134 8 7z" />`;
            }
        }
    </script>
@endsection
