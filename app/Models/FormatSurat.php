<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class FormatSurat extends Model
{
    const MANDIRI = 1;
    const MANDIRI_DISABLE = 0;
    const KUNCI = 1;
    const KUNCI_DISABLE = 0;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tweb_surat_format';

    /**
     * Scope query untuk layanan mandiri.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeMandiri($query)
    {
        return $query->where('mandiri', static::MANDIRI);
    }

    /**
     * Scope query untuk list surat yang tidak dikunci.
     * 
     * @param Builder $query
     * @return Builder
     */
    public function scopeKunci($query)
    {
        return $query->where('kunci', static::KUNCI_DISABLE);
    }
}
