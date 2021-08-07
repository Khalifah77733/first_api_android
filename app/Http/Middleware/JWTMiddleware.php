<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTMiddleware // we need register this in kernel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $message = '';

        try {
            // check token validations
            JWTAuth::parseToken()->authenticate();
            return $next($request);
        }catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e){
            // write what you want to do if a token is expired
            $message = 'token expired';
        }catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
            // write what you want to do if a token is invalid
            $message = 'token invalid';
        }catch (\Tymon\JWTAuth\Exceptions\JWTException $e){
            // write what you want to do if a token is not present
            $message = 'provide token';
        }

        return response()->json([
            'success' => false,
            'message' => $message
        ]);

    }// end of handle
}// end of JWTMiddleware
