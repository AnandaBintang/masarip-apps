@extends('layout.app')

@section('content')
    <form method="POST" action="{{ route('user.store') }}" id="user-form">
        @csrf
        <h3>Tambah Pengguna</h3>

        <div style="margin-bottom: 10px;">
            <label for="user-nama">Nama:</label>
            <input name="name" type="text" id="user-nama" style="width: 100%;" value="{{ old('name') }}" />
            @error('name')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 10px;">
            <label for="user-username">Username:</label>
            <input name="username" type="text" id="user-username" style="width: 100%;" value="{{ old('username') }}"
                pattern="[^\s]+" title="Username cannot contain spaces"
                oninput="this.value = this.value.replace(/\s/g, '_')" />
            @error('username')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 10px;">
            <label for="user-role">Role:</label>
            <select name="role" id="user-role" style="width: 100%;">
                <option value="">-- Pilih Role --</option>
                @if (auth()->user()->role === 'administrator')
                    <option value="administrator" {{ old('role') == 'administrator' ? 'selected' : '' }}>Administrator
                    </option>
                @endif
                <option value="petugas" {{ old('role') == 'petugas' ? 'selected' : '' }}>Petugas</option>
                <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff Umum</option>
            </select>
            @error('role')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label for="user-password">Password:</label>
            <div style="position: relative;">
                <input name="password" type="password" id="user-password" style="width: 100%; padding-right: 35px;" />
                <span onclick="togglePassword()"
                    style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                    <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path id="eye-path" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </span>
            </div>
            @error('password')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" style="margin-right: 10px;">Simpan</button>
        <button type="button" onclick="window.location.href='{{ url()->previous() }}'">Batal</button>
    </form>

    <script>
        function togglePassword() {
            const input = document.getElementById('user-password');
            const icon = document.getElementById('eye-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = `
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.956 9.956 0 012.293-3.95m3.362-2.568A9.956 9.956 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.973 9.973 0 01-4.043 5.306M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
                        `;
            } else {
                input.type = 'password';
                icon.innerHTML = `
                            <path id="eye-path" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        `;
            }
        }
    </script>
@endsection
