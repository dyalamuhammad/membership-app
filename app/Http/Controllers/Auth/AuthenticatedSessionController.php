<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log; // <-- Tambahkan ini
use Laravel\Socialite\Facades\Socialite;
use App\Models\User; // Import model User
use Illuminate\Support\Facades\Hash; // Import Hash untuk membuat password dummy


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

        // ... method authenticate dan destroy ...

    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(): RedirectResponse
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            // Log error jika gagal
            Log::error('Google Socialite Error: ' . $e->getMessage());
            return redirect('/login')->withErrors(['email' => 'Login dengan Google gagal.']);
        }

        // Temukan atau buat user berdasarkan provider dan provider_id
        $authUser = User::where('provider', 'google')
                         ->where('provider_id', $user->getId())
                         ->first();

        if ($authUser) {
            // Jika user sudah ada, login
            Auth::login($authUser, true);
        } else {
            // Jika user belum ada, buat baru
            $newUser = new User();
            $newUser->name = $user->getName();
            $newUser->email = $user->getEmail(); // Gunakan email dari Google
            $newUser->provider = 'google';
            $newUser->provider_id = $user->getId();
            // Kita bisa set password acak karena login via social
            $newUser->password = Hash::make('password_dari_google_facebook'); // Gunakan Hash
            $newUser->save();

            Auth::login($newUser, true);
        }

        // Arahkan ke dashboard setelah login
        return redirect()->intended(route('dashboard', absolute: false));
        // Ubah '/member' menjadi route('dashboard') atau route yang sesuai
        // Kita gunakan route('dashboard') dulu karena sudah ada dari Breeze
    }

    public function redirectToFacebook(): RedirectResponse
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback(): RedirectResponse
    {
         try {
            $user = Socialite::driver('facebook')->user();
        } catch (\Exception $e) {
            // Log error jika gagal
            Log::error('Facebook Socialite Error: ' . $e->getMessage());
            return redirect('/login')->withErrors(['email' => 'Login dengan Facebook gagal.']);
        }

        // Temukan atau buat user berdasarkan provider dan provider_id
        $authUser = User::where('provider', 'facebook')
                         ->where('provider_id', $user->getId())
                         ->first();

        if ($authUser) {
            // Jika user sudah ada, login
            Auth::login($authUser, true);
        } else {
            // Jika user belum ada, buat baru
            $newUser = new User();
            $newUser->name = $user->getName();
            $newUser->email = $user->getEmail(); // Gunakan email dari Facebook
            $newUser->provider = 'facebook';
            $newUser->provider_id = $user->getId();
            $newUser->password = Hash::make('password_dari_google_facebook'); // Gunakan Hash
            $newUser->save();

            Auth::login($newUser, true);
        }

        // Arahkan ke dashboard setelah login
        return redirect()->intended(route('dashboard', absolute: false));
    }

}
