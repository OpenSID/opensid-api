<?php

namespace App\Http\Transformers;

use App\Models\PendudukMandiri;
use Illuminate\Support\Facades\Auth;
use League\Fractal\TransformerAbstract;

class PendudukTransformer extends TransformerAbstract
{
    /**
     * {@inheritdoc}
     */
    public function transform(PendudukMandiri $mandiri)
    {
        return [
            'id'            => $mandiri->id_pend,
            'access_token'  => [
                'token'      => $mandiri->token ?? null,
                'token_type' => 'Bearer' ?? null,
                'expires_in' => Auth::factory()->getTTL() * 60 ?? null,
            ],
            'foto'          => $mandiri->penduduk->foto,
            'nama'          => $mandiri->penduduk->nama,
            'nik'           => $mandiri->penduduk->nik,
            'sex'           => $mandiri->penduduk->sex,
            'tempat_lahir'  => $mandiri->penduduk->tempatlahir,
            'tanggal_lahir' => $mandiri->penduduk->tanggallahir,
            'agama'         => $mandiri->penduduk->agama,
            'pendidikan'    => $mandiri->penduduk->pendidikan_sedang_id,
            'pekerjaan'     => $mandiri->penduduk->pekerjaan_id,
        ];
    }
}
