<?php

declare(strict_types=1);

namespace App\Transformer;

use App\Dto\CommentDto;
use App\Dto\Request\CommentRequestDto;
use App\Entity\Comment;

class CommentTransformer
{
    public function convertEntityToDto(Comment $comment): CommentDto
    {
        $commentDto = new CommentDto();
        $commentDto->text = $comment->getText();

        return $commentDto;
    }

    public function convertRequestToDto(array $request): CommentRequestDto
    {
        $commentRequestDto = new CommentRequestDto();

        $commentRequestDto->text = $request['text'];

        return $commentRequestDto;
    }
}