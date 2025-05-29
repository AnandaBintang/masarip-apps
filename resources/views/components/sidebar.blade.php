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
            <li>
                <a class="{{ request()->is('dashboard*') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li><a class="{{ request()->is('status*') ? 'active' : '' }}" href="{{ route('status.index') }}">Status</a>
            </li>
            <li>
                <a class="{{ request()->is('user*') ? 'active' : '' }}" href="{{ route('user.index') }}">Data
                    Pengguna</a>
            </li>
            <li><a class="{{ request()->is('category*') ? 'active' : '' }}"
                    href="{{ route('category.index') }}">Kategori</a></li>
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
            <li><a class="{{ request()->is('dashboard*') ? 'active' : '' }}"
                    href="{{ route('dashboard') }}">Dashboard</a></li>
            <li><a class="{{ request()->is('status*') ? 'active' : '' }}"
                    href="{{ route('status.index') }}">Status</a></li>
            <li><a class="{{ request()->is('user*') ? 'active' : '' }}" href="{{ route('user.index') }}">Data
                    Pengguna</a></li>
            <li><a class="{{ request()->is('category*') ? 'active' : '' }}"
                    href="{{ route('category.index') }}">Kategori</a></li>
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
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
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
