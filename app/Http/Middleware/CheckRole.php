<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string  $roleOrPermission
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $roleOrPermission)
    {
        if (session()->has('user')) {
            $userRole = session()->get('user')['role'];
            if ($userRole > 0) {
                $rolesOrPermissions = [];
                if ($roleOrPermission) {
                    $rolesOrPermissions = is_array($roleOrPermission) ? $roleOrPermission : explode('|', $roleOrPermission);
                }
                array_push($rolesOrPermissions, 0);
                if (!in_array($userRole, $rolesOrPermissions)) {
                    return redirect()->route('home');
                }
            }
        }
        return $next($request);
    }
}
