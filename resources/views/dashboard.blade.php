@extends('layout.app')

@section('content')
    <header>
        <h1 id="page-title">Dashboard</h1>
    </header>
    <section id="main-content">
        @if (Auth::check())
            <div style="margin-bottom: 2rem; font-size: 1.25rem; color: #333;">
                Selamat Datang {{ Auth::user()->nama }}!
            </div>
        @endif
        <div class="dashboard-cards" style="display: flex; gap: 2rem; margin-bottom: 2rem; flex-wrap: wrap;">
            <div class="card"
                style="flex:1 1 250px; background: #d39e5e; border-radius: 10px; color: #fff; min-width: 220px; margin-bottom: 1rem;">
                <div style="padding: 1.5rem 1rem 1rem 1.5rem;">
                    <span style="font-size: 2.5rem; font-weight: bold; display: block;">{{ $dokumenCount }}</span>
                    <span style="font-size: 1.2rem;">Dokumen</span>
                </div>
                <a href="{{ route('arsip_dokumen.index') }}"
                    style="background: #c48b4a; border-radius: 0 0 10px 10px; padding: 1rem 1.5rem; display: flex; align-items: center; justify-content: space-between; color: #fff; text-decoration: none;">
                    <span style="font-size: 1.5rem;">More Info</span>
                    <span style="font-size: 1.5rem;"><i class="fa fa-arrow-circle-right"></i></span>
                </a>
            </div>
            @if (auth()->user()->role !== 'staff')
                <div class="card"
                    style="flex:1 1 250px; background: #d1432c; border-radius: 10px; color: #fff; min-width: 220px; margin-bottom: 1rem;">
                    <div style="padding: 1.5rem 1rem 1rem 1.5rem;">
                        <span style="font-size: 2.5rem; font-weight: bold; display: block;">{{ $divisiCount }}</span>
                        <span style="font-size: 1.2rem;">Divisi</span>
                    </div>
                    <a href="{{ route('user.index') }}"
                        style="background: #b92d1a; border-radius: 0 0 10px 10px; padding: 1rem 1.5rem; display: flex; align-items: center; justify-content: space-between;color: #fff; text-decoration: none;">
                        <span style="font-size: 1.5rem;">More Info</span>
                        <span style="font-size: 1.5rem;"><i class="fa fa-arrow-circle-right"></i></span>
                    </a>
                </div>
                <div class="card"
                    style="flex:1 1 250px; background: #6b7b3a; border-radius: 10px; color: #fff; min-width: 220px; margin-bottom: 1rem;">
                    <div style="padding: 1.5rem 1rem 1rem 1.5rem;">
                        <span style="font-size: 2.5rem; font-weight: bold; display: block;">{{ $usersCount }}</span>
                        <span style="font-size: 1.2rem;">User</span>
                    </div>
                    <a href="{{ route('user.index') }}"
                        style="background: #5a6a2e; border-radius: 0 0 10px 10px; padding: 1rem 1.5rem; display: flex; align-items: center; justify-content: space-between;color: #fff; text-decoration: none;">
                        <span style="font-size: 1.5rem;">More Info</span>
                        <span style="font-size: 1.5rem;"><i class="fa fa-arrow-circle-right"></i></span>
                    </a>
                </div>
            @endif
        </div>

        <div class="dashboard-tables" style="display: flex; gap: 2rem; flex-wrap: wrap;">
            <div style="flex:1 1 350px; min-width: 280px;">
                <div style="background: #fff; border-radius: 8px; border: 1px solid #ccc; margin-bottom: 2rem;">
                    <div
                        style="padding: 1rem 1.5rem; border-bottom: 1px solid #eee; display: flex; align-items: center; justify-content: space-between;">
                        <span style="font-size: 1.5rem; color: #6b7b3a;">Dokumen Terbaru</span>
                        <span>
                            <i class="fa fa-download" style="margin-right: 0.5rem;"></i>
                            <i class="fa fa-list"></i>
                        </span>
                    </div>
                    <div style="padding: 1rem 1.5rem; overflow-x:auto;">
                        <table
                            style="width:100%; min-width: 350px; border-collapse: collapse; font-family: Arial, sans-serif;">
                            <thead>
                                <tr style="background: linear-gradient(135deg, #6b7b3a, #5a6a2e);">
                                    <th
                                        style="font-weight: bold; padding: 12px 15px; text-align: left; color: white; border-bottom: 2px solid #4a5a28; font-size: 0.95rem;">
                                        No Dokumen</th>
                                    <th
                                        style="font-weight: bold; padding: 12px 15px; text-align: left; color: white; border-bottom: 2px solid #4a5a28; font-size: 0.95rem;">
                                        Nama Dokumen</th>
                                    <th
                                        style="font-weight: bold; padding: 12px 15px; text-align: left; color: white; border-bottom: 2px solid #4a5a28; font-size: 0.95rem;">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($latestDokumen && $latestDokumen->count() > 0)
                                    @foreach ($latestDokumen as $index => $dokumen)
                                        <tr style="background: {{ $index % 2 == 0 ? '#f8f9fa' : '#ffffff' }}; transition: all 0.2s ease;"
                                            onmouseover="this.style.background='#e8f5e8'; this.style.transform='translateX(2px)'"
                                            onmouseout="this.style.background='{{ $index % 2 == 0 ? '#f8f9fa' : '#ffffff' }}'; this.style.transform='translateX(0)'">
                                            <td
                                                style="padding: 12px 15px; border-bottom: 1px solid #e9ecef; color: #495057; font-weight: 500;">
                                                {{ $dokumen->kode_dokumen }}</td>
                                            <td
                                                style="padding: 12px 15px; border-bottom: 1px solid #e9ecef; color: #495057;">
                                                {{ $dokumen->nama_dokumen }}</td>
                                            <td
                                                style="padding: 12px 15px; border-bottom: 1px solid #e9ecef; color: #495057;">
                                                <a href="{{ route('arsip_dokumen.view', $dokumen->id) }}" target="_blank"
                                                    style="display: inline-block; padding: 6px 12px; background: linear-gradient(135deg, #007bff, #0056b3); color: white; text-decoration: none; border-radius: 4px; font-size: 0.85rem; font-weight: 500; transition: all 0.2s ease; box-shadow: 0 2px 4px rgba(0,123,255,0.2);"
                                                    onmouseover="this.style.background='linear-gradient(135deg, #0056b3, #004085)'; this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 8px rgba(0,123,255,0.3)'"
                                                    onmouseout="this.style.background='linear-gradient(135deg, #007bff, #0056b3)'; this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 4px rgba(0,123,255,0.2)'">
                                                    <i class="fa fa-eye" style="margin-right: 4px;"></i>Lihat
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="2"
                                            style="text-align: center; color: #6c757d; padding: 20px; font-style: italic; background: #f8f9fa;">
                                            <i class="fa fa-inbox"
                                                style="font-size: 1.5rem; margin-bottom: 8px; display: block; color: #adb5bd;"></i>
                                            Tidak ada dokumen terbaru
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div style="flex:1 1 350px; min-width: 280px;">
                <div style="background: #fff; border-radius: 8px; border: 1px solid #ccc; margin-bottom: 2rem;">
                    <div
                        style="padding: 1rem 1.5rem; border-bottom: 1px solid #eee; display: flex; align-items: center; justify-content: space-between;">
                        <span style="font-size: 1.5rem; color: #6b7b3a;">Dokumen Populer</span>
                        <span>
                            <i class="fa fa-download" style="margin-right: 0.5rem;"></i>
                            <i class="fa fa-list"></i>
                        </span>
                    </div>
                    <div style="padding: 1rem 1.5rem; overflow-x:auto;">
                        <table
                            style="width:100%; min-width: 350px; border-collapse: collapse; font-family: Arial, sans-serif;">
                            <thead>
                                <tr style="background: linear-gradient(135deg, #6b7b3a, #5a6a2e);">
                                    <th
                                        style="font-weight: bold; padding: 12px 15px; text-align: left; color: white; border-bottom: 2px solid #4a5a28; font-size: 0.95rem;">
                                        No Dokumen</th>
                                    <th
                                        style="font-weight: bold; padding: 12px 15px; text-align: left; color: white; border-bottom: 2px solid #4a5a28; font-size: 0.95rem;">
                                        Nama Dokumen</th>
                                    <th
                                        style="font-weight: bold; padding: 12px 15px; text-align: left; color: white; border-bottom: 2px solid #4a5a28; font-size: 0.95rem;">
                                        Download</th>
                                    <th
                                        style="font-weight: bold; padding: 12px 15px; text-align: left; color: white; border-bottom: 2px solid #4a5a28; font-size: 0.95rem;">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($popularDokumen && $popularDokumen->count() > 0)
                                    @foreach ($popularDokumen as $index => $dokumen)
                                        <tr style="background: {{ $index % 2 == 0 ? '#f8f9fa' : '#ffffff' }}; transition: all 0.2s ease;"
                                            onmouseover="this.style.background='#e8f5e8'; this.style.transform='translateX(2px)'"
                                            onmouseout="this.style.background='{{ $index % 2 == 0 ? '#f8f9fa' : '#ffffff' }}'; this.style.transform='translateX(0)'">
                                            <td
                                                style="padding: 12px 15px; border-bottom: 1px solid #e9ecef; color: #495057; font-weight: 500;">
                                                {{ $dokumen->kode_dokumen }}</td>
                                            <td
                                                style="padding: 12px 15px; border-bottom: 1px solid #e9ecef; color: #495057;">
                                                {{ $dokumen->nama_dokumen }}</td>
                                            <td
                                                style="padding: 12px 15px; border-bottom: 1px solid #e9ecef; color: #495057;">
                                                {{ $dokumen->downloaded ?? 0 }}x</td>
                                            <td
                                                style="padding: 12px 15px; border-bottom: 1px solid #e9ecef; color: #495057;">
                                                <a href="{{ route('arsip_dokumen.view', $dokumen->id) }}" target="_blank"
                                                    style="display: inline-block; padding: 6px 12px; background: linear-gradient(135deg, #007bff, #0056b3); color: white; text-decoration: none; border-radius: 4px; font-size: 0.85rem; font-weight: 500; transition: all 0.2s ease; box-shadow: 0 2px 4px rgba(0,123,255,0.2);"
                                                    onmouseover="this.style.background='linear-gradient(135deg, #0056b3, #004085)'; this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 8px rgba(0,123,255,0.3)'"
                                                    onmouseout="this.style.background='linear-gradient(135deg, #007bff, #0056b3)'; this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 4px rgba(0,123,255,0.2)'">
                                                    <i class="fa fa-eye" style="margin-right: 4px;"></i>Lihat
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3"
                                            style="text-align: center; color: #6c757d; padding: 20px; font-style: italic; background: #f8f9fa;">
                                            <i class="fa fa-inbox"
                                                style="font-size: 1.5rem; margin-bottom: 8px; display: block; color: #adb5bd;"></i>
                                            Tidak ada dokumen populer
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <style>
            @media (max-width: 900px) {
                .dashboard-cards {
                    flex-direction: column !important;
                    gap: 1rem !important;
                }

                .dashboard-tables {
                    flex-direction: column !important;
                    gap: 1rem !important;
                }
            }

            @media (max-width: 600px) {
                #main-content {
                    padding: 0 0.5rem;
                }

                .dashboard-cards .card,
                .dashboard-tables>div {
                    min-width: 0 !important;
                }

                table {
                    font-size: 0.95rem;
                }
            }
        </style>
    </section>
@endsection
