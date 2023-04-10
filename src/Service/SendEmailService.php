<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;

class SendEmailService
{
    private EmailVerifier $emailVerifier;
    private EntityManagerInterface $entityManager;

    public function __construct(
        EmailVerifier $emailVerifier,
        EntityManagerInterface $entityManager
    ) {
        $this->emailVerifier = $emailVerifier;
        $this->entityManager = $entityManager;
    }

    public function sendConfirmationEmail(int $userId): array
    {
        $user = $this->entityManager->getRepository(User::class)->find($userId);

        if (empty($user)) {
            throw new EntityNotFoundException("Entity not found");
        }

        $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
            (new TemplatedEmail())
                ->from(new Address('flavia.andron@gmail.com', 'Flavia Andron'))
                ->to($user->getEmail())
                ->subject('Please Confirm your Email')
                ->htmlTemplate('registration/confirmation_email.html.twig')
        );

        return ['success' => true];
    }
}
