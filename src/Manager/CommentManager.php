<?php

declare(strict_types=1);

namespace App\Manager;

use App\Dto\Request\CommentRequestDto;
use App\Entity\MicroPost;
use App\Service\CommentService;

class CommentManager
{
    private CommentService $commentService;

    public function __construct(
        CommentService $commentService
    ) {
        $this->commentService = $commentService;
    }

    public function getListOfComments(int $microPostId): array
    {
        return $this->commentService->getListOfComments($microPostId);
    }

    public function addComment(MicroPost $microPost, CommentRequestDto $commentRequestDto): array
    {
        return $this->commentService->addComment($microPost, $commentRequestDto);
    }
}
