<?php

class SensorData {

    //<editor-fold desc="Properties">
    private DateTime $datetime;
    private string $waterTemp;
    private string $airTemp;
    private string $humidity;
    private string $co2;
    private string $ph;
    private string $nutrient;
    //</editor-fold>

    //<editor-fold desc="Constructor">
    public function __construct($datetime, $waterTemp, $airTemp, $humidity, $co2, $ph, $nutrient) {
        $this->nutrient = $nutrient;
        $this->ph = $ph;
        $this->co2 = $co2;
        $this->humidity = $humidity;
        $this->airTemp = $airTemp;
        $this->waterTemp = $waterTemp;
        $this->datetime = $datetime;
    }
    //</editor-fold>

    //<editor-fold desc="Getters & Setters">
    public function getDateTime(): DateTime{
        return $this->datetime;
    }
    public function setDateTime($datetime): void{
        $this->datetime = $datetime;
    }

    public function getWaterTemp(): string {
        return $this->waterTemp;
    }
    public function setWaterTemp($waterTemp): void {
        $this->waterTemp = $waterTemp;
    }

    public function getAirTemp(): string {
        return $this->airTemp;
    }
    public function setAirTemp($airTemp): void {
        $this->airTemp = $airTemp;
    }

    public function getHumidity(): string {
        return $this->humidity;
    }
    public function setHumidity($humidity): void {
        $this->humidity = $humidity;
    }

    public function getCO2(): string {
        return $this->co2;
    }
    public function setCO2($co2): void {
        $this->co2 = $co2;
    }

    public function getPH(): string {
        return $this->ph;
    }
    public function setPH($ph): void {
        $this->ph = $ph;
    }

    public function getNutrient(): string {
        return $this->nutrient;
    }
    public function setNutrient($nutrient): void {
        $this->nutrient = $nutrient;
    }
    //</editor-fold>

}