<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>MasAriP - Sistem E-Arsip</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" />
</head>

<body>
    @php
        $role = auth()->user()->role ?? 'guest';
    @endphp

    @include('components.sidebar')

    @yield('content')

    <footer class="footer">
        <img src="{{ asset('img/logo-unesa.png') }}" alt="Logo Unesa" />
        Copyright © 2025. Sarjana Terapan Administrasi Negara
    </footer>

    <!-- Modal Konfirmasi Logout -->
    <div id="logout-modal"
        style="display:none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
    background-color: rgba(0,0,0,0.5); justify-content: center; align-items: center;">
        <div
            style="background: white; padding: 20px; border-radius: 8px; text-align: center; width: 300px; margin: auto;">
            <p style="margin-bottom: 20px;">Apakah Anda yakin ingin keluar?</p>
            <button onclick="confirmLogout()" style="margin-right: 10px;">Yakin</button>
            <button onclick="cancelLogout()">Batal</button>
        </div>
    </div>
</body>

</html>
