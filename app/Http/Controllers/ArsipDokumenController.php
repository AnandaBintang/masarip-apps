<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArsipDokumen;
use App\Models\Category;
use App\Models\SaranaSimpan;
use Illuminate\Support\Facades\File;
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
        $saranaSimpan = SaranaSimpan::all();
        $category = Category::all();

        if ($saranaSimpan->isEmpty()) {
            return redirect()->route('sarana_simpan.create')->with('warning', 'Silakan buat sarana simpan terlebih dahulu.');
        }

        if ($category->isEmpty()) {
            return redirect()->route('category.create')->with('warning', 'Silakan buat kategori terlebih dahulu.');
        }

        $data = [
            'title' => 'Tambah Dokumen',
            'saranaSimpan' => $saranaSimpan,
            'category' => $category,
        ];

        return view('arsip_dokumen.create', $data);
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
        $filename = Str::slug($request->nama_dokumen) . '.' . $file->getClientOriginalExtension();

        $destination = base_path('../public_html/dokumen');

        if (!File::exists($destination)) {
            File::makeDirectory($destination, 0755, true);
        }

        $file->move($destination, $filename);

        $arsipDokumen = new ArsipDokumen();
        $arsipDokumen->kode_dokumen = $request->kode_dokumen;
        $arsipDokumen->keterangan = $request->keterangan;
        $arsipDokumen->kategori = $request->kategori;
        $arsipDokumen->perihal = $request->perihal;
        $arsipDokumen->nama_dokumen = $request->nama_dokumen;
        $arsipDokumen->tanggal_upload = $request->tanggal_upload;
        $arsipDokumen->file_path = 'dokumen/' . $filename; // relatif dari public_html
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
            $destination = base_path('../public_html/dokumen');

            if (!File::exists($destination)) {
                File::makeDirectory($destination, 0755, true);
            }

            if ($arsipDokumen->file_path) {
                $oldFile = base_path('../public_html/' . $arsipDokumen->file_path);
                if (File::exists($oldFile)) {
                    File::delete($oldFile);
                }
            }

            $file = $request->file('file');
            $filename = Str::slug($request->nama_dokumen) . '.' . $file->getClientOriginalExtension();
            $file->move($destination, $filename);

            $arsipDokumen->file_path = 'dokumen/' . $filename;
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
        $filePath = base_path('../public_html/' . $arsipDokumen->file_path);

        if (file_exists($filePath)) {
            $arsipDokumen->downloaded += 1;
            $arsipDokumen->save();

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
        $filePath = base_path('../public_html/' . $arsipDokumen->file_path);

        if (file_exists($filePath)) {
            return response()->file($filePath);
        }

        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }
}
