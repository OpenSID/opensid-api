<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

use function response;

class Controller extends BaseController
{
    public function fail($data, int $status)
    {
        return response()->json(['code' => $status, 'messages' => $data], $status);
    }

    public function response($data, int $status)
    {
        return $this->fail($data, $status);
    }
}
