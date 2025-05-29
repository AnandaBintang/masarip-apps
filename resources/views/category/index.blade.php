@extends('layout.app')

@section('content')
    <h2>Data Kategori Dokumen</h2>
    <div class="mb-3">
        <form class="d-flex align-items-center mb-2" method="GET" action="{{ route('category.index') }}">
            <input type="text" name="search" id="search-category" placeholder="Cari kategori..."
                value="{{ request('search') }}"
                style="padding: 0.5rem; width: 250px; border: 1px solid #ccc; border-radius: 4px; margin-right: 8px;"
                autocomplete="off" />
            <button type="submit"
                style="padding: 0.5rem 1rem; background-color: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer;">
                Cari Kategori
            </button>
            @if (request('search'))
                <a href="{{ route('category.index') }}"
                    style="padding: 0.5rem 1rem; background-color: #dc3545; color: #fff; border: none; border-radius: 4px; margin-left: 8px; text-decoration: none; display: inline-block;">
                    Hapus Pencarian
                </a>
            @endif
        </form>
    </div>

    <div class="card">
        <a href="{{ route('category.create') }}"><button>+ Tambah Kategori</button></a>
        <table border="1" cellpadding="10" style="margin-top: 20px; border-collapse: collapse; width: 100%;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Perihal</th>
                    <th>Tujuan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="category-table">
                @if ($categories->isEmpty())
                    <tr>
                        <td colspan="5" style="text-align: center;">Tidak ada kategori yang ditemukan.</td>
                    </tr>
                @else
                    @foreach ($categories as $index => $category)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $category->nama }}</td>
                            <td>{{ $category->perihal }}</td>
                            <td>{{ $category->tujuan }}</td>
                            <td>
                                <a href="{{ route('category.edit', $category->id) }}">
                                    <button>Edit</button>
                                </a>
                                <form action="{{ route('category.destroy', $category->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Yakin ingin menghapus kategori ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endsection
