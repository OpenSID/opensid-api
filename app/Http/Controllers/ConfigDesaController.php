<?php

namespace App\Http\Controllers;

use App\Http\Transformers\ConfigDesaTransformer;
use App\Models\ConfigDesa;
use Illuminate\Support\Facades\Cache;

class ConfigDesaController extends Controller
{
    public function index()
    {
        return Cache::remember('cache_desa', 86400, function () {
            return $this->fractal(ConfigDesa::first(), new ConfigDesaTransformer(), 'desa');
        });
    }
}
