<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
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

    public function google()
    {
        // redirect to google
        return Socialite::driver('google')->redirect();
    }

    public function handleCallbackSocialite()
    {
        // Retrieving User Data: Using Socialite to retrieve user information from Google.
        $callback = Socialite::driver('google')->user();

        $data = [
            'name' => $callback->getName(),
            'email' => $callback->getEmail()
        ];

        $user = $this->userRepository->findByEmail($data['email']);

        if (!$user) {
            $user = $this->userRepository->create($data);
        }

        // Authentication: Logging in the user after successful Socialite authentication.
        // The $user instance comes from verified Socialite authentication.
        // The second parameter 'true' indicates the user will be remembered by the system ("remember me").
        Auth::login($user, true);

        return redirect()->route('dashboard');
    }
}
