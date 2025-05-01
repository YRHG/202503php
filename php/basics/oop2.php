<?php

require_once '/Library/WebServer/Documents/202503php/php/basics/helpers_2.php';


/**
 * Car 类
 * 表示petrol car 汽油汽车
 * vin 车辆识别代码
 */
class Car
{
    public string $brand;
    public string $model;
    public int $year;

    protected string $engineType = "Petrol";
    private string $vinNumber = "unknown-vin";

    public function __construct(string $brand, string $model, int $year)
    {
        $this->brand = $brand;
        $this->model = $model;
        $this->year = $year;
    }

    public function startEngine(): void
    {
        echoWithBr("{$this->brand} {$this->model} 的引擎启动");
    }

    public function getEngineType(): string
    {
        return $this->engineType;
    }

    public function getVinNumber(): string
    {
        return $this->vinNumber;
    }

    public function setVinNumber(string $vin): void
    {
        $this->vinNumber = $vin;
    }

    public function showClassSelf(): array
    {
        return [
            'class' => __CLASS__,
            'properties' => get_object_vars($this),
        ];
    }
}


$myCar = new Car("Toyota", "Corolla", 2018);
$myCar->startEngine();
echoWithBr("引擎类型: " . $myCar->getEngineType());
echoWithBr("原 VIN: " . $myCar->getVinNumber());
$myCar->setVinNumber("VIN-ABC123456");
echoWithBr("新 VIN: " . $myCar->getVinNumber());
varDumpWithBr($myCar->showClassSelf());

echoHr();







