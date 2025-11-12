<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // <-- Panggil model User
use Illuminate\Support\Facades\Hash; // <-- Untuk enkripsi password
use Illuminate\Support\Facades\Auth; // <-- Untuk cek user yg lagi login

class UserController extends Controller
{
    /**
     * Tampilkan semua user
     */
    public function index()
    {
        $users = User::latest()->get();
        return view('users.index', compact('users'));
    }

    /**
     * Tampilkan form tambah user
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Simpan user baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users', 
            'password' => 'required|string|min:6|confirmed', 
        ]);

        User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('users.index')->with('success', 'User Admin baru berhasil ditambah!');
    }
    public function show(string $id)
    {
        //
    }
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        // Nanti kamu perlu bikin view-nya di:
        // resources/views/users/edit.blade.php
        return view('users.edit', compact('user'));
    }

    /**
     * Update data user
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            // 'unique' harus di-handle beda saat update
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed', // 'nullable' = boleh kosong
        ]);

        // Kita HANYA update password JIKA user mengisinya.
        // Kalau field password dikosongin, password lama tetap dipakai.

        $dataToUpdate = [
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
        ];

        if ($request->filled('password')) { // Cek apakah field password 
            $dataToUpdate['password'] = Hash::make($validated['password']); // Kalo diisi, hash yg baru
        }
        // Kalo gak diisi (kosong), kita gak ngapa-ngapain, password lama aman.

        $user->update($dataToUpdate);

        return redirect()->route('users.index')->with('success', 'Data user berhasil di-update!');
    }

    /**
     * Hapus user
     */
    public function destroy(string $id)
    {
        // PENTING: Jangan sampai bisa hapus diri sendiri!
        if (Auth::id() == $id) {
            return redirect()->route('users.index')->with('error', 'Bro, jangan hapus akunmu sendiri!');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}