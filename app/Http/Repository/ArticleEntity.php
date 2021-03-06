<?php

namespace App\Http\Repository;

use App\Models\Articles;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ArticleEntity
{
    /**
     * Get resource data.
     *
     * @return Spatie\QueryBuilder\QueryBuilder
     */
    public function get()
    {
        return QueryBuilder::for(Articles::class)
            ->allowedFields([
                'id',
                'slug',
                'judul',
                'isi',
            ])
            ->allowedFilters([
                AllowedFilter::exact('id'),
                AllowedFilter::exact('slug'),
                'judul',
                'isi',
            ])
            ->allowedSorts([
                'id',
                'judul',
            ])
            ->onlyArticle()
            ->enable()
            ->jsonPaginate();
    }

    /**
     * Get specific resource data.
     *
     * @return Spatie\QueryBuilder\QueryBuilder
     */
    public function find(string $slug)
    {
        return QueryBuilder::for(Articles::class)
            ->allowedFields([
                'id',
                'slug',
                'judul',
                'isi',
            ])
            ->allowedFilters([
                AllowedFilter::exact('id'),
                AllowedFilter::exact('slug'),
                'judul',
                'isi',
            ])
            ->allowedSorts([
                'id',
                'judul',
            ])
            ->whereSlug($slug)
            ->onlyArticle()
            ->enable()
            ->first();
    }

    /**
     * Get resource headline data.
     *
     * @return Spatie\QueryBuilder\QueryBuilder
     */
    public function headline()
    {
        return QueryBuilder::for(Articles::class)
            ->allowedFields([
                'id',
                'slug',
                'judul',
                'isi',
            ])
            ->allowedFilters([
                AllowedFilter::exact('id'),
                AllowedFilter::exact('slug'),
                'judul',
                'isi',
            ])
            ->allowedSorts([
                'id',
                'judul',
            ])
            ->onlyArticle()
            ->enable()
            ->headline()
            ->jsonPaginate();
    }
}
