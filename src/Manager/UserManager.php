<?php

namespace App\Manager;

use App\Dto\Request\RegisterRequestDto;
use App\Service\SendEmailService;
use App\Service\UserService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserManager
{
    public function __construct(
        private UserService $userService,
        private SendEmailService $sendEmailService
    ){
    }

    /**
     * @throws EntityNotFoundException
     */
    public function register(RegisterRequestDto $requestDto, UserPasswordHasherInterface $userPasswordHasher): array
    {
        $userId = $this->userService->createUser($requestDto, $userPasswordHasher);
        return $this->sendEmailService->sendConfirmationEmail($userId['userId']);
    }
}