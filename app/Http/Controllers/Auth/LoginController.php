<?php declare(strict_types=1); 

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $login = $request->input('login');
        $password = $request->input('password');

        // Determine if login is email or phone
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        // Attempt to authenticate
        if (Auth::attempt([$field => $login, 'password' => $password], $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Log the login activity
            /** @var User $user */
            $user = Auth::user();
            if ($user) {
                activity()
                    ->performedOn($user)
                    ->log('User logged in');
            }

            // Redirect to appropriate dashboard based on user role
            return redirect()->intended($this->getDashboardRoute());
        }

        // If authentication fails, throw validation exception
        throw ValidationException::withMessages([
            'login' => [trans('auth.failed')],
        ]);
    }

    /**
     * Get the appropriate dashboard route based on user role.
     */
    private function getDashboardRoute(): string
    {
        /** @var User $user */
        $user = Auth::user();
        
        if ($user->hasRole(['admin', 'super-admin'])) {
            return route('admin.dashboard');
        } elseif ($user->hasRole('assistant')) {
            return route('assistant.dashboard');
        } else {
            // Regular users go to home page
            return route('home');
        }
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        // Log the logout activity
        /** @var User $user */
        $user = Auth::user();
        if ($user) {
            activity()
                ->performedOn($user)
                ->log('User logged out');
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
