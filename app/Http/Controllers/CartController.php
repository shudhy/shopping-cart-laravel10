<?php

namespace App\Http\Controllers;

use App\Models\cart_item;
use App\Models\Cart;
use Illuminate\View\View;

use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

class CartController extends Controller
{

    public function delete($id)
{
    // Temukan item berdasarkan ID dan hapus
    $item = cart_item::find($id);


    if ($item) {
        $item->delete();
        return response()->json(['message' => 'Item deleted successfully']);
    } else {
        return response()->json(['message' => 'Item not found'], 404);
    }
}

    public function updateStatus(Request $request, Cart $cart)
    {
        $newStatus = $request->input('newStatus');
        
        // Validasi status jika perlu

        $cart->status_order = $newStatus;
        $cart->save();

        return response()->json(['message' => 'Status has been updated.']);
    }
    
    public function updateQuantities(Request $request): RedirectResponse
    {
       
        $updates = $request->input('updates');

        foreach ($updates as $update) {
            $itemID = $update['itemID'];
            $newQuantity = $update['newQuantity'];
            $selectedSatuan = $update['selectedSatuan'];
            $newDataPrice = $update['newDataPrice'];

            $cartItem = cart_item::findOrFail($itemID);
            $cartItem->quantity = $newQuantity;
            $cartItem->unit = $selectedSatuan;
            $cartItem->price = $newDataPrice;
            $cartItem->save();

            
        }

    }
    

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'alamat' => 'required',
            'desa_tujuan' => 'required|numeric',
            'tlpn' => 'required|numeric|min:11',
            'metode_pembayaran' => 'required|numeric',
            // tambahkan aturan validasi lainnya jika diperlukan
        ]);


        $cartData = session()->get('cart', []);

        $cart = new Cart();
        $cart->user_id = auth()->id(); // Menggunakan ID user yang sedang terautentikasi
        $cart->tanggal = now(); // Menyimpan tanggal hari ini
        $cart->save();

    foreach ($cartData as $id => $item) {

        $cartItem = new cart_item();
        $cartItem->cart_id = $cart->id; // Menggunakan ID Cart yang baru dibuat
        $cartItem->product_id = $id;
        $cartItem->quantity = $item['quantity'];
        $cartItem->unit = $item['unit'];
        $cartItem->price = $item['price'];
        $cartItem->tanggal = now(); // Menyimpan tanggal hari ini
        $cartItem->save();
    }

        // Menambahkan informasi pengiriman dari form
        $cart->alamat_tujuan = $request->input('alamat');
        $cart->desa = $request->input('desa_tujuan');
        $cart->no_tlpn = $request->input('tlpn');
        $cart->ongkos_kirim = $request->input('ongkos_kirim');
        $cart->metode_pembayaran = $request->input('metode_pembayaran');
        $cart->save();

    session()->forget('cart');

    return redirect()->back()->with('success', 'Cart has been stored in the database.');
    }

    public function storeitem(Request $request): RedirectResponse
        {
            $cart = new Cart();
            $cart->user_id = $request->input('customer_name'); // Menggunakan ID user yang sedang terautentikasi
            $cart->tanggal = $request->input('tanggal'); // Menyimpan tanggal penjualan
            $cart->save();

            if ($cart->id) {
                $dataToSave = $request->input('data_to_save');

                if (is_array($dataToSave) && count($dataToSave) > 0) {
                    foreach ($dataToSave as $data) {
                        $cartItem = new cart_item();
                        $cartItem->cart_id = $cart->id; // Menggunakan ID Cart yang baru dibuat
                        $cartItem->product_id = $data['kode_produk'];
                        $cartItem->quantity = $data['quantity'];
                        $cartItem->unit = $data['unit'];
                        $cartItem->price = $data['harga'];
                        $cartItem->tanggal = $cart->tanggal;
                        $cartItem->save();
                    }
                }
            }

            return redirect()->route('laporan.index')->with(['success' => 'Data Berhasil disimpan!']);
        }


    public function tes()
    {
        
        return view('tes');
    }

    
public function getNewOrderCount() {
    // Ambil jumlah status order baru dari tabel Cart
    $newOrderCount = Cart::where('status_order', 'baru')->count();

    // Kirim jumlah sebagai respons JSON
    return response()->json(['newOrderCount' => $newOrderCount]);
   
}


    
    
}
