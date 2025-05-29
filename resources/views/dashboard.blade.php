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
                    <span style="font-size: 2.5rem; font-weight: bold; display: block;">0</span>
                    <span style="font-size: 1.2rem;">Dokumen</span>
                </div>
                <a href="#"
                    style="background: #c48b4a; border-radius: 0 0 10px 10px; padding: 1rem 1.5rem; display: flex; align-items: center; justify-content: space-between; color: #fff; text-decoration: none;">
                    <span style="font-size: 1.5rem;">More Info</span>
                    <span style="font-size: 1.5rem;"><i class="fa fa-arrow-circle-right"></i></span>
                </a>
            </div>
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
                        <table style="width:100%; min-width: 350px;">
                            <thead>
                                <tr>
                                    <th style="font-weight:bold;">No Dokumen</th>
                                    <th style="font-weight:bold;">Nama Dokumen</th>
                                    <th style="font-weight:bold;">Pengguna</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="3" style="text-align:center; color:#888;">-</td>
                                </tr>
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
                        <table style="width:100%; min-width: 400px;">
                            <thead>
                                <tr>
                                    <th style="font-weight:bold;">No Dokumen</th>
                                    <th style="font-weight:bold;">Nama Dokumen</th>
                                    <th style="font-weight:bold;">Viewer</th>
                                    <th style="font-weight:bold;">Downloader</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="4" style="text-align:center; color:#888;">-</td>
                                </tr>
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
