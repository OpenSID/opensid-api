<?php

namespace App\Http\Transformers;

use App\Models\Categories;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    /**
     * {@inheritdoc}
     */
    public function transform(Categories $category)
    {
        return [
            'id' => $category->id,
            'name' => $category->kategori,
            'slug' => $category->slug,
        ];
    }
}
