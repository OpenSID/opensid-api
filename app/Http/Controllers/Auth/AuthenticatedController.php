<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Traits\LoginRequestTrait;
use App\Http\Transformers\PendudukTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedController extends Controller
{
    use LoginRequestTrait;

    /**
     * {@inheritdoc}
     */
    protected function authenticated(string $token)
    {
        $user        = Auth::user();
        $user->token = $token;

        return $this->fractal($user, new PendudukTransformer(), 'penduduk');
    }

    /**
     * {@inheritdoc}
     */
    protected function loggedOut(Request $request)
    {
        return $this->response('Successfully logged out', 200);
    }
}
