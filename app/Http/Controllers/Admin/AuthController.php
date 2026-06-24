<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        return view('admin.auth.login');
    }

    public function login(AdminLoginRequest $request): RedirectResponse
    {
        $admin = Admin::where('email', $request->string('email'))->first();

        if (! $admin || ! Hash::check($request->string('password'), $admin->password)) {
            return back()->withInput($request->only('email'))
                ->withErrors(['email' => 'Email atau password admin tidak sesuai.']);
        }

        $request->session()->regenerate();
        $request->session()->put([
            'admin_id' => $admin->id,
            'admin_name' => $admin->name,
        ]);

        return redirect()->intended(route('admin.dashboard'))
            ->with('success', 'Selamat datang, '.$admin->name.'.');
    }

    public function logout(): RedirectResponse
    {
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Anda berhasil logout.');
    }
}
