<?php

namespace App\Http\Controllers;

use App\Http\Repository\ArsipSuratEntity;
use App\Http\Repository\DokumenEntity;
use App\Http\Repository\FormatSuratEntity;
use App\Http\Repository\PermohonanSuratEntity;
use App\Http\Repository\SyaratSuratEntity;
use App\Http\Transformers\ArsipSuratTransformer;
use App\Http\Transformers\DokumenTransformer;
use App\Http\Transformers\JenisFormatSuratTransformer;
use App\Http\Transformers\PermohonanSuratTransformer;
use App\Http\Transformers\SyaratSuratTransformer;
use Exception;
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

    public function jenis(FormatSuratEntity $formatSurat)
    {
        return $this->fractal($formatSurat->jenis(), new JenisFormatSuratTransformer(), 'jenis-surat');
    }

    public function syaratSurat(SyaratSuratEntity $syaratSurat)
    {
        return $this->fractal($syaratSurat->get(), new SyaratSuratTransformer(), 'syarat');
    }

    public function unggahDokumen(Request $request, DokumenEntity $dokumen)
    {
        $this->validate($request, [
            'nama_dokumen' => 'required',
            'syarat' => 'required|integer|exists:ref_syarat_surat,ref_syarat_id',
            'file' => 'required|mimetypes:application/pdf'
        ]);

        $result = $dokumen->insert($request);

        if ($result instanceof Exception) {
            return $this->fail($result->getMessage(), 422);
        }

        return $this->fractal($result, new DokumenTransformer(), 'dokumen');
    }
}
