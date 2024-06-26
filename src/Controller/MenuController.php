<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    #[Route('/menu', name: "menu")]
    public function menu(): Response
    {
        $user = $this->getUser();

        return $this->render('menu/menu.html.twig', ['user' => $user]);
    }
}
