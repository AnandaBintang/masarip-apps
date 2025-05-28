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
    <aside class="sidebar">
        <h2>MasAriP</h2>
        <div class="user-info">
            <span id="user-role">Role</span>
            <b>{{ $role }}</b>
            <br />
            <b style="color: rgb(0, 229, 0)">Online</b>
        </div>
        <ul class="menu" id="menu-list">

            @if ($role === 'administrator')
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Status</a></li>
                <li><a href="#">Data Pengguna</a></li>
                <li><a href="#">Kategori</a></li>
                <li><a href="#">Sarana Simpan</a></li>
                <li><a href="#">Arsip Dokumen</a></li>
                <li><a href="#">Profil Desa</a></li>
                <li><a href="#">Profil Pengguna</a></li>
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#"
                        onclick="event.preventDefault();
                            if(confirm('Apakah Anda yakin ingin keluar?')) {
                                document.getElementById('logout-form').submit();
                            }">
                        Keluar
                    </a>
                </li>
            @elseif ($role === 'petugas')
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Status</a></li>
                <li><a href="#">Data Pengguna</a></li>
                <li><a href="#">Kategori</a></li>
                <li><a href="#">Sarana Simpan</a></li>
                <li><a href="#">Arsip Dokumen</a></li>
                <li><a href="#">Profil Pengguna</a></li>
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#"
                        onclick="event.preventDefault();
                            if(confirm('Apakah Anda yakin ingin keluar?')) {
                                document.getElementById('logout-form').submit();
                            }">
                        Keluar
                    </a>
                </li>
            @elseif ($role === 'staff')
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Arsip Dokumen</a></li>
                <li><a href="#">Profil Pengguna</a></li>
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#"
                        onclick="event.preventDefault();
                            if(confirm('Apakah Anda yakin ingin keluar?')) {
                                document.getElementById('logout-form').submit();
                            }">
                        Keluar
                    </a>
                </li>
            @endif
        </ul>
    </aside>

    <h2>Data Pengguna</h2>
    <button onclick="showUserForm()">+ Tambah Pengguna</button>
    <input type="text" id="search-user" onkeyup="filterUserTable()" placeholder="Cari pengguna..."
        style="margin-left: 15px; padding: 6px; width: 200px;" />
    <button onclick="hapusTerpilih()" style="margin-left: 10px; padding: 6px;">Hapus Terpilih</button>

    <form method="POST" action="add_user.php" id="user-form"
        style="margin-top: 15px; display: none; max-width: 350px; border: 1px solid #ccc; padding: 10px; border-radius: 5px;">
        <h3>Tambah Pengguna</h3>
        <label>Nama:</label>
        <input name="nama" type="text" id="user-nama" />
        <label>Role:</label>
        <select name="role" id="user-role">
            <option value="">-- Pilih Role --</option>
            <option value="Administrator">Administrator</option>
            <option value="Petugas">Petugas</option>
            <option value="Staff Umum">Staff Umum</option>
        </select>
        <label>Username:</label>
        <input name="username" type="text" id="user-username" />
        <label>Password:</label>
        <input name="password" type="password" id="user-password" />
        <button type="submit" onclick="simpanPengguna()">Simpan</button>
        <button onclick="batalPengguna()">Batal</button>
    </form>

    <table border="1" cellpadding="10" style="margin-top: 20px; border-collapse: collapse; width: 100%;">
        <thead>
            <tr>
                <th>No</th>
                <th><input type="checkbox" id="select-all" onclick="toggleSelectAll(this)" /></th>
                <th>Nama</th>
                <th>Role</th>
                <th>Username</th>
                <th>Password</th>
                <th>Menu</th>
            </tr>
        </thead>
        <tbody id="user-table"></tbody>
    </table>
</body>

</html>
