<?php

namespace App\Service;

use App\Dto\RequestDtoSensor;
use App\Enum\BaseEnum;
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

    public function getFrontSensors(int $limit, RequestDtoSensor $requestDto): array
    {
        $requestDto->setSort(BaseEnum::sensorFilter[$requestDto->getSort()]);
       $sensors[] = $this->frontSensorRepository->getSensors("front", $limit, $requestDto);
       return $this->sensorsTransformer->convertSensorsToDto($sensors[0]);
    }

    public function getBackSensors(int $limit, RequestDtoSensor $requestDto): array
    {
        $requestDto->setSort(BaseEnum::sensorFilter[$requestDto->getSort()]);
        $sensors[] = $this->frontSensorRepository->getSensors("back", $limit, $requestDto);
        return $this->sensorsTransformer->convertSensorsToDto($sensors[0]);
    }

    public function getNumberOfPagesFront( int $limit): int
    {
        $numberOfPages = intdiv(count($this->frontSensorRepository->getAllSensors("front")), $limit) + 1;

        return $numberOfPages;
    }

    public function getNumberOfPagesBack( int $limit): int
    {
        $numberOfPages = intdiv(count($this->frontSensorRepository->getAllSensors("back")), $limit) + 1;

        return $numberOfPages;
    }
}