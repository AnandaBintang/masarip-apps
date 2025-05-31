<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArsipDokumen;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ArsipDokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = ArsipDokumen::query();
        if (request()->has('search')) {
            $search = request()->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('kode_dokumen', 'like', "%{$search}%")
                    ->orWhere('keterangan', 'like', "%{$search}%")
                    ->orWhere('kategori', 'like', "%{$search}%")
                    ->orWhere('perihal', 'like', "%{$search}%")
                    ->orWhere('nama_dokumen', 'like', "%{$search}%");
            });
        }
        $arsipDokumen = $query->orderBy('created_at', 'desc')->paginate(10);

        $data = [
            'arsipDokumen' => $arsipDokumen,
            'search' => request()->input('search', ''),
        ];

        return view('arsip_dokumen.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('arsip_dokumen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_dokumen' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'kategori' => 'required|in:Surat Masuk,Surat Keluar,Lainnya',
            'perihal' => 'required|string|max:255',
            'nama_dokumen' => 'required|string|max:255',
            'tanggal_upload' => 'required|date',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $file = $request->file('file');
        $filePath = $file->storeAs('dokumen', Str::slug($request->nama_dokumen) . '.' . $file->getClientOriginalExtension(), 'public');

        $arsipDokumen = new ArsipDokumen();
        $arsipDokumen->kode_dokumen = $request->kode_dokumen;
        $arsipDokumen->keterangan = $request->keterangan;
        $arsipDokumen->kategori = $request->kategori;
        $arsipDokumen->perihal = $request->perihal;
        $arsipDokumen->nama_dokumen = $request->nama_dokumen;
        $arsipDokumen->tanggal_upload = $request->tanggal_upload;
        $arsipDokumen->file_path = $filePath;
        $arsipDokumen->file_name = $file->getClientOriginalName();
        $arsipDokumen->file_type = $file->getClientMimeType();
        $arsipDokumen->save();

        return redirect()->route('arsip_dokumen.index')->with('success', 'Dokumen berhasil disimpan.');
    }

    public function edit($id)
    {
        $arsipDokumen = ArsipDokumen::findOrFail($id);
        return view('arsip_dokumen.edit', compact('arsipDokumen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kode_dokumen' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'kategori' => 'required|in:Surat Masuk,Surat Keluar,Lainnya',
            'perihal' => 'required|string|max:255',
            'nama_dokumen' => 'required|string|max:255',
            'tanggal_upload' => 'required|date',
            'file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $arsipDokumen = ArsipDokumen::findOrFail($id);
        $arsipDokumen->kode_dokumen = $request->kode_dokumen;
        $arsipDokumen->keterangan = $request->keterangan;
        $arsipDokumen->kategori = $request->kategori;
        $arsipDokumen->perihal = $request->perihal;
        $arsipDokumen->nama_dokumen = $request->nama_dokumen;
        $arsipDokumen->tanggal_upload = $request->tanggal_upload;
        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($arsipDokumen->file_path) {
                Storage::disk('public')->delete($arsipDokumen->file_path);
            }
            $file = $request->file('file');
            $filePath = $file->storeAs('dokumen', Str::slug($request->nama_dokumen) . '.' . $file->getClientOriginalExtension(), 'public');
            $arsipDokumen->file_path = $filePath;
            $arsipDokumen->file_name = $file->getClientOriginalName();
            $arsipDokumen->file_type = $file->getClientMimeType();
        }
        $arsipDokumen->save();
        return redirect()->route('arsip_dokumen.index')->with('success', 'Dokumen berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $arsipDokumen = ArsipDokumen::findOrFail($id);
        // Hapus file dari storage
        if ($arsipDokumen->file_path) {
            Storage::disk('public')->delete($arsipDokumen->file_path);
        }
        $arsipDokumen->delete();
        return redirect()->route('arsip_dokumen.index')->with('success', 'Dokumen berhasil dihapus.');
    }

    /**
     * Download the specified document.
     */
    public function download($id)
    {
        $arsipDokumen = ArsipDokumen::findOrFail($id);
        if (Storage::disk('public')->exists($arsipDokumen->file_path)) {
            $arsipDokumen->downloaded += 1;
            $arsipDokumen->save();

            $filePath = Storage::disk('public')->path($arsipDokumen->file_path);
            return response()->download($filePath, $arsipDokumen->file_name);
        }

        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }

    /**
     * View the specified document.
     */
    public function view($id)
    {
        $arsipDokumen = ArsipDokumen::findOrFail($id);
        if (Storage::disk('public')->exists($arsipDokumen->file_path)) {
            $filePath = Storage::disk('public')->path($arsipDokumen->file_path);
            return response()->file($filePath);
        }
        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }
}
