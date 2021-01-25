<?php

namespace App\Http\Controllers;

use App\Http\Repository\ArsipSuratEntity;
use App\Http\Repository\PermohonanSuratEntity;
use App\Http\Transformers\ArsipSuratTransformer;
use App\Http\Transformers\PermohonanSuratTransformer;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function arsip(ArsipSuratEntity $arsip)
    {
        return $this->fractal($arsip->get(), new ArsipSuratTransformer(), 'arsip');
    }

    public function permohonan(PermohonanSuratEntity $permohonan)
    {
        return $this->fractal($permohonan->get(), new PermohonanSuratTransformer(), 'permohonan');
    }

    public function store(Request $request)
    {
    }
}
