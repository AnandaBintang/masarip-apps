<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    public function index()
    {
        $roles = Auth::user()->role;
        $query = User::query();

        if ($roles != 'administrator') {
            $query->where('role', '!=', 'administrator');
        }

        if ($search = request('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%")
                    ->orWhere('role', 'like', "%{$search}%");
            });
        }

        $users = $query->get();

        $data = [
            'title' => 'Data User',
            'users' => $users,
        ];

        return view('status.index', $data);
    }
}
