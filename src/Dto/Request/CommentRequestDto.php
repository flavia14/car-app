<?php

namespace App\Dto\Request;

use Symfony\Component\Validator\Constraints as Assert;

class CommentRequestDto
{
    /**
     * @Assert\Type("string")
     * @Assert\NotBlank()
     */
    public string $text;
}
