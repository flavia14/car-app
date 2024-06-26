<?php

declare(strict_types=1);

namespace App\Dto;

class MicroPostDto
{
    public string $text;
    public string $title;
    public UserDto $author;
}
