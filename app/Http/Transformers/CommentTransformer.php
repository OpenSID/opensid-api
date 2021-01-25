<?php

namespace App\Http\Transformers;

use App\Models\Comments;
use League\Fractal\TransformerAbstract;

class CommentTransformer extends TransformerAbstract
{
    /**
     * {@inheritdoc}
     */
    public function transform(Comments $comment)
    {
        return [
            'id'         => $comment->id,
            'owner'      => $comment->owner,
            'email'      => $comment->email,
            'phone'      => $comment->no_hp,
            'subject'    => $comment->subjek,
            'comment'    => $comment->komentar,
            'created_at' => $comment->tgl_upload,
        ];
    }
}
