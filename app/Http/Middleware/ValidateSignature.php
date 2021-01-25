<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ValidateSignature
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  string|null  $relative
     * @return Response
     * @throws HttpException
     */
    public function handle($request, Closure $next, $relative = null)
    {
        if ($request->hasValidSignature($relative !== 'relative')) {
            return $next($request);
        }

        throw new HttpException(403, 'Invalid signature');
    }
}
