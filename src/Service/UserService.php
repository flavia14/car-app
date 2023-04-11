<?php

declare(strict_types=1);

namespace App\Service;

use App\Enum\ExceptionCodes;
use App\Exception\BadCredentialsException;
use http\Env\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserService
{
    /**
     * @throws BadCredentialsException
     */
    public function getLastUsername(AuthenticationUtils $utils): array
    {
        $error = $utils->getLastAuthenticationError();
        if ($error){
            throw new BadCredentialsException($error->getMessage(), 400);
        }

        $lastUsername = $utils->getLastUsername();

        return ['lastUsername' => $lastUsername];
    }
}
