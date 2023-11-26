<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\cart_item;
use App\Models\User;

class DetailPenjualanController extends Controller
{
    public function index()
    {
       
        $userId = Auth::id();
        $user = User::find($userId);

        if ($user->role === 'admin') {
            // Jika pengguna memiliki peran "admin", tampilkan semua data
            $report = cart_item::orderByDesc('created_at')->paginate(10);
          
        } else {
            $report = cart_item::whereHas('cart', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->orderByDesc('created_at')
            ->paginate(10);
        }

        return view('detailpenjualan.index', ['report' => $report]);
    }
}
