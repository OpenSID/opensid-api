<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Penduduk extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tweb_penduduk';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Define a one-to-one relationship.
     *
     * @return HasOne
     */
    public function mandiri()
    {
        return $this->hasOne(PendudukMandiri::class, 'id_pend');
    }
}
