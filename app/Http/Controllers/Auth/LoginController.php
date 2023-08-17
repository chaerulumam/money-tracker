<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Repositories\UserRepositoryInterface;

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

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('auth.login');
    }

    public function google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleCallbackSocialite()
    {
        $callback = Socialite::driver('google')->stateless()->user();

        $data = [
            'name' => $callback->getName(),
            'email' => $callback->getEmail()
        ];

        $user = $this->userRepository->findByEmail($data['email']);

        if (!$user) {
            $user = $this->userRepository->create($data);
        }

        Auth::login($user, true);

        return redirect()->route('dashboard');
    }
}
