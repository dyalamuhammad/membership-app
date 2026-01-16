<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function index()
    {
        $memberships = Membership::all(); // Ambil semua membership
        return view('admin.memberships.index', compact('memberships'));
    }
    public function create()
    {
        return view('admin.memberships.create');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:memberships,name',
            'article_limit' => 'nullable|integer|min:0',
            'video_limit' => 'nullable|integer|min:0',
        ]);

        Membership::create($validatedData);

        return redirect()->route('admin.memberships.index')->with('success', 'Tipe membership berhasil ditambahkan.');
    }
    public function edit(Membership $membership) // Model Binding
    {
        return view('admin.memberships.edit', compact('membership'));
    }
    public function update(Request $request, Membership $membership) // Model Binding
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:memberships,name,'.$membership->id,
            'article_limit' => 'nullable|integer|min:0',
            'video_limit' => 'nullable|integer|min:0',
        ]);

        $membership->update($validatedData);

        return redirect()->route('admin.memberships.index')->with('success', 'Tipe membership berhasil diperbarui.');
    }
    public function destroy(Membership $membership) // Model Binding
    {
        $membership->delete();

        return redirect()->route('admin.memberships.index')->with('success', 'Tipe membership berhasil dihapus.');
    }
}