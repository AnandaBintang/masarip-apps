<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $roles = Auth::user()->role;
        $query = User::with('profile');

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

        return view('user.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah User',
        ];

        return view('user.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:administrator,petugas,staff',
        ]);

        User::create([
            'nama' => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        $data = [
            'title' => 'Edit User',
            'user' => $user,
        ];

        return view('user.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:administrator,petugas,staff',
        ]);

        $user->nama = $request->name;
        $user->username = $request->username;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->role = $request->role;
        $user->save();

        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }
}
