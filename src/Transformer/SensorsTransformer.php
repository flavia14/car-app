<?php

namespace App\Transformer;

use App\Dto\SensorDto;
use App\Entity\FrontSensor;

class SensorsTransformer
{
    public function convertSensorsToDto(array $sensors): array
    {
        $sensorsDto = [];
        foreach ($sensors as $sensor) {
            $sensorsDto[] = $this->convertSensorToDto($sensor);
        }

        return $sensorsDto;
    }

    private function convertSensorToDto($sensor): SensorDto
    {
        $sensorDto = new SensorDto();

        $sensorDto->id = $sensor->getId();
        $sensorDto->name = $sensor->getName();
        $sensorDto->value = $sensor->getValue();
        $sensorDto->unit = $sensor->getUnit();

        return $sensorDto;
    }
}