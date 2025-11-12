<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Biodata;
use Illuminate\Support\Facades\File; 

class CrudController extends Controller
{

    public function index()
    {
        $data = Biodata::latest()->get(); 
        
        return view('crud.index', compact('data'));
    }
    public function create()
    {
        return view('crud.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'keahlian' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', //  maks 2MB
        ]);

        $fotoName = null;

        if ($request->hasFile('foto')) {
            $fotoName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads'), $fotoName);
        }

        Biodata::create([
            'nama' => $validated['nama'],
            'keahlian' => $validated['keahlian'],
            'foto' => $fotoName, 
        ]);
        
        return redirect()->route('crud.index')->with('success', 'Data berhasil ditambah!');
    }
    public function edit($id)
    {
        $item = Biodata::findOrFail($id); 
        
        return view('crud.edit', compact('item'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'keahlian' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $item = Biodata::findOrFail($id);
        $fotoName = $item->foto;

        if ($request->hasFile('foto')) {
            if ($item->foto && File::exists(public_path('uploads/' . $item->foto))) {
                File::delete(public_path('uploads/' . $item->foto));
            }
            $fotoName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads'), $fotoName);
        }
        $item->update([
            'nama' => $validated['nama'],
            'keahlian' => $validated['keahlian'],
            'foto' => $fotoName, 
        ]);
        
        return redirect()->route('crud.index')->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Hapus data
     */
    public function delete($id)
    {
        $item = Biodata::findOrFail($id);
        if ($item->foto && File::exists(public_path('uploads/' . $item->foto))) {
            File::delete(public_path('uploads/' . $item->foto));
        }
        $item->delete();
        return redirect()->route('crud.index')->with('success', 'Data berhasil dihapus!');
    }
}