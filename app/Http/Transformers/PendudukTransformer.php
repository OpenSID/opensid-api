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
        return array_merge(
            $mandiri->token ? [
                'id' => $mandiri->id_pend,
                'access_token' => [
                    'token' => $mandiri->token,
                    'token_type' => 'Bearer',
                    'expires_in' => Auth::factory()->getTTL() * 60,
                ],
            ] : [],
            [
                'id' => $mandiri->id_pend,
                'foto' => url_foto($mandiri->penduduk->foto, '', $mandiri->penduduk->jenisKelamin->id),
                'nama' => $mandiri->penduduk->nama,
                'nik' => $mandiri->penduduk->nik,
                'tempat_lahir' => $mandiri->penduduk->tempatlahir,
                'tanggal_lahir' => $mandiri->penduduk->tanggallahir,
                'sex' => $mandiri->penduduk->jenisKelamin,
                'agama' => $mandiri->penduduk->agama,
                'pendidikan' => $mandiri->penduduk->pendidikan,
                'pekerjaan' => $mandiri->penduduk->pekerjaan,
            ]
        );
    }
}
