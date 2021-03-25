<?php

namespace App\Http\Traits;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Http\Request;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

trait LoginRequestTrait
{
    /**
     * Attempt to authenticate the request's credentials.
     *
     * @return void
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        if (RateLimiter::tooManyAttempts($this->throttleKey(), static::MAX_ATTEMPT)) {
            event(new Lockout($request));

            $seconds = RateLimiter::availableIn($this->throttleKey());

            return $this->fail([
                'credential' => trans('auth.throttle', [
                    'seconds' => $seconds,
                    'minutes' => ceil($seconds / 60),
                ]),
            ], 403);
        }

        $this->validate($request, [
            'credential' => 'required',
            'password' => 'required|integer',
        ]);

        $credentials = [
            filter_var($request->credential, FILTER_VALIDATE_EMAIL) ? 'email' : 'nik' => $request->credential,
            'password' => $request->password,
        ];

        if (! $token = Auth::attempt($credentials)) {
            RateLimiter::hit($this->throttleKey(), static::DECAY_SECOND);

            return $this->fail(['credential' => __('auth.failed')], 401);
        }

        return $this->sendLoginResponse($token);
    }

    /**
     * Log the user out of the application.
     *
     * @return Response
     */
    public function logout(Request $request)
    {
        Auth::logout();

        return $this->loggedOut($request) ?: redirect('/');
    }

    /**
     * The user has logged out of the application.
     *
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @return Response
     */
    protected function sendLoginResponse(string $token)
    {
        RateLimiter::clear($this->throttleKey());

        return $this->authenticated($token);
    }

    /**
     * The user has been authenticated.
     *
     * @param string token
     * @return mixed
     */
    protected function authenticated(string $token)
    {
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    protected function throttleKey()
    {
        return Str::lower(request('credential')) . '|' . request()->ip();
    }
}
