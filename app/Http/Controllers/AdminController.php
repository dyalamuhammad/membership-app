<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import facade Auth

class AdminController extends Controller
{
    public function index()
    {
        // Untuk sekarang, tampilkan view dashboard admin
        // Nanti bisa dicek role user apakah admin
        return view('admin.dashboard');
    }
}