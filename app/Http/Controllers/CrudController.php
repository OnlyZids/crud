<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Biodata; // <-- BARU: Panggil Model Biodata
use Illuminate\Support\Facades\File; // <-- BARU: Untuk bantu hapus file

class CrudController extends Controller
{
    /**
     * Tampilkan semua data
     */
    public function index()
    {
        // GANTI: $data = session('data', []);
        $data = Biodata::latest()->get(); // BARU: Ambil dari DB, urutkan yg terbaru
        
        return view('crud.index', compact('data'));
    }

    /**
     * Tampilkan form create
     */
    public function create()
    {
        return view('crud.create');
    }

    /**
     * Simpan data baru
     */
    public function store(Request $request)
    {
        // BARU: Validasi input dulu biar aman
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'keahlian' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // foto boleh kosong, maks 2MB
        ]);

        $fotoName = null;

        if ($request->hasFile('foto')) {
            $fotoName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads'), $fotoName);
        }

        // GANTI: Logika session 'id' dan 'data[]'
        
        // BARU: Langsung simpan ke DB
        Biodata::create([
            'nama' => $validated['nama'],
            'keahlian' => $validated['keahlian'],
            'foto' => $fotoName, // Simpan nama filenya
        ]);

        // GANTI: session(['data' => $data]);
        
        return redirect()->route('crud.index')->with('success', 'Data berhasil ditambah!');
    }

    /**
     * Tampilkan form edit
     */
    public function edit($id)
    {
        // GANTI: $data = session('data', []);
        // GANTI: $item = collect($data)->firstWhere('id', $id);
        
        // BARU: Cari data di DB berdasarkan ID
        $item = Biodata::findOrFail($id); // 'findOrFail' akan error 404 jika data tdk ada
        
        return view('crud.edit', compact('item'));
    }

    /**
     * Update data
     */
    public function update(Request $request, $id)
    {
        // BARU: Validasi
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'keahlian' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        // BARU: Cari datanya dulu
        $item = Biodata::findOrFail($id);

        // GANTI: Logika 'foreach'
        
        $fotoName = $item->foto; // Ambil nama foto lama

        if ($request->hasFile('foto')) {
            // BARU: Hapus foto lama jika ada foto baru
            if ($item->foto && File::exists(public_path('uploads/' . $item->foto))) {
                File::delete(public_path('uploads/' . $item->foto));
            }

            // Upload foto baru
            $fotoName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads'), $fotoName);
        }

        // BARU: Update data di DB
        $item->update([
            'nama' => $validated['nama'],
            'keahlian' => $validated['keahlian'],
            'foto' => $fotoName, // Update dengan nama file baru (atau lama jika tdk ganti)
        ]);
        
        // GANTI: session(['data' => $data]);
        return redirect()->route('crud.index')->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Hapus data
     */
    public function delete($id)
    {
        // GANTI: Logika 'collect()->reject()'
        
        // BARU: Cari datanya
        $item = Biodata::findOrFail($id);

        // BARU (PENTING): Hapus file fotonya dari folder 'uploads'
        if ($item->foto && File::exists(public_path('uploads/' . $item->foto))) {
            File::delete(public_path('uploads/' . $item->foto));
        }

        // BARU: Hapus datanya dari database
        $item->delete();

        // GANTI: session(['data' => $data]);
        return redirect()->route('crud.index')->with('success', 'Data berhasil dihapus!');
    }
}