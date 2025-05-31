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
                    <th>Status</th>
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
                            @if ($user->is_online)
                                <span
                                    style="display: inline-block; padding: 0.25em 0.75em; background-color: #28a745; color: #fff; border-radius: 12px; font-size: 0.9em;">
                                    Online
                                </span>
                            @else
                                <span
                                    style="display: inline-block; padding: 0.25em 0.75em; background-color: #dc3545; color: #fff; border-radius: 12px; font-size: 0.9em;">
                                    Offline
                                </span>
                            @endif
                        <td>
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
                        <td colspan="6" style="text-align: center;">Tidak ada data pengguna.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
