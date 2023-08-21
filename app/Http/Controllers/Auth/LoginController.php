<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = $this->userRepository->findByEmail($credentials['email']);

        if (!$user) {
            return back()->withErrors(['email' => "Acount not found!"]);
        }

        if (!Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors(['password' => "Credentials not match!"]);
        }

        // This function creating an authenticated session, allowing them to access protected areas of the application.
        auth()->login($user);

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate the existing session data, and rendering the session invalid
        $request->session()->invalidate();

        // Generate a new session token to prevent CSRF
        $request->session()->regenerateToken();

        return redirect()->route('auth.login');
    }
}
