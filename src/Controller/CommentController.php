<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\MicroPost;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    #[Route('/comments/{id}', name: 'comments')]
    public function getListOfComment(MicroPost $microPost, CommentRepository $commentRepository): Response
    {
        $comments = $commentRepository->findBy(['post' => $microPost]);

        return $this->render('comment/index.html.twig', [
            'comments' => $comments,
        ]);
    }

    #[Route('comment/add/{id}', name: 'add-comment')]
    #[ParamConverter("microPost", MicroPost::class)]
    public function addComment(MicroPost $microPost, Request $request, CommentRepository $commentRepository): Response
    {
        $form = $this->createForm(CommentType::class, new Comment());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            $comment->setPost($microPost);
            $commentRepository->save($comment, true);
            $this->addFlash('success', 'Your comment have been added');

            return $this->redirectToRoute('posts');
        }
        return $this->renderForm(
            'comment/comment.html.twig',
            [
                'form' => $form,
                'post' => 'post.title'
            ]
        );
    }
}
