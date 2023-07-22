<?php

namespace App\Http\Controllers;

use App\Models\cart_item;
use App\Models\Cart;
use Illuminate\View\View;

use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        


        $cartData = session()->get('cart', []);

        $cart = new Cart();
        $cart->user_id = auth()->id(); // Menggunakan ID user yang sedang terautentikasi
        $cart->save();

    foreach ($cartData as $id => $item) {

        $cartItem = new cart_item();
        $cartItem->cart_id = $cart->id; // Menggunakan ID Cart yang baru dibuat
        $cartItem->product_id = $id;
        $cartItem->quantity = $item['quantity'];
        $cartItem->price = $item['price'];
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

    
}
