<?php

namespace App\Models;

use App\Http\Traits\Authenticatable;
use App\Http\Traits\CanResetPassword;
use App\Http\Traits\MustVerifyEmail;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class PendudukMandiri extends Model implements
    AuthenticatableContract,
    CanResetPasswordContract,
    MustVerifyEmailContract,
    JWTSubject
{
    use Authenticatable;
    use CanResetPassword;
    use MustVerifyEmail;
    use Notifiable;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_pend';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tweb_penduduk_mandiri';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The name of the "created at" column.
     *
     * @var string|null
     */
    const CREATED_AT = 'tanggal_buat';

    /**
     * The name of the "updated at" column.
     *
     * @var string|null
     */
    const UPDATED_AT = 'updated_at';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'pin',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login' => 'datetime',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'penduduk',
    ];

    /**
     * {@inheritdoc}
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Define an inverse one-to-one or many relationship.
     *
     * @return BelongsTo
     */
    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'id_pend');
    }

    /**
     * Get email penduduk attribute.
     *
     * @return string
     */
    public function getEmailAttribute()
    {
        return $this->penduduk->email;
    }
}
