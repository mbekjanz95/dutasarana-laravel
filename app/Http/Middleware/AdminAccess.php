<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AdminAccess
{
    public function handle($request, Closure $next)
    {
        $user = auth()->user();
    
        $allowedAdmins = [
            ['email' => 'pusat@dutasarana.com', 'password' => 'password'],
            ['email' => 'malang@dutasarana.com', 'password' => 'password'],
            ['email' => 'kediri@dutasarana.com', 'password' => 'password'],
            ['email' => 'solo@dutasarana.com', 'password' => 'password'],
            ['email' => 'denpasar@dutasarana.com', 'password' => 'password'],
            ['email' => 'jogja@dutasarana.com', 'password' => 'password']
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
