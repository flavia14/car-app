<?php

namespace App\Service;

use App\Repository\FrontSensorRepository;
use App\Repository\SensorRepository;
use App\Transformer\SensorsTransformer;
use Symfony\Component\BrowserKit\Request;

class GraphicService
{
    private sensorRepository $sensorRepository;
    private SensorsTransformer $sensorsTransformer;
    private const FRONT = "front";
    private const BACK = "back";

    public function __construct(SensorRepository $sensorRepository, SensorsTransformer $sensorsTransformer)
    {
        $this->sensorRepository = $sensorRepository;
        $this->sensorsTransformer = $sensorsTransformer;
    }

    public function getDataSensorsFront(string $name): array
    {
        $sensors = $this->sensorRepository->getDataSensors(self::FRONT, $name);

         return $this->sensorsTransformer->convertSensorsToDto($sensors);
    }
    public function getDataSensorsBack(string $name): array
    {
        $sensors = $this->sensorRepository->getDataSensors(self::BACK, $name);

        return $this->sensorsTransformer->convertSensorsToDto($sensors);
    }
}
