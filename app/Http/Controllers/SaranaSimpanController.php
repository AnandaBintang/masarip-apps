<?php

namespace App\Http\Controllers;

use App\Models\SaranaSimpan;
use Illuminate\Http\Request;

class SaranaSimpanController extends Controller
{
    public function index()
    {
        $query = SaranaSimpan::query();

        if ($search = request('search')) {
            $query->where('kode_nomenklatur', 'like', "%{$search}%")
                ->orWhere('keterangan', 'like', "%{$search}%");
        }
        $saranaSimpan = $query->get();
        $data = [
            'title' => 'Data Sarana Simpan',
            'saranaSimpan' => $saranaSimpan,
        ];
        return view('sarana_simpan.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Sarana Simpan',
        ];
        return view('sarana_simpan.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_nomenklatur' => 'required|string|max:255',
            'keterangan' => 'required|string|max:1000',
        ]);

        SaranaSimpan::create([
            'kode_nomenklatur' => $request->kode_nomenklatur,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('sarana_simpan.index')->with('success', 'Data Sarana Simpan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $saranaSimpan = SaranaSimpan::findOrFail($id);
        $data = [
            'title' => 'Edit Sarana Simpan',
            'saranaSimpan' => $saranaSimpan,
        ];
        return view('sarana_simpan.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $saranaSimpan = SaranaSimpan::findOrFail($id);

        $request->validate([
            'kode_nomenklatur' => 'required|string|max:255',
            'keterangan' => 'required|string|max:1000',
        ]);

        $saranaSimpan->update([
            'kode_nomenklatur' => $request->kode_nomenklatur,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('sarana_simpan.index')->with('success', 'Data Sarana Simpan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $saranaSimpan = SaranaSimpan::findOrFail($id);
        $saranaSimpan->delete();

        return redirect()->route('sarana_simpan.index')->with('success', 'Data Sarana Simpan berhasil dihapus.');
    }
}
