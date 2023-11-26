<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Ongkir;
use App\Models\Kategori;
use App\Models\unit;
use App\Models\price;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{

  


    public function getUnitsByProduct($productID)
{
    $prices = Price::where('product_id', $productID)->get();

    $units = [];

    foreach ($prices as $price) {
        $unit = $price->unit; // Mengakses relasi unit yang telah Anda definisikan
        if ($unit) {
            $units[] = [
                'id' => $price->id,
                'name' => $unit->name,
            ];
        }
    }

    return response()->json($units);
}



    public function index()
    {
        // $products = Product::paginate(10);
        // $products = Product::with(['prices.unit'])->get();
        // $products = Product::with(['prices.unit'])->paginate(10);
        $products = Product::with(['prices.unit'])
        ->where('status', 'aktif')
        ->orderBy('created_at', 'desc')
        ->paginate(10);


        return view('products', compact('products'));
    }

    public function itemx()
    {
        // $products = Product::paginate(10);
        $products = Product::orderBy('created_at', 'desc')->paginate(10);

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
            'id_item'     => 'required',
            'image'       => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'name'        => 'required|min:5',
            'kategori'    => 'required|not_in:Pilih Kategori',
            'desc'        => 'required|min:10',
            'harga1'       => 'required|numeric'
        ]);

        // dd('tess');

        

        $image = $request->file('image');
        $imagePath = $image->store('public/images');

        // Create product
        $product = new Product();
        $product->id = $request->id_item;
        $product->name = $request->name;
        $product->image = $image->hashName();
        $product->id_kategori = $request->kategori;
        $product->description = $request->desc;
        $product->price = $request->harga1;
        
        $product->save();

        

        // Simpan data satuan ke tabel "units"
        $satuan1 = new unit();
        $satuan1->name = $request->satuan1;
        $satuan1->save();

        $satuan2 = new unit();
        $satuan2->name = $request->satuan2;
        $satuan2->name = !empty($request->satuan2) ? $request->satuan2 : ""; // Gunakan spasi kosong jika kosong
        $satuan2->save();

        $satuan3 = new unit();
        $satuan3->name = $request->satuan3;
        $satuan3->name = !empty($request->satuan3) ? $request->satuan3 : ""; // Gunakan spasi kosong jika kosong
        $satuan3->save();

        $harga1 = new price();
        $harga1->product_id = $product->id;
        $harga1->unit_id = $satuan1->id;
        $harga1->price = !empty($request->harga1) ? $request->harga1 : 0;
        $harga1->save();

        $harga2 = new price();
        $harga2->product_id = $product->id;
        $harga2->unit_id = $satuan2->id;
        $harga2->price = !empty($request->harga2) ? $request->harga2 : 0;
        $harga2->save();

        $harga3 = new price();
        $harga3->product_id = $product->id;
        $harga3->unit_id = $satuan3->id;
        $harga3->price = !empty($request->harga3) ? $request->harga3 : 0;
        $harga3->save();



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
            $units = $product->prices->map(function ($price) {
                return [
                    'id' => $price->id,
                    'name' => $price->unit->name,
                ];
            });

            $firstPriceId = $product->prices->first()->id;
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "description" => $product->description,
                "units" => $units->toArray(),
                "unit" => $firstPriceId,
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
        $prices = $product->prices;

        //render view with post
        return view('show', compact('kategori', 'product','prices'));
    }

    public function edit(string $id)
    {
        
        $kategori = Kategori::all();
        //get post by ID
        $product = Product::findOrFail($id);
        $prices = $product->prices;

        //render view with post
        return view('edit', compact('kategori', 'product','prices'));
    }

    public function update(Request $request, $id)
{

   
     

    // Validate form
    $this->validate($request, [
        'image'       => 'image|mimes:jpeg,jpg,png|max:2048',
        'name'        => 'required|min:5',
        'kategori'    => 'required',
        'desc'        => 'required|min:10',
        'harga1'       => 'required|numeric'
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
            'price'       => $request->harga1,
            'status'      => $request->status
        ]);

        $this->updateUnit($request->idunit1, $request->satuan1);
        $this->updateUnit($request->idunit2, $request->satuan2);
        $this->updateUnit($request->idunit3, $request->satuan3);

        $this->updatePrice($id, $request->satuan1, $request->harga1);

    // Update harga untuk unit 2
    $this->updatePrice($id, $request->satuan2, $request->harga2);

    // Update harga untuk unit 3
    $this->updatePrice($id, $request->satuan3, $request->harga3);
        
    } else {

        

        $this->updateUnit($request->idunit1, $request->satuan1);
        $this->updateUnit($request->idunit2, $request->satuan2);
        $this->updateUnit($request->idunit3, $request->satuan3);
         // Update harga untuk unit 1
    $this->updatePrice($id, $request->satuan1, $request->harga1);

    // Update harga untuk unit 2
    $this->updatePrice($id, $request->satuan2, $request->harga2);

    // Update harga untuk unit 3
    $this->updatePrice($id, $request->satuan3, $request->harga3);
        // Update product without changing the image
        $product->fill([
            'name'        => $request->name,
            'id_kategori' => $request->kategori,
            'description' => $request->desc,
            'price'       => $request->harga1,
            'status'      => $request->status
        ]);
       

        $product->save();

        
    }

    // Save the updated product to the database

    // Redirect to index
    return redirect()->route('itemx')->with(['success' => 'Data Berhasil Diubah!']);
}

private function updatePrice($productID, $unitName, $newPrice)
{
    $price = Price::where('product_id', $productID)
        ->whereHas('unit', function ($query) use ($unitName) {
            $query->where('name', $unitName);
        })->first();

    if ($price) {
        $price->price = $newPrice; // Gantilah 'harga' dengan nama field yang sesuai dalam model Price
        $price->save();

    }
}

private function updateUnit($unitID,$newName)
{
    $unit = Unit::find($unitID);
    if ($unit) {
        // Langkah 3: Update nama unit
        $unit->name = $newName ?? ''; // Gantilah 'newName' dengan input form yang sesuai
        $unit->save(); // Simpan perubahan nama unit
        }
}

public function search(Request $request)
    {
        $searchQuery = $request->input('query');
        $products = Product::where('name', 'LIKE', "%$searchQuery%")
            ->orWhere('id', 'LIKE', "%$searchQuery%")
            ->orWhere('status', 'LIKE', "%$searchQuery%")
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

   
        public function select2item(Request $request)
        {
            $query = $request->input('query'); // Mendapatkan input dari form pencarian
           
            // Hanya mencari ketika input minimal 3 karakter
            if (strlen($query) >= 3) {
                $products = Product::query()
                    ->where('name', 'LIKE', '%' . $query . '%')
                    ->orWhere('id', $query) // Menambahkan kondisi pencarian berdasarkan ID
                    ->take(4) // Batasi jumlah hasil menjadi dua
                    ->get();
                    
            }
           

            return response()->json($products);
        }

        public function getsatuan( $productId)
        {
            // Cari produk berdasarkan ID
    $product = Product::findOrFail($productId);

    // Dapatkan harga/harga-harga untuk produk ini
    $prices = $product->prices;

    // Inisialisasi array untuk menyimpan data satuan (termasuk ID price)
    $satuanData = [];

    // Loop melalui harga-harga dan mendapatkan informasi satuan beserta ID price
    foreach ($prices as $price) {
        $satuanData[] = [
            'id' => $price->id,
            'name' => $price->unit->name,
        ];
    }

    return response()->json(['satuan' => $satuanData]);
        }

        public function getHarga($priceId)
        {
            try {
                // Cari harga berdasarkan ID harga
                $price = Price::findOrFail($priceId);
                
        
                return response()->json(['harga' => $price->price]);
                
            } catch (\Exception $e) {
                // Tangani kesalahan jika harga tidak ditemukan
                return response()->json(['error' => 'Harga tidak ditemukan.'], 404);
            }
        }

        public function getHarga2($priceId)
        {
            try {
                // Cari harga berdasarkan ID harga
                $price = Price::findOrFail($priceId);
                $id = $price->product_id;
        
                // Dapatkan keranjang dari sesi
                $cart = session()->get('cart', []);
        
                // Perbarui harga produk di keranjang sesuai dengan ID produk
                $cart[$id]['price'] = $price->price;
                $cart[$id]['unit'] = $priceId;
        
                // Simpan keranjang yang diperbarui ke sesi
                session()->put('cart', $cart);
        
                return response()->json(['harga' => $price->price]);
                
            } catch (\Exception $e) {
                // Tangani kesalahan jika harga tidak ditemukan
                return response()->json(['error' => 'Harga tidak ditemukan.'], 404);
            }
        }
        


        
        
  

    
}
