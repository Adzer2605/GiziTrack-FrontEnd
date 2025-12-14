<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Account;

class ApiTokenAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        // Ambil token dari Bearer atau cookie
        $token = $request->bearerToken() ?? $request->cookie('api_token');

        // Tidak ada token
        if (!$token) {
            return response()->json([
                'message' => 'Unauthorized',
                'code' => 401
            ], 401);
        }

        // Cek token ke database
        $user = Account::where('api_token', $token)->first();

        // Token tidak valid
        if (!$user) {
            return response()->json([
                'message' => 'Unauthorized',
                'code' => 401
            ], 401);
        }

        // Inject user (opsional)
        $request->attributes->set('auth_user', $user);

        return $next($request);
    }
}
