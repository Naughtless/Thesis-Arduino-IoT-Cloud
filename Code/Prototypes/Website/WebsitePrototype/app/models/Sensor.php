<?php

class Sensor {
    private string $sensorCode;
    private string $description;

    public function __construct($sc, $ds) {
        $this->sensorCode = $sc;
        $this->description = $ds;
    }

    //<editor-fold desc="Getters & Setters">
    public function getSensorCode(): string {
        return $this->sensorCode;
    }
    public function setSensorCode(string $sensorCode): void {
        $this->sensorCode = $sensorCode;
    }

    public function getDescription(): string {
        return $this->description;
    }
    public function setDescription(string $description): void {
        $this->description = $description;
    }
    //</editor-fold>
}