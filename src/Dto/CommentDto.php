<?php

declare(strict_types=1);

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class CommentDto
{
    /**
     * @Assert\Type("string")
     * @Assert\NotBlank()
     */
    public string $text;
}
