<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Traits\LoginRequest as TraitLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function response;

class AuthenticatedController extends Controller
{
    use TraitLoginRequest;

    /**
     * {@inheritdoc}
     */
    protected function authenticated(string $token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'expires_in'   => Auth::factory()->getTTL() * 60,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function loggedOut(Request $request)
    {
        return response('Successfully logged out', 200);
    }
}
