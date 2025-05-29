<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileUserController extends Controller
{
    /**
     * Display the profile of the authenticated user.
     */
    public function showProfile()
    {
        $user = Auth::user();
        $profile = $user->profile;

        $data = [
            'title' => 'Profil Pengguna',
            'foto_profil' => $profile ? $profile->foto_profil : null,
            'jabatan' => $profile ? $profile->jabatan : null,
            'no_telpon' => $profile ? $profile->no_telpon : null,
            'nama_lengkap' => $user->nama,
            'username' => $user->username,
        ];

        return view('profile.show', $data);
    }

    /**
     * Update the profile of the authenticated user.
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'foto_profil' => 'nullable|image|max:2048',
            'jabatan' => 'nullable|string|max:255',
            'no_telpon' => 'nullable|string|max:15',
            'nama_lengkap' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . Auth::id(),
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        $profile = $user->profile()->firstOrCreate([]);

        if ($request->hasFile('foto_profil')) {
            $path = $request->file('foto_profil')->store('profile_pictures', 'public');
            $profile->foto_profil = $path;
        }

        $profile->jabatan = $request->input('jabatan');
        $profile->no_telpon = $request->input('no_telpon');

        $user->nama = $request->input('nama_lengkap');
        $user->username = $request->input('username');

        $passwordChanged = false;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
            $passwordChanged = true;
        }

        $user->save();
        $profile->save();

        if ($passwordChanged) {
            Auth::logout();
            return redirect()->route('login')->with('success', 'Password berhasil diganti. Mohon Login kembali.');
        }

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }
}
