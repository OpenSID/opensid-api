<?php

namespace App\Http\Repository;

use App\Models\PermohonanSurat;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PermohonanSuratEntity
{
    /**
     * Get resource data.
     *
     * @return Spatie\QueryBuilder\QueryBuilder
     */
    public function get()
    {
        return QueryBuilder::for(PermohonanSurat::class)
            ->allowedFields([
                'id',
            ])
            ->allowedFilters([
                AllowedFilter::exact('id'),
            ])
            ->allowedSorts([
                'id',
            ])
            ->pengguna()
            ->jsonPaginate();
    }
}
