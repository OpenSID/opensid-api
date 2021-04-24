<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SyaratSurat extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'ref_syarat_id';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ref_syarat_surat';
}
