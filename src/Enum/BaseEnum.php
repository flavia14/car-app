<?php

declare(strict_types=1);

namespace App\Enum;

enum BaseEnum
{
    public const MIN_LIKE = 2;
    public const  SENSOR_NAME = "f.name";
    public const SENSOR_LOCATION = "f.location";
    public const SENSOR_VALUE = "f.value";
    public const SENSOR_ID = "f.id";
    public const SENSOR_UNIT = "f.unit";
    const NAME = 'name';
    const LOCATION = 'location';
    const VALUE = 'value';
    const ID = 'id';
    const UNIT = "unit";

    const sensorFilter = [
        self::NAME => self::SENSOR_NAME,
        self::LOCATION => self::SENSOR_LOCATION,
        self::ID => self::SENSOR_ID,
        self::VALUE => self::SENSOR_VALUE,
        self::UNIT => self::SENSOR_UNIT
    ];
}
