<?php

declare(strict_types=1);

namespace App\Transformer;

use App\Dto\Request\RegisterRequestDto;

class UserTransformer
{
    public function convertRegisterRequestToDto(array $request): RegisterRequestDto
    {
        $registerRequestDto = new RegisterRequestDto();

        $registerRequestDto->username = $request['_username'];
        $registerRequestDto->email = $request['_email'];
        $registerRequestDto->password = $request['_password'];

        return $registerRequestDto;
    }
}
