<?php

namespace App\Http\Controllers;
use App\Models\Ongkir;

use Illuminate\Http\Request;

class OngkirController extends Controller
{
    public function index()
    {
        $ongkirs = Ongkir::paginate(10);
        return view('ongkir.index', compact('ongkirs'));
    }

    public function create()
    {
        return view('ongkir.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'dasal' => 'required|max:255',
            'dtuju' => 'required|max:255',
            'biaya' => 'numeric',
            // Add any other validation rules you need for category creation
        ]);

        Ongkir::create([
            'desa_asal' => $request->dasal,
            'desa_tujuan' => $request->dtuju,
            'biaya' => $request->biaya
        ]);

        return redirect()->route('ongkirs.index')->with('success', 'Ongkir created successfully!');
    }

    public function edit(string $id)
    {
        
        $ongkir = Ongkir::findOrFail($id);

        //render view with post
        return view('ongkir.edit', compact('ongkir'));
    }

    public function show(string $id)
    {
        $ongkir = Ongkir::findOrFail($id);

        
        return view('ongkir.show', compact('ongkir'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'dasal' => 'required|max:255',
            'dtuju' => 'required|max:255',
            'biaya' => 'numeric',
        ]);
    
        $ongkir = Ongkir::findOrFail($id);
        $ongkir->update([
            'desa_asal' => $request->dasal,
            'desa_tujuan' => $request->dtuju,
            'biaya' => $request->biaya,
        ]);
    
        return redirect()->route('ongkirs.index')->with('success', 'Ongkir updated successfully!');
    }

    public function destroy($id)
    {
        $ongkir = Ongkir::findOrFail($id);
        $ongkir->delete();

        //redirect to index
        return redirect()->route('ongkirs.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('query');
        
        // Jika query kosong, kembalikan semua data kategori
        if (empty($searchQuery)) {
            $ongkirs = Ongkir::paginate(10);
        } else {
            $ongkirs = Ongkir::where(function ($query) use ($searchQuery) {
                $query->where('desa_asal', 'LIKE', "%$searchQuery%")
                      ->orWhere('desa_tujuan', 'LIKE', "%$searchQuery%");
            })
            ->paginate(10);
            
        }

        
        return view('ongkir.search', compact('ongkirs'));
    }

}
