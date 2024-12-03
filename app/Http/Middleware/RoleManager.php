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
        // return $next($request);

        if(!Auth::check())
        {
            return redirect()->route('login');
        }

        $authUserRole = Auth::user()->role;

        $roleNames = [
            1 => 'Customer Service',
            2 => 'Admin',
            // Add other roles as necessary
        ];

        // Store role name in session
        session(['role_name' => $roleNames[$authUserRole] ?? 'Unknown Role']);
        
        switch($role)
        {
            case 'admin':
                if($authUserRole == 2)
                {
                    return $next($request);
                }
            break;

            case 'customer_service':
                if($authUserRole == 1)
                {
                    return $next($request);
                }
            break;
        }
        return redirect()->route('login');
    }
}
