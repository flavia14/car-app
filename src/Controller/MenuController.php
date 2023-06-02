<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    #[Route('/menu', name: "menu")]
    public function menu()
    {
        return $this->render('menu/menu.html.twig',
        );
    }
}