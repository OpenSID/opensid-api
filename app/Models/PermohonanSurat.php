<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PermohonanSurat extends Model
{
    const STATUS_PERMOHONAN = [
        0 => "Sedang diperiksa",
        1 => "Belum lengkap",
        2 => "Menunggu tandatangan",
        3 => "Siap diambil/diantar",
        4 => "Sudah diambil",
        9 => "Dibatalkan",
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'permohonan_surat';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'isian_form' => 'json',
        'syarat' => 'json',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['formatSurat', 'penduduk'];

    /**
     * Getter untuk mapping status permohonan.
     *
     * @return string
     */
    public function getStatusPermohonanAttribute()
    {
        return static::STATUS_PERMOHONAN[$this->status];
    }

    /**
     * Scope query untuk pengguna.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopePengguna($query)
    {
        return $query->where('id_pemohon', Auth::user()->penduduk->id);
    }

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'id_pemohon');
    }

    public function formatSurat()
    {
        return $this->belongsTo(FormatSurat::class, 'id_surat');
    }
}
