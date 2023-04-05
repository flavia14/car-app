<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\MicroPostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MyProfileController extends AbstractController
{
    #[Route('/myProfile/{id}', name: 'app_my_profile')]
    public function  show(
        User $user,
        MicroPostRepository $posts
    ): Response
    {
        return $this->render('my_profile/show.html.twig', [
            'user' => $user,
            'posts' => $posts->findAllByAuthor(
                $user
            )
        ]);
    }
}
