<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $usersCount = User::count();
        $divisiCount = User::distinct('role')->count('role');

        $data = [
            'title' => 'Dashboard',
            'usersCount' => $usersCount,
            'divisiCount' => $divisiCount,
        ];

        return view('dashboard', $data);
    }
}
