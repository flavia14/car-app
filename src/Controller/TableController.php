<?php

namespace App\Controller;

use App\Manager\TableManager;
use App\Service\TableService;
use JetBrains\PhpStorm\NoReturn;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;

class TableController extends BaseController
{

    private TableManager $tableManager;

    public function __construct(TableManager $tableManager)
    {
        $this->tableManager = $tableManager;
    }

    #[NoReturn] #[Route('/frontSensors', name: 'front-sensors')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function getFrontSensorsTable(): \Symfony\Component\HttpFoundation\Response
    {
        $sensors = $this->tableManager->getFrontSensors();

        return $this->render('tabel/tabel.html.twig',
            ["sensors" => $sensors],
        );
    }
}
