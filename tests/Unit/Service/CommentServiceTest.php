<?php

declare(strict_types=1);

namespace App\Tests\Unit\Service;

use App\Dto\CommentDto;
use App\Dto\Request\CommentRequestDto;
use App\Entity\Comment;
use App\Entity\MicroPost;
use App\Repository\CommentRepository;
use App\Service\CommentService;
use App\Transformer\CommentTransformer;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CommentServiceTest extends TestCase
{
    private MockObject $commentRepositoryMock;
    private MockObject $commentTransformerMock;
    private CommentService $commentService;

    /**
     * {@inheritDoc}
     */
    public function setUp(): void
    {
        $this->commentTransformerMock = $this->createMock(CommentTransformer::class);
        $this->commentRepositoryMock = $this->createMock(CommentRepository::class);

        $this->commentService = new CommentService(
            $this->commentRepositoryMock,
            $this->commentTransformerMock
        );
    }

    /** @test */
    public function getListOfCommentsTest(): void
    {
        $comment = $this->createMock(Comment::class);
        $commentDto = $this->createMock(CommentDto::class);
        $comments = [
            $comment
        ];

        $commentsDto = [
            $commentDto
        ];
        $this->commentRepositoryMock->expects(self::once())
            ->method('findByPostId')
            ->with(1)
            ->willReturn($comments);

        $this->commentTransformerMock->expects(self::once())
            ->method('convertCommentsToDto')
            ->with($comments)
            ->willReturn($commentsDto);

        $this->commentService->getListOfComments(1);
    }

    /** @test */
    public function testAddComment()
    {
        $commentRequestDto = new CommentRequestDto();
        $commentRequestDto->text = 'text';
        $microPost = new MicroPost();
        $commentMock = $this->createMock(Comment::class);

        $this->commentTransformerMock->expects(self::once())
            ->method('createComment')
            ->with($microPost, $commentRequestDto)
            ->willReturn($commentMock);

        $this->commentService->addComment($microPost, $commentRequestDto);
    }
}
