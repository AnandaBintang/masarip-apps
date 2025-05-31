@extends('layout.app')

@section('content')
    <h2>Data Sarana Simpan</h2>
    <div class="mb-3">
        <form class="d-flex align-items-center mb-2" method="GET" action="{{ route('sarana_simpan.index') }}">
            <input type="text" name="search" id="search-sarana" placeholder="Cari sarana simpan..." value="{{ request('search') }}"
                style="padding: 0.5rem; width: 250px; border: 1px solid #ccc; border-radius: 4px; margin-right: 8px;"
                autocomplete="off" />
            <button type="submit"
                style="padding: 0.5rem 1rem; background-color: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer;">
                Cari Sarana Simpan
            </button>
            @if (request('search'))
                <a href="{{ route('sarana_simpan.index') }}"
                    style="padding: 0.5rem 1rem; background-color: #dc3545; color: #fff; border: none; border-radius: 4px; margin-left: 8px; text-decoration: none; display: inline-block;">
                    Hapus Pencarian
                </a>
            @endif
        </form>
    </div>

    <div class="card">
        <a href="{{ route('sarana_simpan.create') }}">
            <button>+ Tambah Sarana Simpan</button>
        </a>
        <table border="1" cellpadding="10" style="margin-top: 20px; border-collapse: collapse; width: 100%;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Nomenklatur</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="sarana-table">
                @foreach ($saranaSimpan as $sarana)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $sarana->kode_nomenklatur }}</td>
                        <td>{{ $sarana->keterangan }}</td>
                        <td>
                            <a href="{{ route('sarana_simpan.edit', $sarana->id) }}">
                                <button>Edit</button>
                            </a>
                            <form action="{{ route('sarana_simpan.destroy', $sarana->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Yakin ingin menghapus sarana simpan ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
