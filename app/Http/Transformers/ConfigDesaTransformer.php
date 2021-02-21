<?php

namespace App\Http\Transformers;

use App\Models\ConfigDesa;
use League\Fractal\TransformerAbstract;

class ConfigDesaTransformer extends TransformerAbstract
{
    /**
     * {@inheritdoc}
     */
    public function transform(ConfigDesa $config)
    {
        return [
            'id'             => $config->id,
            'logo'           => $config->logo,
            'email_desa'     => $config->email_desa,
            'telepon'        => $config->telepon,
            'website'        => $config->website,
            'perangkat_desa' => [
                'nama_kepala_desa'  => $config->nama_kepala_desa,
                'nip_kepala_desa'   => $config->nip_kepala_desa,
                'nama_kepala_camat' => $config->nama_kepala_camat,
                'nip_kepala_camat'  => $config->nip_kepala_camat,
            ],
            'alamat'         => [
                'kode_pos'       => $config->kode_pos,
                'alamat_kantor'  => $config->alamat_kantor,
                'kantor_desa'    => $config->kantor_desa,
                'kode_desa'      => $config->kode_desa,
                'kode_kecamatan' => $config->kode_kecamatan,
                'kode_kabupaten' => $config->kode_kabupaten,
                'kode_provinsi'  => $config->kode_propinsi,
                'nama_desa'      => $config->nama_desa,
                'nama_kecamatan' => $config->kecamatan,
                'nama_kabupaten' => $config->nama_kabupaten,
                'nama_profinsi'  => $config->nama_profinsi,
                'lat'            => $config->lat,
                'lng'            => $config->lng,
            ],
        ];
    }
}
