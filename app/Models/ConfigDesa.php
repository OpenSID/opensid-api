<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfigDesa extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'config';

    /**
     * Getter untuk menambahkan url logo.
     *
     * @return string
     */
    public function getUrlLogoAttribute()
    {
        return config('opensid.host') . LOKASI_LOGO_DESA . $this->logo;
    }
}
