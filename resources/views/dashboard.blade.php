@extends('layout.app')

@section('content')
    <main class="main" id="pageContents">
        <header>
            <h1 id="page-title">Dashboard</h1>
        </header>
        <section id="main-content">
            <div id="welcomeMessage" class="welcome-message"></div>
            <div id="welcomeMessage" class="welcome-message">
                <h1>Selamat datang {{ Auth::user()->nama }}!</h1>
                <p>Silakan gunakan menu di sebelah kiri untuk mengelola sistem.</p>
            </div>
        </section>
    </main>
@endsection
