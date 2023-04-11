<?php

declare(strict_types=1);

namespace App\Transformer;

use App\Dto\MicroPostDto;
use App\Dto\Request\MicroPostRequestDto;
use App\Entity\MicroPost;

class MicroPostTransformer
{
    public function convertMicroPostsToDto(array $comments): array
    {
        $commentsDto = [];
        foreach ($comments as $comment) {
            $commentsDto[] = $this->convertMicroPostToDto($comment);
        }
        return $commentsDto;
    }

    public function convertRequestToDto(array $request): MicroPostRequestDto
    {
        $microPostRequestDto = new MicroPostRequestDto();

        $microPostRequestDto->text = $request['text'];
        $microPostRequestDto->title = $request['title'];

        return $microPostRequestDto;
    }

    protected function convertMicroPostToDto(MicroPost $microPost): MicroPostDto
    {
        $microPostDto = new MicroPostDto();
        $microPostDto->text = $microPost->getText();
        $microPostDto->title = $microPost->getTitle();
        $microPostDto->author = $microPost->getAuthor();

        return $microPostDto;
    }

}