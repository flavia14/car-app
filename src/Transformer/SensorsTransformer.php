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

    private function convertSensorToDto(FrontSensor $sensor): SensorDto
    {
        $sensorDto = new SensorDto();

        $sensorDto->id = $sensor->getId();
        $sensorDto->name = $sensor->getName();
        $sensorDto->value = $sensor->getValue();
        $sensorDto->unit = $sensor->getUnit();
        $sensorDto->location = $sensor->getLocation();
        $sensorDto->date =  $sensor->getCreationDate()->format('Y-m-d H:i:s');

        return $sensorDto;
    }
}