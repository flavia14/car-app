<?php

namespace App\Controller;

use App\Entity\User;
use App\Manager\MicroPostManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MyProfileController extends AbstractController
{
    private MicroPostManager $microPostManager;

    public function __construct(MicroPostManager $microPostManager)
    {
        $this->microPostManager = $microPostManager;
    }

    #[Route('/myProfile/{id}', name: 'app_my_profile')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function showMyProfile(User $user): Response
    {
        $posts = $this->microPostManager->getAllPostsByAuthor($user->getId());
        return $this->render('my_profile/show.html.twig',
            [
                'user' => $user,
                'posts' => $posts
            ]
        );
    }
}
