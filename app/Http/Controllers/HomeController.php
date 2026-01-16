<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import facade Auth

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Dapatkan user yang sedang login
        $membership = $user->membership; // Dapatkan membership user tsb

        // Ambil jumlah artikel/video yang bisa diakses berdasarkan membership
        $maxArticles = $membership ? $membership->article_limit : 0;
        $maxVideos = $membership ? $membership->video_limit : 0;

        // Ambil artikel dan video berdasarkan batas membership (nanti akan diimplementasikan)
        // Untuk sekarang, kita tampilkan view saja
        return view('member.home', compact('user', 'membership', 'maxArticles', 'maxVideos'));
    }
}