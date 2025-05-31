<?php

namespace App\Http\Controllers;

use App\Models\ProfilDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

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
            $destination = base_path('../public_html/logos');

            // Buat folder jika belum ada
            if (!File::exists($destination)) {
                File::makeDirectory($destination, 0755, true);
            }

            // Hapus logo lama jika ada
            if ($profilDesa->logo) {
                $oldLogoPath = base_path('../public_html/' . $profilDesa->logo);
                if (File::exists($oldLogoPath)) {
                    File::delete($oldLogoPath);
                }
            }

            $file = $request->file('logo');
            $filename = 'logo-' . Str::slug($request->nama_kantor_desa) . '.' . $file->getClientOriginalExtension();
            $file->move($destination, $filename);

            $profilDesa->logo = 'logos/' . $filename; // path relative to public_html
        }

        $profilDesa->save();

        return redirect()->route('profil_desa.index')->with('success', 'Profil Desa berhasil disimpan.');
    }
}
