<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

/**
 * Login, registration and the portal dashboard.
 * Three portals share one users table; users.portal says which one an account belongs to.
 * Employee accounts are created by an administrator (see PortalUserSeeder), never by self-registration.
 */
class PortalAuthController extends Controller
{
    public const PORTALS = ['customer', 'supplier', 'employee'];

    public function showLogin(?string $portal = null): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('portal');
        }

        return view('pages.login', ['portal' => in_array($portal, self::PORTALS, true) ? $portal : 'customer']);
    }

    public function login(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
            'portal'   => ['required', 'in:' . implode(',', self::PORTALS)],
        ]);

        if (! Auth::attempt(['email' => $data['email'], 'password' => $data['password']], $request->boolean('remember'))) {
            return back()->withErrors(['email' => __('Invalid email or password.')])->onlyInput('email', 'portal');
        }

        // The account must belong to the portal it signed in through
        if ((Auth::user()->portal ?? 'customer') !== $data['portal']) {
            $this->endSession($request);

            return back()
                ->withErrors(['email' => __('This account does not belong to the :portal.', ['portal' => __(ucfirst($data['portal']) . ' portal')])])
                ->onlyInput('email', 'portal');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('portal'));
    }

    public function showRegister(): View|RedirectResponse
    {
        return Auth::check() ? redirect()->route('portal') : view('pages.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'     => ['required', 'string', 'max:120'],
            'email'    => ['required', 'email', 'max:160', 'unique:users,email'],
            'company'  => ['nullable', 'string', 'max:160'],
            'portal'   => ['required', 'in:customer,supplier'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = User::unguarded(fn () => User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'portal'   => $data['portal'],
            'company'  => $data['company'] ?? null,
        ]));

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('portal');
    }

    public function dashboard(): View
    {
        $user = Auth::user();

        return view('pages.portal', ['user' => $user, 'portal' => $user->portal ?? 'customer']);
    }

    public function logout(Request $request): RedirectResponse
    {
        $this->endSession($request);

        return redirect()->route('home');
    }

    /** Log out and reset the session, but keep the visitor's chosen language. */
    private function endSession(Request $request): void
    {
        $locale = $request->session()->get('locale');

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($locale) {
            $request->session()->put('locale', $locale);
        }
    }
}
