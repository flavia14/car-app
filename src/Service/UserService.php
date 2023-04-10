<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\Request\RegisterRequestDto;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService
{
    private EntityManagerInterface $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    public function createUser(
        RegisterRequestDto $requestDto,
        UserPasswordHasherInterface $userPasswordHasher
    ): array {
        $user = new User();

        $password = $userPasswordHasher->hashPassword($user, $requestDto->password);

        $user->setPassword($password)
            ->setUsername($requestDto->username)
            ->setEmail($requestDto->email);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return [
            'userId' => $user->getId()
        ];
    }
}
