<?php

class SensorArray {
    private array $sensors;

    public function add(Sensor $sensor): void {
        $this->sensors[] = $sensor;
    }

    public function populateSensors(): void {
        // Open a database connection.
        require_once __DIR__.'/../../database/DatabaseConnection.php';
        require_once __DIR__.'/../../database/config.php';
        $connection = new DatabaseConnection(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_SCHEMA);

        // Query
        $query = "SELECT * FROM sensors;";

        // Execute Query
        $result = $connection->executeQuery($query);

        // Retrieve result data.
        require_once __DIR__.'/Sensor.php';
        while($cr = $result->fetch_assoc()) {
            $this->add(
                new Sensor(
                    $cr['id'],
                    $cr['description']
                )
            );
        }
    }

    //<editor-fold desc="Getters & Setters">
    public function getSensors(): array {
        return $this->sensors;
    }
    public function setSensors(array $sensors): void {
        $this->sensors = $sensors;
    }
    //</editor-fold>
}