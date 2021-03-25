<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Articles extends Model
{
    const ENABLE = 1;
    const HEADLINE = 1;
    const NOT_IN_ARTIKEL = [999, 1000, 1001];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'artikel';

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'author',
        'category',
        'comments',
    ];

    /**
     * Scope a query to only include article.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeOnlyArticle($query)
    {
        return $query->whereNotIn('id_kategori', static::NOT_IN_ARTIKEL);
    }

    /**
     * Scope a query to only enable article.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeEnable($query)
    {
        return $query->where('enabled', static::ENABLE);
    }

    /**
     * Scope a query to only headline article.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeHeadline($query)
    {
        return $query->where('headline', static::HEADLINE);
    }

    /**
     * Define an inverse one-to-one or many relationship.
     *
     * @return BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Define an inverse one-to-one or many relationship.
     *
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Categories::class, 'id_kategori');
    }

    /**
     * Define a one-to-many relationship.
     *
     * @return HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comments::class, 'id_artikel');
    }
}
