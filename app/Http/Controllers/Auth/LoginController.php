<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        if ($this->userRepository->attemptLogin($credentials)) {
            return redirect()->route('dashboard');
        } else {
            // get email based users table for credentials check
            $user = $this->userRepository->findByEmail($credentials['email']);

            if ($user) {
                return back()->withErrors(['password' => 'Credentials does not match']);
            } else {
                return back()->withErrors(['email' => 'Account not found']);
            }
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate all session user logged in before.
        $request->session()->invalidate();

        // Generate a new session token
        $request->session()->regenerateToken();

        return redirect()->route('auth.login');
    }
}
