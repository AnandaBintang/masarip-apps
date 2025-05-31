@extends('layout.app')

@section('content')
    <h2>Data Arsip Dokumen</h2>
    <div class="mb-3">
        <form class="d-flex align-items-center mb-2" method="GET" action="{{ route('arsip_dokumen.index') }}">
            <input type="text" name="search" id="search-arsip" placeholder="Cari arsip dokumen..."
                value="{{ request('search') }}"
                style="padding: 0.5rem; width: 250px; border: 1px solid #ccc; border-radius: 4px; margin-right: 8px;"
                autocomplete="off" />
            <button type="submit"
                style="padding: 0.5rem 1rem; background-color: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer;">
                Cari Arsip Dokumen
            </button>
            @if (request('search'))
                <a href="{{ route('arsip_dokumen.index') }}"
                    style="padding: 0.5rem 1rem; background-color: #dc3545; color: #fff; border: none; border-radius: 4px; margin-left: 8px; text-decoration: none; display: inline-block;">
                    Hapus Pencarian
                </a>
            @endif
        </form>
    </div>

    <div class="card">
        @if (auth()->user()->role === 'administrator' || auth()->user()->role === 'petugas')
            <a href="{{ route('arsip_dokumen.create') }}">
                <button>+ Tambah Arsip Dokumen</button>
            </a>
        @endif
        <table border="1" cellpadding="10" style="margin-top: 20px; border-collapse: collapse; width: 100%;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Keterangan</th>
                    <th>Kategori</th>
                    <th>Perihal</th>
                    <th>Nama Dokumen</th>
                    <th>Tanggal Upload</th>
                    <th>Download</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="arsip-table">
                @forelse ($arsipDokumen as $arsip)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $arsip->kode_dokumen }}</td>
                        <td>{{ $arsip->keterangan }}</td>
                        <td>{{ $arsip->kategori }}</td>
                        <td>{{ $arsip->perihal }}</td>
                        <td>{{ $arsip->nama_dokumen }}</td>
                        <td>{{ $arsip->tanggal_upload }}</td>
                        <td>{{ $arsip->downloaded }}x</td>
                        <td>
                            <a href="{{ route('arsip_dokumen.view', $arsip->id) }}" target="_blank">
                                <button>Lihat Dokumen</button>
                            </a>
                            <a href="{{ route('arsip_dokumen.download', $arsip->id) }}">
                                <button>Download Dokumen</button>
                            </a>
                            <a href="{{ route('arsip_dokumen.edit', $arsip->id) }}">
                                <button>Edit</button>
                            </a>
                            <form action="{{ route('arsip_dokumen.destroy', $arsip->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Yakin ingin menghapus arsip dokumen ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 20px;">Belum ada arsip dokumen</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
