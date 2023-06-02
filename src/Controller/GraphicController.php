<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\FrontSensor;
use App\Manager\GraphicManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GraphicController extends BaseController
{
    private GraphicManager $graphicManager;

    public function __construct(GraphicManager $graphicManager)
    {
        $this->graphicManager = $graphicManager;
    }

    #[Route('/graphic/{name}', name: 'graphic')]
    public function graphicSensor(FrontSensor $sensor): \Symfony\Component\HttpFoundation\Response
    {
        $dataSensor = $this->graphicManager->getDataSensors($sensor->getName());

        return $this->render('graphic/graphic.html',
            ["sensors" => $dataSensor,
                "name" => $sensor->getName(),
                ],
        );
    }
}