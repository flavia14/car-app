<?php

declare(strict_types=1);

namespace App\Transformer;

use App\Dto\CommentDto;
use App\Dto\Request\CommentRequestDto;
use App\Entity\Comment;
use App\Entity\MicroPost;

class CommentTransformer
{
    public function convertCommentsToDto(array $comments): array
    {
        $commentsDto = [];
        foreach ($comments as $comment) {
            $commentsDto[] = $this->convertCommentToDto($comment);
        }
        return $commentsDto;
    }

    public function convertRequestToDto(array $request): CommentRequestDto
    {
        $commentRequestDto = new CommentRequestDto();

        $commentRequestDto->text = $request['text'];

        return $commentRequestDto;
    }

    public function createComment(MicroPost $microPost, CommentRequestDto $commentRequestDto)
    {
        $comment = new Comment();

        $comment->setPost($microPost)
            ->setText($commentRequestDto->text);

        $this->commentRepository->save($comment, true);
    }
    protected function convertCommentToDto(Comment $comment): CommentDto
    {
        $commentDto = new CommentDto();
        $commentDto->text = $comment->getText();

        return $commentDto;
    }
}
