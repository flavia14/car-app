<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Service\CommentService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CommentServiceTest extends KernelTestCase
{
    /** @test */
    public function getListOfCommentsTest(): void
    {
        $kernel = self::bootKernel();

        /** @var CommentService $service */
        $service = $kernel->getContainer()->get(CommentService::class);

        $comments = $service->getListOfComments(1);

        self::assertEmpty($comments);
    }
}
