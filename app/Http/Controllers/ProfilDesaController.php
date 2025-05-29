<?php

namespace App\Http\Controllers;

use App\Models\ProfilDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilDesaController extends Controller
{
    public function index()
    {
        $profilDesa = ProfilDesa::first();

        $data = [
            'title' => 'Profil Desa',
            'profilDesa' => $profilDesa,
        ];

        return view('profil_desa.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kantor_desa' => 'required|string|max:255',
            'nama_website' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'alamat_kantor' => 'required|string|max:255',
            'deskripsi_website' => 'nullable|string',
            'kata_kunci' => 'nullable|string|max:255',
        ]);

        $profilDesa = ProfilDesa::firstOrNew([]);
        $profilDesa->nama_kantor_desa = $request->nama_kantor_desa;
        $profilDesa->nama_website = $request->nama_website;
        $profilDesa->alamat_kantor = $request->alamat_kantor;
        $profilDesa->deskripsi_website = $request->deskripsi_website;
        $profilDesa->kata_kunci = $request->kata_kunci;

        if ($request->hasFile('logo')) {
            if ($profilDesa->logo) {
                Storage::disk('public')->delete($profilDesa->logo);
            }
            $profilDesa->logo = $request->file('logo')->store('logos', 'public');
        }

        $profilDesa->save();

        return redirect()->route('profil_desa.index')->with('success', 'Profil Desa berhasil disimpan.');
    }
}
