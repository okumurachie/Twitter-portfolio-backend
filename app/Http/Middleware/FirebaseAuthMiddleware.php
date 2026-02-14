<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Kreait\Firebase\Auth as FirebaseAuth;
use Symfony\Component\HttpFoundation\Response;

class FirebaseAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    protected FirebaseAuth $auth;

    public function __construct(FirebaseAuth $auth)
    {
        $this->auth = $auth;
    }

    public function handle(Request $request, Closure $next): Response
    {
        $idToken = $request->bearerToken();

        if (!$idToken) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        try {
            $verifiedIdToken = $this->auth->verifyIdToken($idToken);
            $uid = $verifiedIdToken->claims()->get('sub');

            $request->merge(['firebase_uid' => $uid]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Invalid Token'], 401);
        }

        return $next($request);
    }
}
