<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserService
{
    public function getLastUsername(AuthenticationUtils $utils): array
    {
        $lastUsername = $utils->getLastUsername();
        $error = $utils->getLastAuthenticationError();

        return [
            'lastUsername' => $lastUsername,
            'error' => $error,
        ];
    }
}
