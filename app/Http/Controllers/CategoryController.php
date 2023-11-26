<?php

namespace App\Http\Controllers;
use App\Models\Kategori;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Kategori::paginate(10);
        return view('kategori.index', compact('categories'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:kategori_produk|max:255',
            // Add any other validation rules you need for category creation
        ]);

        Kategori::create($request->only('nama'));
        return redirect()->route('kategori.index')->with('success', 'Category created successfully!');
    }

    public function edit(string $id)
    {
        
        $kategori = Kategori::findOrFail($id);

        //render view with post
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|unique:kategori_produk|max:255',
        ]);
    
        $kategori = Kategori::findOrFail($id);
        $kategori->update([
            'nama' => $request->nama,
        ]);
    
        return redirect()->route('kategori.index')->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        //redirect to index
        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function show(string $id)
    {
        $kategori = Kategori::findOrFail($id);

        //render view with post
        return view('kategori.show', compact('kategori'));
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('query');

        // Jika query kosong, kembalikan semua data kategori
        if (empty($searchQuery)) {
            $kategoris = Kategori::paginate(10);
        } else {
            $kategoris = Kategori::where('nama', 'LIKE', "%$searchQuery%")
                ->paginate(10);
        }
        
        return view('kategori.search', compact('kategoris'));
    }
}
