<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Membership;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('membership')->get(); // Ambil user beserta data membership-nya
        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user) // Model Binding
    {
        $memberships = Membership::all(); // Ambil semua tipe membership
        return view('admin.users.edit', compact('user', 'memberships'));
    }

    public function update(Request $request, User $user) // Model Binding
    {
        $validatedData = $request->validate([
            'membership_id' => 'nullable|exists:memberships,id', // Validasi ID membership harus ada di tabel memberships
        ]);

        $user->update($validatedData);

        return redirect()->route('admin.users.index')->with('success', 'Membership user berhasil diperbarui.');
    }
}