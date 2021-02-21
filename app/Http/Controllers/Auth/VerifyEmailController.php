<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use function event;
use function hash_equals;
use function sha1;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @return RedirectResponse
     */
    public function __invoke(Request $request, string $id, string $hash)
    {
        if (! hash_equals($id, (string) $request->user()->getKey())) {
            return $this->fail('failed to verified your email', 401);
        }

        if (! hash_equals($hash, sha1($request->user()->getEmailForVerification()))) {
            return $this->fail('failed to verified your email', 401);
        }

        if ($request->user()->hasVerifiedEmail()) {
            return $this->response('your email has been verified', 200);
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return $this->response('your email has been verified', 200);
    }
}
