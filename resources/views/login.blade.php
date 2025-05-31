<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>MasAriP - Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
</head>

<body>
    <div class="login-card">
        <div class="header">
            <img src="{{ asset('img/logo-unesa.png') }}" alt="Logo Unesa" />
            <span>Universitas Negeri Surabaya</span>
        </div>
        <div class="logo-box">
            <img src="{{ asset('img/logo-sda.png') }}" alt="Logo MasArip" />
        </div>
        <div class="title">Selamat Datang di MasArip</div>
        <div class="subtitle">Manajemen Arsip Desa Pilang</div>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Username" value="{{ old('username') }}"
                style="width: 100%;" pattern="[^\s]+" title="Username cannot contain spaces"
                oninput="this.value = this.value.replace(/\s/g, '_')" required />

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Password" required />

            <button type="submit">Masuk</button>
        </form>

        <div class="footer">
            <span>
                <img src="{{ asset('img/logo-unesa.png') }}" alt="Logo Unesa" />
                Copyright © 2025. Sarjana Terapan Administrasi Negara
            </span>
            <span class="footer-right">#SATULANGKAHDIDEPAN</span>
        </div>
    </div>
</body>

</html>
