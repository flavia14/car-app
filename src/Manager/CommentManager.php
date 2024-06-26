<?php

declare(strict_types=1);

namespace App\Manager;

use App\Service\CommentService;

class CommentManager extends AbstractManager
{
    protected CommentService $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function getListOfComments(?int $getId)
    {
        return [];
    }
}
