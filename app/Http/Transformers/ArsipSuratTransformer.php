<?php

namespace App\Http\Transformers;

use App\Models\LogSurat;
use League\Fractal\TransformerAbstract;

class ArsipSuratTransformer extends TransformerAbstract
{
    /**
     * {@inheritdoc}
     */
    public function transform(LogSurat $surat)
    {
        return [
            'id' => $surat->id,
            'nomor_surat' => $surat->no_surat,
            'jenis_surat' => $surat->formatSurat->nama,
            'nama_pamong' => $surat->pamong->pamong_nama,
            'tanggal' => $surat->tanggal,
        ];
    }
}
