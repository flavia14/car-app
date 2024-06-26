<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\MicroPost;
use App\Entity\User;
use App\Repository\MicroPostRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LikeController extends AbstractController
{
    #[Route('/like/{id}', name: 'app_like')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function like(MicroPost $microPost, MicroPostRepository $postRepository, Request $request): Response
    {
        /** @var User $currentUser */
        $currentUser = $this->getUser();
        $microPost->addLikedBy($currentUser);
        $postRepository->save($microPost, true);

        return $this->redirect($request->headers->get('referer'));
    }

    #[Route('/unlike/{id}', name: 'app_unlike')]
    public function unlike(MicroPost $microPost, MicroPostRepository $postRepository, Request $request): Response
    {
        /** @var User $currentUser */
        $currentUser = $this->getUser();
        $microPost->removeLikedBy($currentUser);
        $postRepository->save($microPost, true);

        return $this->redirect($request->headers->get('referer'));
    }
}
