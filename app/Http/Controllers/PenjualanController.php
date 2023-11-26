<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\User;


class PenjualanController extends Controller
{
    
    public function index()
    {
        $userId = Auth::id();
$user = User::find($userId);

if ($user->role === 'admin') {
    // Jika pengguna memiliki peran "admin", tampilkan semua data
    $report = Cart::with('cart_items')
        ->orderByDesc('created_at')
        ->paginate(10);
} else {
    // Jika pengguna memiliki peran "user", tampilkan hanya data yang sesuai dengan ID pengguna
    $report = Cart::with('cart_items')
        ->where('user_id', $userId)
        ->orderByDesc('created_at')
        ->paginate(10);
}



    return view('penjualan.index', ['report' => $report]);
    }

    public function laporansearch(Request $request)
{


    $searchQuery = $request->input('query');
    $userId = Auth::id(); // Mendapatkan ID pengguna yang login
    $user = User::find($userId);
    if ($user->role === 'admin') {

    // Query data dengan kondisi pencarian berdasarkan id atau nama pengguna
    $report = Cart::when($searchQuery, function ($query) use ($searchQuery) {
        $query->where('id', 'like', "%$searchQuery%")
              ->orWhereHas('user', function ($subquery) use ($searchQuery) {
                  $subquery->where('name', 'like', "%$searchQuery%");
              });
    })
    ->orderByDesc('created_at')
    ->paginate(10);
    
    } else {
        $report = Cart::where(function ($query) use ($searchQuery, $userId) {
            $query->where('id', 'like', "%$searchQuery")
                ->where('user_id', $userId); // Menambahkan kondisi where untuk ID pengguna
        })
        ->orderByDesc('created_at')
        ->paginate(10);

    }

    


    return view('penjualan.search', ['report' => $report]);
}


    public function show(string $id)
    {
        $cart = Cart::find($id);
        // Memeriksa apakah data Cart dengan ID tersebut ada
    if ($cart) {
        // Mengakses data cart_items dan product_id melalui relasi 'cart_items'
        $cartItems = $cart->cart_items;
    } else {
        // Jika data Cart dengan ID tersebut tidak ditemukan
        echo "Cart dengan ID $id tidak ditemukan.";
    }
        //render view with post
        return view('penjualan.show', compact('cartItems','cart'));
    }

    public function edit(string $id)
    {
        $cart = Cart::find($id);
        // Memeriksa apakah data Cart dengan ID tersebut ada
    if ($cart) {
        // Mengakses data cart_items dan product_id melalui relasi 'cart_items'
        $cartItems = $cart->cart_items;

       
    } else {
        // Jika data Cart dengan ID tersebut tidak ditemukan
        echo "Cart dengan ID $id tidak ditemukan.";
    }
        //render view with post
        return view('penjualan.edit', compact('cartItems','cart'));  
    }

    public function update (Request $request, $id)
    {
        $request->validate([
            'status_order' => 'required|in:baru,proses,dikirim,diterima',
        ]);

        $cart = Cart::findOrFail($id);
        $cart->status_order = $request->input('status_order');
        $cart->save();

        return redirect()->route('laporan.index')->with('success', 'Status order berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        //redirect to index
        return redirect()->route('laporan.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function create()
    {
        return view('penjualan.create');
    }

    public function tes1(Request $request)
    {
        $query = $request->input('query'); // Mendapatkan input dari form pencarian

        // Hanya mencari ketika input minimal 3 karakter
        if (strlen($query) >= 1) {
            $users = User::query()
                ->where('name', 'LIKE', '%' . $query . '%')
                ->orWhere('id', $query) // Menambahkan kondisi pencarian berdasarkan ID
                ->take(2) // Batasi jumlah hasil menjadi dua
                ->get();
        } else {
            $users = []; // Jika input kurang dari 3 karakter, tidak menampilkan hasil
        }

        return response()->json($users);
    }
  

   
}
