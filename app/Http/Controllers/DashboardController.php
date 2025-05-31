<?php

namespace App\Http\Controllers;

use App\Models\ArsipDokumen;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $dokumenCount = ArsipDokumen::count();
        $usersCount = User::count();
        $divisiCount = User::distinct('role')->count('role');

        $latestDokumen = ArsipDokumen::latest()->take(3)->get();
        $popularDokumen = ArsipDokumen::orderBy('downloaded', 'desc')->take(3)->get();

        $data = [
            'title' => 'Dashboard',
            'dokumenCount' => $dokumenCount,
            'usersCount' => $usersCount,
            'divisiCount' => $divisiCount,
            'latestDokumen' => $latestDokumen,
            'popularDokumen' => $popularDokumen,
        ];

        return view('dashboard', $data);
    }
}
