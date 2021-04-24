<?php

namespace App\Http\Transformers;

use App\Models\Dokumen;
use League\Fractal\TransformerAbstract;

class DokumenTransformer extends TransformerAbstract
{
    /**
     * {@inheritdoc}
     */
    public function transform(Dokumen $dokumen)
    {
        return [
            'id' => $dokumen->id,
            'nama' => $dokumen->nama,
            'jenis_dokumen' => $dokumen->jenisDokumen->ref_syarat_nama,
            'file' => $dokumen->urlFile,
        ];
    }
}
