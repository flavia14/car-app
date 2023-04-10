<?php

declare(strict_types=1);

namespace App\Controller;

use App\Manager\UserManager;
use App\Security\EmailVerifier;
use App\Transformer\UserTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    private EmailVerifier $emailVerifier;
    private UserManager $userManager;
    private BaseRequestController $baseRequestController;
    private UserTransformer $userTransformer;

    public function __construct(
        EmailVerifier $emailVerifier,
        UserManager $userManager,
        BaseRequestController $baseRequestController,
        UserTransformer $userTransformer
    ) {
        $this->emailVerifier = $emailVerifier;
        $this->userManager = $userManager;
        $this->baseRequestController = $baseRequestController;
        $this->userTransformer= $userTransformer;
    }

    #[Route('/register', name: 'app_register')]
    public function register(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher
    ): Response {
            $requestArray = $this->baseRequestController->getRequestParameters($request);
            if (!empty($requestArray)) {
                $requestDto = $this->userTransformer->convertRegisterRequestToDto($requestArray);
                if ( $this->userManager->register($requestDto, $userPasswordHasher)['success']) {

                    return $this->redirectToRoute('posts');
                }
            }

        return $this->render(
            'registration/register.html.twig'
        );
    }

    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $exception->getReason());

            return $this->redirectToRoute('app_register');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Your email address has been verified.');

        return $this->redirectToRoute('app_register');
    }
}
