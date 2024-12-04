<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $authUserRole = Auth::user()->role;

        $roleNames = [
            1 => 'Customer Service',
            2 => 'Admin',
            3 => 'Supervisor',
        ];

        // dd($authUserRole);
        $authUserRole = Auth::user()->role;

        session(['role_name' => $roleNames[$authUserRole] ?? 'Unknown Role']);

        $roleMap = [
            'customer_service' => 1,
            'admin' => 2,
            'supervisor' => 3,
        ];
    
        // Konversi roles yang diizinkan menjadi array angka
        $allowedRoles = array_map(function($role) use ($roleMap) {
            return $roleMap[$role];
        }, $roles);
    
        // Cek apakah role user termasuk dalam roles yang diizinkan
        if (in_array($authUserRole, $allowedRoles)) {
            return $next($request);
        }
    
        return abort(403, 'Unauthorized action.');
    }
}
