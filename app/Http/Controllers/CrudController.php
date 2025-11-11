<?php 
 
namespace App\Http\Controllers; 
 
use Illuminate\Http\Request; 
 
class CrudController extends Controller 
{ 
    public function index() { 
        $data = session('data', []); 
        return view('crud.index', compact('data')); 
    } 
 
    public function create() { 
        return view('crud.create'); 
    } 
 
    public function store(Request $request) { 
        $data = session('data', []); 
 
        $id = count($data) + 1; 
        $fotoName = null; 
 
        if ($request->hasFile('foto')) { 
            $fotoName = time().'.'.$request->foto->extension(); 
            $request->foto->move(public_path('uploads'), $fotoName); 
        } 
 
        $data[] = [ 
            'id' => $id, 
            'nama' => $request->nama, 
            'keahlian' => $request->keahlian, 
            'foto' => $fotoName 
        ]; 
 
        session(['data' => $data]); 
 
        return redirect()->route('crud.index'); 
    } 
 
    public function edit($id) { 
        $data = session('data', []); 
        $item = collect($data)->firstWhere('id', $id); 
        return view('crud.edit', compact('item')); 
    } 
 
    public function update(Request $request, $id) { 
        $data = session('data', []); 
        foreach ($data as &$item) { 
            if ($item['id'] == $id) { 
                $item['nama'] = $request->nama; 
                $item['keahlian'] = $request->keahlian; 
 
                if ($request->hasFile('foto')) { 
                    $fotoName = time().'.'.$request->foto->extension(); 
                    $request->foto->move(public_path('uploads'), $fotoName); 
                    $item['foto'] = $fotoName; 
                } 
            } 
        } 
 
        session(['data' => $data]); 
        return redirect()->route('crud.index'); 
    } 
 
    public function delete($id) { 
        $data = collect(session('data', [])) 
            ->reject(fn($item) => $item['id'] == $id) 
            ->values() 
            ->all(); 
 
        session(['data' => $data]); 
        return redirect()->route('crud.index'); 
    } 
} 