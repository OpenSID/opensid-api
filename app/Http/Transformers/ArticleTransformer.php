<?php

namespace App\Http\Transformers;

use App\Models\Articles;
use League\Fractal\TransformerAbstract;

class ArticleTransformer extends TransformerAbstract
{
    /**
     * Resources that can be included if requested.
     *
     * @var array
     */
    protected $availableIncludes = [
        'author',
        'category',
        'comments',
    ];

    /**
     * {@inheritdoc}
     */
    public function transform(Articles $article)
    {
        return [
            'id'         => $article->id,
            'slug'       => $article->slug,
            'title'      => $article->judul,
            'text'       => $article->isi,
            'image'      => $article->gambar,
            'image1'     => $article->gambar1,
            'image2'     => $article->gambar2,
            'iamge3'     => $article->gambar3,
            'read_count' => $article->hit,
            'created_at' => $article->tgl_upload,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function includeAuthor(Articles $articles)
    {
        return $this->item($articles->author, new AuthorTransformer(), 'author');
    }

    /**
     * {@inheritdoc}
     */
    public function includeCategory(Articles $articles)
    {
        return $this->item($articles->category, new CategoryTransformer(), 'category');
    }

    /**
     * {@inheritdoc}
     */
    public function includeComments(Articles $articles)
    {
        return $this->collection($articles->comments, new CommentTransformer(), 'comments');
    }
}
