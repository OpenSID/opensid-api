<?php

namespace App\Supports;

use DateInterval;
use DateTimeInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\InteractsWithTime;
use Illuminate\Support\Traits\Macroable;
use InvalidArgumentException;
use Laravel\Lumen\Application;
use Laravel\Lumen\Routing\UrlGenerator as RoutingUrlGenerator;

class UrlGenerator extends RoutingUrlGenerator
{
    use InteractsWithTime;
    use Macroable;

    /**
     * Custom UrlGenerator.
     */
    public function __construct(Application $app)
    {
        parent::__construct($app);
    }

    /**
     * Create a temporary signed route URL for a named route.
     *
     * @param  string  $name
     * @param DateTimeInterface|DateInterval|int $expiration
     * @param  array  $parameters
     * @param  bool  $absolute
     * @return string
     */
    public function temporarySignedRoute($name, $expiration, $parameters = [], $absolute = false)
    {
        return $this->signedRoute($name, $parameters, $expiration, $absolute);
    }

    /**
     * Create a signed route URL for a named route.
     *
     * @param  string  $name
     * @param  mixed  $parameters
     * @param DateTimeInterface|DateInterval|int|null $expiration
     * @param  bool  $absolute
     * @return string
     * @throws InvalidArgumentException
     */
    public function signedRoute($name, $parameters = [], $expiration = null, $absolute = true)
    {
        $parameters = Arr::wrap($parameters);

        if (array_key_exists('signature', $parameters)) {
            throw new InvalidArgumentException(
                '"Signature" is a reserved parameter when generating signed routes. Please rename your route parameter.'
            );
        }

        if ($expiration) {
            $parameters += ['expires' => $this->availableAt($expiration)];
        }

        ksort($parameters);

        $key = config('app.key');

        return $this->route($name, $parameters + [
            'signature' => hash_hmac('sha256', $this->route($name, $parameters, $absolute), $key),
        ], $absolute);
    }

    /**
     * Get the "available at" UNIX timestamp.
     *
     * @param DateTimeInterface|DateInterval|int $delay
     * @return int
     */
    protected function availableAt($delay = 0)
    {
        $delay = $this->parseDateInterval($delay);

        return $delay instanceof DateTimeInterface
            ? $delay->getTimestamp()
            : Carbon::now()->addRealSeconds($delay)->getTimestamp();
    }

    /**
     * If the given value is an interval, convert it to a DateTime instance.
     *
     * @param DateTimeInterface|DateInterval|int $delay
     * @return DateTimeInterface|int
     */
    protected function parseDateInterval($delay)
    {
        if ($delay instanceof DateInterval) {
            $delay = Carbon::now()->add($delay);
        }

        return $delay;
    }

    /**
     * Determine if the given request has a valid signature.
     *
     * @param  bool  $absolute
     * @return bool
     */
    public function hasValidSignature(Request $request, $absolute = true)
    {
        return $this->hasCorrectSignature($request, $absolute)
            && $this->signatureHasNotExpired($request);
    }

    /**
     * Determine if the given request has a valid signature for a relative URL.
     *
     * @return bool
     */
    public function hasValidRelativeSignature(Request $request)
    {
        return $this->hasValidSignature($request, false);
    }

    /**
     * Determine if the signature from the given request matches the URL.
     *
     * @param  bool  $absolute
     * @return bool
     */
    public function hasCorrectSignature(Request $request, $absolute = true)
    {
        $url = $absolute ? $request->url() : '/' . $request->path();

        $original = rtrim($url . '?' . Arr::query(
            Arr::except($request->query(), 'signature')
        ), '?');

        $signature = hash_hmac('sha256', $original, config('app.key'));

        return hash_equals($signature, (string) $request->query('signature', ''));
    }

    /**
     * Determine if the expires timestamp from the given request is not from the past.
     *
     * @return bool
     */
    public function signatureHasNotExpired(Request $request)
    {
        $expires = $request->query('expires');

        return ! ($expires && Carbon::now()->getTimestamp() > $expires);
    }
}
