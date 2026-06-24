<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        $adminId = $request->session()->get('admin_id');
        $admin = $adminId ? Admin::find($adminId) : null;

        if (! $admin) {
            $request->session()->forget(['admin_id', 'admin_name']);

            return redirect()->route('admin.login')
                ->with('error', 'Silakan login untuk mengakses halaman administrator.');
        }

        $request->attributes->set('admin', $admin);
        view()->share('currentAdmin', $admin);

        return $next($request);
    }
}
