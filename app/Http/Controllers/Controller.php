<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use League\Fractal\Serializer\JsonApiSerializer;
use League\Fractal\TransformerAbstract;
use Spatie\Fractal\Fractal;

use function fractal;
use function response;

class Controller extends BaseController
{
    /**
     * Fractal short syntax.
     *
     * @param mixed $resource
     * @return Fractal
     */
    public function fractal($resource, TransformerAbstract $transformer, string $key = 'data')
    {
        return fractal($resource, $transformer, new JsonApiSerializer())
            ->withResourceName($key)
            ->respond();
    }

    public function fail($data, int $status)
    {
        return response()->json(['code' => $status, 'messages' => $data], $status);
    }

    public function response($data, int $status)
    {
        return $this->fail($data, $status);
    }
}
