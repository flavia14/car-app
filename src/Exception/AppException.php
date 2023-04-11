<?php

declare(strict_types=1);

namespace App\Exception;

class AppException extends \Exception
{
    public string|null $error = null;
    public string|null $details = null;
    public string|null $input = null;

    private array $expectedKeys = ['error', 'details'];

    public function setMessage($message): AppException
    {
        $this->message = $message;

        return $this;
    }

    public function getExpectedKeys(): array
    {
        return $this->expectedKeys;
    }
}
