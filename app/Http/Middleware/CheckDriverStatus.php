<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckDriverStatus
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        
        if ($user) {
            if ($user->status === 'pending') {
                return redirect()->route('driver.login')->with('error', 'Please wait for admin approval. For 1 to 2 days');
            }
            
            if ($user->status === 'rejected') {
                return redirect()->route('driver.login')->with('error', 'Your account has been rejected. Please contact support.');
            }
        }
        
        return $next($request);
    }
}
