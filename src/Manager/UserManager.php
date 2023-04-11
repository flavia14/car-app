<?php

declare(strict_types=1);

namespace App\Manager;

use App\Service\UserService;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserManager
{
    public function __construct(
        private UserService $userService
    ){
    }

    public function getLastUsername(AuthenticationUtils $authenticationUtils): array
    {
        return $this->userService->getLastUsername($authenticationUtils);
    }
}
