<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class ServiceAccess
{
    public function handle($request, Closure $next)
    {
        $user = auth()->user();
    
        $allowedAdmins = [
            ['email' => 'dwinda@dutasarana.com', 'password' => 'password'],
            ['email' => 'usman@dutasarana.com', 'password' => 'password'],
            ['email' => 'ryan@dutasarana.com', 'password' => 'password'],
            ['email' => 'dwi@dutasarana.com', 'password' => 'password'],
            ['email' => 'adminservis@dutasarana.com', 'password' => 'password']
        ];
    
        $isAllowed = false;
        foreach ($allowedAdmins as $admin) {
            if ($user->email == $admin['email'] && Hash::check('password', $user->password)) {
                $isAllowed = true;
                break;
            }
        }
    
        if (!$isAllowed) {
            return abort(403, 'Akses Ditolak');
        }
        
        return $next($request);
    }
}
