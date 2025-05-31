@extends('layout.app')

@section('content')
    <h2>Data Pengguna</h2>
    <div class="mb-3">
        <form class="d-flex align-items-center mb-2" method="GET" action="{{ route('user.index') }}">
            <input type="text" name="search" id="search-user" placeholder="Cari pengguna..." value="{{ request('search') }}"
                style="padding: 0.5rem; width: 250px; border: 1px solid #ccc; border-radius: 4px; margin-right: 8px;"
                autocomplete="off" />
            <button type="submit"
                style="padding: 0.5rem 1rem; background-color: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer;">
                Cari Pengguna
            </button>
            @if (request('search'))
                <a href="{{ route('user.index') }}"
                    style="padding: 0.5rem 1rem; background-color: #dc3545; color: #fff; border: none; border-radius: 4px; margin-left: 8px; text-decoration: none; display: inline-block;">
                    Hapus Pencarian
                </a>
            @endif
        </form>
    </div>

    <div class="card">
        <a href="{{ route('user.create') }}">
            <button>+ Tambah Pengguna</button>
        </a>
        <table border="1" cellpadding="10" style="margin-top: 20px; border-collapse: collapse; width: 100%;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Role</th>
                    <th>Username</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="user-table">
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->nama }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->username }}</td>
                        <td>
                            <button type="button"
                                onclick="showProfile({{ $user->id }}, '{{ $user->nama }}', '{{ $user->role }}', '{{ $user->username }}', '{{ $user->profile->foto_profil ?? '' }}', '{{ $user->profile->jabatan ?? '' }}', '{{ $user->profile->no_telpon ?? '' }}')"
                                style="padding: 0.3rem 0.6rem; background-color: #17a2b8; color: #fff; border: none; border-radius: 4px; cursor: pointer; margin-right: 4px;">
                                Lihat Profil
                            </button>
                            <a href="{{ route('user.edit', $user->id) }}">
                                <button>Edit</button>
                            </a>
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Yakin ingin menghapus pengguna ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center;">Tidak ada data pengguna.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div id="profileModal"
        style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5);">
        <div
            style="background-color: #fff; margin: 5% auto; padding: 0; border-radius: 12px; width: 500px; position: relative; box-shadow: 0 10px 30px rgba(0,0,0,0.3); overflow: hidden;">

            <!-- Modal Header -->
            <div
                style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px; position: relative;">
                <span onclick="closeModal()"
                    style="color: white; position: absolute; right: 15px; top: 15px; font-size: 24px; font-weight: bold; cursor: pointer; opacity: 0.8; transition: opacity 0.3s;">&times;</span>
                <h3 style="margin: 0; font-size: 24px; font-weight: 600;">Profil Pengguna</h3>
            </div>

            <!-- Modal Body -->
            <div style="padding: 30px;">
                <div style="text-align: center; margin-bottom: 25px;">
                    <div
                        style="width: 80px; height: 80px; border-radius: 50%; margin: 0 auto 15px; overflow: hidden; border: 4px solid #e9ecef; background-color: #f8f9fa;">
                        <img id="profileImage" src="" alt="Profile"
                            style="width: 100%; height: 100%; object-fit: cover; display: none;"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div id="defaultAvatar"
                            style="width: 100%; height: 100%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 24px; font-weight: bold;">
                        </div>
                    </div>
                    <h4 id="profileNama" style="margin: 0; color: #343a40; font-size: 20px; font-weight: 600;"></h4>
                    <span id="profileRole"
                        style="display: inline-block; background-color: #007bff; color: white; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 500; text-transform: uppercase; margin-top: 8px;"></span>
                </div>

                <div style="background-color: #f8f9fa; border-radius: 8px; padding: 20px;">
                    <div style="display: grid; gap: 15px;">
                        <div style="display: flex; align-items: center;">
                            <div
                                style="width: 40px; height: 40px; background-color: #28a745; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                                <span style="color: white; font-weight: bold;">@</span>
                            </div>
                            <div>
                                <div style="font-size: 12px; color: #6c757d; font-weight: 500;">Username</div>
                                <div id="profileUsername" style="font-weight: 600; color: #343a40;"></div>
                            </div>
                        </div>

                        <div id="jabatanContainer" style="display: flex; align-items: center;">
                            <div
                                style="width: 40px; height: 40px; background-color: #ffc107; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                                <span style="color: white; font-weight: bold;">💼</span>
                            </div>
                            <div>
                                <div style="font-size: 12px; color: #6c757d; font-weight: 500;">Jabatan</div>
                                <div id="profileJabatan" style="font-weight: 600; color: #343a40;"></div>
                            </div>
                        </div>

                        <div id="teleponContainer" style="display: flex; align-items: center;">
                            <div
                                style="width: 40px; height: 40px; background-color: #17a2b8; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                                <span style="color: white; font-weight: bold;">📞</span>
                            </div>
                            <div>
                                <div style="font-size: 12px; color: #6c757d; font-weight: 500;">Nomor Telepon</div>
                                <div id="profileTelepon" style="font-weight: 600; color: #343a40;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showProfile(id, nama, role, username, fotoProfil, jabatan, nomorTelepon) {
            document.getElementById('profileNama').textContent = nama;
            document.getElementById('profileRole').textContent = role;
            document.getElementById('profileUsername').textContent = username;

            // Handle profile image
            const profileImage = document.getElementById('profileImage');
            const defaultAvatar = document.getElementById('defaultAvatar');

            if (fotoProfil && fotoProfil.trim() !== '') {
                profileImage.src = '/' + fotoProfil;
                profileImage.style.display = 'block';
                defaultAvatar.style.display = 'none';
            } else {
                profileImage.style.display = 'none';
                defaultAvatar.style.display = 'flex';
                defaultAvatar.textContent = nama.charAt(0).toUpperCase();
            }

            // Handle jabatan
            const jabatanContainer = document.getElementById('jabatanContainer');
            const profileJabatan = document.getElementById('profileJabatan');
            if (jabatan && jabatan.trim() !== '') {
                profileJabatan.textContent = jabatan;
                jabatanContainer.style.display = 'flex';
            } else {
                jabatanContainer.style.display = 'none';
            }

            // Handle nomor telepon
            const teleponContainer = document.getElementById('teleponContainer');
            const profileTelepon = document.getElementById('profileTelepon');
            if (nomorTelepon && nomorTelepon.trim() !== '') {
                profileTelepon.textContent = nomorTelepon;
                teleponContainer.style.display = 'flex';
            } else {
                teleponContainer.style.display = 'none';
            }

            document.getElementById('profileModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('profileModal').style.display = 'none';
        }

        window.onclick = function(event) {
            var modal = document.getElementById('profileModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>
@endsection
