<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class FinanceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect('login'); // Redirect to login if not authenticated
        }

        // Check if the user has the 'finance' role
        if (auth()->user()->isFinanceMember()) {

            return $next($request); // Proceed if the user is a finance member
        }
        // dd("test");
        // Redirect to a home page or an error page if the user is not a finance member
        return redirect('/dashboard');
    }
}
