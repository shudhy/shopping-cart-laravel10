<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Ongkir;
use App\Models\Kategori;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(2);
        return view('products', compact('products'));
    }

    public function itemx()
    {
        $products = Product::paginate(2);
        return view('items', compact('products'));
    }

    public function itemadd()
    {
        $kategori = Kategori::all();
        return view('itemadd', compact('kategori'));
    }

    public function itemstore(Request $request)
    {
        // Validasi form
        $validatedData = $request->validate([
            'image'       => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'name'        => 'required|min:5',
            'kategori'    => 'required',
            'desc'        => 'required|min:10',
            'price'       => 'required|numeric'
        ]);

        

        $image = $request->file('image');
        $imagePath = $image->store('public/images');

        // Create product
        $product = new Product();
        $product->name = $request->name;
        $product->image = $image->hashName();
        $product->id_kategori = $request->kategori;
        $product->description = $request->desc;
        $product->price = $request->price;
        $product->save();

        // Redirect to index
        return redirect()->route('itemx')->with('success', 'Data Berhasil Disimpan!');
    }


    public function productCart()
    {
        $ongkirList = Ongkir::all();
        return view('cart', compact('ongkirList'));
    }
    public function addProducttoCart($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "description" => $product->description
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product has been added to cart!');
    }
    public function minProducttoCart($id)
{
    $product = Product::findOrFail($id);
    $cart = session()->get('cart', []);
    
    if(isset($cart[$id])) {
        $cart[$id]['quantity']--;

        // Hapus item cart jika quantity menjadi 0
        if($cart[$id]['quantity'] == 0) {
            unset($cart[$id]);
        }
    } 
    
    session()->put('cart', $cart);
    return redirect()->back()->with('success', 'Product has been added to cart!');
}

   

    public function deleteProduct(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product successfully deleted.');
        }
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        
        Storage::delete('public/images/'. $product->image);

        //delete post
        $product->delete();

        //redirect to index
        return redirect()->route('itemx')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function show(string $id)
    {
        $kategori = Kategori::all();
        //get post by ID
        $product = Product::findOrFail($id);

        //render view with post
        return view('show', compact('kategori', 'product'));
    }

    public function edit(string $id)
    {
        
        $kategori = Kategori::all();
        //get post by ID
        $product = Product::findOrFail($id);

        //render view with post
        return view('edit', compact('kategori', 'product'));
    }

    public function update(Request $request, $id)
{
    // Validate form
    $this->validate($request, [
        'image'       => 'image|mimes:jpeg,jpg,png|max:2048',
        'name'        => 'required|min:5',
        'kategori'    => 'required',
        'desc'        => 'required|min:10',
        'price'       => 'required|numeric'
    ]);

    // Get product by ID
    $product = Product::findOrFail($id);

    // Check if image is uploaded
    if ($request->hasFile('image')) {
        // Upload new image
        $gambar = $request->file('image')->hashName();
        $request->file('image')->storeAs('public/images', $gambar);

        // Delete old image
        Storage::delete('public/images/' . $product->image);

        // Update product with new image
        $product->fill([
            'image'       => $gambar,
            'name'        => $request->name,
            'id_kategori' => $request->kategori,
            'description' => $request->desc,
            'price'       => $request->price
        ]);
    } else {
        // Update product without changing the image
        $product->fill([
            'name'        => $request->name,
            'id_kategori' => $request->kategori,
            'description' => $request->desc,
            'price'       => $request->price
        ]);
    }

    // Save the updated product to the database
    $product->save();

    // Redirect to index
    return redirect()->route('itemx')->with(['success' => 'Data Berhasil Diubah!']);
}

public function search(Request $request)
    {$searchQuery = $request->input('query');
        $products = Product::where('name', 'LIKE', "%$searchQuery%")
            ->orWhere('id', 'LIKE', "%$searchQuery%")
            ->orWhereHas('category', function ($query) use ($searchQuery) {
                $query->where('nama', 'LIKE', "%$searchQuery%");
            })
            ->paginate(10);

        return view('search', compact('products'));
    }

    public function searchh(Request $request)
    {$searchQuery = $request->input('query');
        $products = Product::where('name', 'LIKE', "%$searchQuery%")
            ->orWhere('id', 'LIKE', "%$searchQuery%")
            ->orWhereHas('category', function ($query) use ($searchQuery) {
                $query->where('nama', 'LIKE', "%$searchQuery%");
            })
            ->paginate(10);

        return view('productsearch', compact('products'));
    }
    
}
