<?php

namespace App\Service;

use App\Repository\FrontSensorRepository;
use App\Transformer\SensorsTransformer;
use Symfony\Component\BrowserKit\Request;

class GraphicService
{
    private FrontSensorRepository $frontSensorRepository;
    private SensorsTransformer $sensorsTransformer;

    public function __construct(FrontSensorRepository $frontSensorRepository, SensorsTransformer $sensorsTransformer)
    {
        $this->frontSensorRepository = $frontSensorRepository;
        $this->sensorsTransformer = $sensorsTransformer;
    }

    public function getDataSensors(string $name)
    {
        $sensors = $this->frontSensorRepository->getDataSensors('front', $name);
         return $this->sensorsTransformer->convertSensorsToDto($sensors);
    }
}