<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;

class FollowerService
{
    private ManagerRegistry $managerRegistry;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }

    public function follow(User $currentUser, User $userToFollow): void
    {
        if ($userToFollow->getId() !== $currentUser->getId()) {
            $currentUser->addFollow($userToFollow);
            $this->managerRegistry->getManager()->flush();
        }
    }

    public function unfollow(User $currentUser, User $userToUnFollow): void
    {
        if ($userToUnFollow->getId() !== $currentUser->getId()) {
            $currentUser->removeFollow($userToUnFollow);
            $this->managerRegistry->getManager()->flush();
        }
    }
}
