<?php

namespace App\Controller;

use App\Entity\MicroPost;
use App\Form\MicroPostType;
use App\Repository\MicroPostRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MicroPostController extends AbstractController
{
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    #[Route('/posts', name: 'posts')]
    public function getListOfPost(MicroPostRepository $microPostRepository): Response
    {
        $posts = $microPostRepository->findAll();

        return $this->render('post/index.html.twig', [
            'posts' => $posts
        ]);
    }

    /**
     * @param Request $request
     * @param MicroPostRepository $postRepository
     * @return Response
     */
    #[Route('/post/add', name: 'post_add', priority: 2)]
    #[IsGranted('ROLE_WRITER')]
    public function add(Request $request, MicroPostRepository $postRepository): Response
    {
        $post = new MicroPost();
        $user = $this->getUser();
        $post->setAuthor($user);
        $form = $this->createForm(MicroPostType::class, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $microPost = $form->getData();
            $postRepository->save($microPost, true);

            $this->addFlash('success', 'New post have been added');

            return $this->redirectToRoute('posts');
        }
        return $this->renderForm(
            'post/createPost.html.twig',
            [
                'form' => $form
            ]
        );
    }

    #[Route('/post/update/{id}', name: 'post-update')]
    #[IsGranted(MicroPost::EDIT, 'microPost')]
    public function updatePost(MicroPost $microPost, Request $request, MicroPostRepository $postRepository): Response
    {
        $form = $this->createForm(MicroPostType::class, $microPost);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $microPost = $form->getData();
            $postRepository->save($microPost, true);

            $this->addFlash('success', 'New post have been update');

            return $this->redirectToRoute('posts');
        }
        return $this->renderForm(
            'post/updatePost.html.twig',
            [
                'form' => $form
            ]
        );
    }
}
