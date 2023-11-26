<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::paginate(10); // Ambil semua data pengguna dari model User
        return view('auth.index', compact('users')); // Tampilkan view dengan data pengguna
    }

    public function create()
    {
        return view('auth.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed',
            'role'    => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect()->route('users.index')
        ->withSuccess('You have successfully add users');
    }

    public function show(string $id)
    {
        $user = User::findOrFail($id);

        //render view with post
        return view('auth.show', compact('user'));
    }

    public function edit(string $id)
    {
        
        $user = User::findOrFail($id);

        //render view with post
        return view('auth.edit', compact('user'));
    }

    public function gantipassword(string $id)
    {
        
        $user = User::findOrFail($id);

        //render view with post
        return view('auth.gantipassword', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'current_password' => 'required',
            'new_password' => 'required|min:8|different:current_password',
            'confirm_password' => 'required|same:new_password',
            'role'    => 'required'
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['The current password is incorrect.'],
            ]);
        }

        $user->update([
            'name' => $request->name,
            'password' => Hash::make($request->new_password),
            'role' => $request->role,
            
        ]);

        return redirect()->route('users.index')->with('success', 'Password has been changed successfully.');
    }

    public function updatepassword(Request $request, $id)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|different:current_password',
            'confirm_password' => 'required|same:new_password'
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['The current password is incorrect.'],
            ]);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
            
        ]);

        return redirect()->route('dashboard')->with('success', 'Password has been changed successfully.');
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('query');
        // Jika query kosong, kembalikan semua data users
        if (empty($searchQuery)) {
            $users = User::paginate(10);
        } else {
            $users = User::where('id', 'LIKE', "%$searchQuery%")
                ->orWhere('name', 'LIKE', "%$searchQuery%")
                ->orWhere('email', 'LIKE', "%$searchQuery%")
                ->paginate(10);
        }
        
        return view('auth.search', compact('users'));
    }

    public function getUsers(Request $request)
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

    public function showselect()
    {
        return view('auth.select2');
    }

}
