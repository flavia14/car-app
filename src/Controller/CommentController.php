<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
class CommentController extends AbstractController
{
    public function getListOfComment(): Response
    {
        return new Response();
    }
}