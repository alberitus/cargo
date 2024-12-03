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
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $authUserRole = Auth::user()->role;

        $roleNames = [
            1 => 'Customer Service',
            2 => 'Admin',
        ];


        session(['role_name' => $roleNames[$authUserRole] ?? 'Unknown Role']);

        switch ($role) {
            case 'Admin':
                if ($authUserRole == 2) {
                    return $next($request);
                }
                break;
            case 'Customer Service':
                if ($authUserRole == 1) {
                    return $next($request);
                }
                break;
        }

        return redirect()->route('login');
    }
}
