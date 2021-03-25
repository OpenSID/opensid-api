<?php

namespace App\Http\Repository;

use App\Models\Comments;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CommentEntity
{
    /**
     * Get resource data.
     *
     * @return Spatie\QueryBuilder\QueryBuilder
     */
    public function get()
    {
        return QueryBuilder::for(Comments::class)
            ->allowedFields([
                'id',
                'owner',
                'email',
                'subjek',
                'comment',
                'no_hp',
                'tgl_upload',
            ])
            ->allowedFilters([
                AllowedFilter::exact('id'),
                'owner',
                'email',
                'subjek',
                'comment',
                'no_hp',
                'tgl_upload',
            ])
            ->allowedSorts([
                'id',
                'owner',
                'email',
                'subjek',
                'comment',
                'no_hp',
                'tgl_upload',
            ])
            ->enable()
            ->jsonPaginate();
    }

    /**
     * Get specific resource data.
     *
     * @return Spatie\QueryBuilder\QueryBuilder
     */
    public function find(int $id)
    {
        return QueryBuilder::for(Comments::class)
            ->allowedFields([
                'id',
                'owner',
                'email',
                'subjek',
                'comment',
                'no_hp',
                'tgl_upload',
            ])
            ->allowedFilters([
                AllowedFilter::exact('id'),
                'owner',
                'email',
                'subjek',
                'comment',
                'no_hp',
                'tgl_upload',
            ])
            ->allowedSorts([
                'id',
                'owner',
                'email',
                'subjek',
                'comment',
                'no_hp',
                'tgl_upload',
            ])
            ->enable()
            ->find($id);
    }
}
