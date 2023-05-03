<?php

namespace App\Service;

use App\Repository\FrontSensorRepository;

class TableService
{
    private FrontSensorRepository $frontSensorRepository;

    public function __construct(FrontSensorRepository $frontSensorRepository)
    {
        $this->frontSensorRepository = $frontSensorRepository;
    }

    public function getFrontSensors(): array
    {
        return $this->frontSensorRepository->getFrontSensors();
    }
}