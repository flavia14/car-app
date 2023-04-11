<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\MicroPost;
use App\Manager\CommentManager;
use App\Transformer\CommentTransformer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    private CommentManager $commentManager;
    private BaseRequestController $baseRequestController;
    private CommentTransformer $commentTransformer;

    public function __construct(
        CommentManager        $commentManager,
        BaseRequestController $baseRequestController,
        CommentTransformer    $commentTransformer
    )
    {
        $this->commentManager = $commentManager;
        $this->baseRequestController = $baseRequestController;
        $this->commentTransformer = $commentTransformer;
    }

    #[Route('/comments/{id}', name: 'comments')]
    public function getListOfComment(MicroPost $microPost): Response
    {
        $comments = $this->commentManager->getListOfComments($microPost->getId());

        return $this->render('comment/index.html.twig', [
            'comments' => $comments,
        ]);
    }

    #[Route('comment/add/{id}', name: 'add-comment')]
    #[ParamConverter("microPost", MicroPost::class)]
    public function addComment(MicroPost $microPost, Request $request): Response
    {
        $requestArray = $this->baseRequestController->getRequestParameters($request);

        if (key_exists('text', $requestArray)) {
            $requestDto = $this->commentTransformer->convertRequestToDto($requestArray);

            if ($this->commentManager->addComment($microPost, $requestDto)['success']) {
                $this->addFlash('success', 'Your comment have been added');
                return $this->redirectToRoute('posts');
            }
        }

        return $this->render(
            'comment/comment.html.twig',
            [
                'id' => $microPost->getId()
            ]
        );
    }
}
