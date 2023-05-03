<?php

namespace App\Controller;

use App\Manager\TableManager;
use App\Service\TableService;
use Symfony\Component\Routing\Annotation\Route;

class TableController extends BaseController
{

    private TableManager $tableManager;

    public function __construct(TableManager $tableManager)
    {
       $this->tableManager = $tableManager;
    }

#[Route('/frontSensors', name: 'front-sensors')]
public function getFrontSensorsTable()
{
    $sensors = $this->tableManager->getFrontSensors();

}
}