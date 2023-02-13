<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EtudiantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('API-TOKEN');
        if(!$token){
            return response()->json(['message' => 'Missing token', 403]);
        }

        $user = User::where('api_token', $token)->first();
        if(!$user){
            return response()->json(['message' => 'Invalid', 403]);
        }
        return $next($request);
    }
}
