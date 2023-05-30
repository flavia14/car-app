<?php

namespace App\Service;

use App\Repository\FrontSensorRepository;
use App\Transformer\SensorsTransformer;

class TableService
{
    private FrontSensorRepository $frontSensorRepository;
    private SensorsTransformer $sensorsTransformer;

    public function __construct(FrontSensorRepository $frontSensorRepository, SensorsTransformer $sensorsTransformer)
    {
        $this->frontSensorRepository = $frontSensorRepository;
        $this->sensorsTransformer = $sensorsTransformer;
    }

    public function getFrontSensors(): array
    {
       $sensors[] = $this->frontSensorRepository->getFrontSensors();
       return $this->sensorsTransformer->convertSensorsToDto($sensors[0]);
    }
}