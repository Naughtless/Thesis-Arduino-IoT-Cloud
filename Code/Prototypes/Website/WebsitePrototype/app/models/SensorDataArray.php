<?php

class SensorDataArray {

    //<editor-fold desc="Properties">
    private DateTime $limitStart;
    private DateTime $limitEnd;

    private array $sensorDatas;
    private bool $init;
    //</editor-fold>

    //<editor-fold desc="Functions">
    // Populate the sensor data array. Duration counted backwards from current time. In HOURS.

    public function add(SensorData $sensorData): void {
        $this->sensorDatas[] = $sensorData;
    }

    public function populateFrom(string $sensor, int $duration): void {
        // Set timezone.
        date_default_timezone_set('Asia/Jakarta');

        // Set current time (limitEnd).
        $this->limitEnd = new DateTime(date('Y-m-d H:i:s'));

        // Set limit time (limitStart).
        $this->limitStart = new DateTime(date('Y-m-d H:i:s'));
        $this->limitStart->modify('-'.$duration.' hour');

        // Open a database connection.
        require_once __DIR__.'/../../database/DatabaseConnection.php';
        require_once __DIR__.'/../../database/config.php';
        $connection = new DatabaseConnection(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_SCHEMA);

        // Query
        $query = "
        SELECT * FROM master 
        WHERE timecode >= '".$this->limitStart->format('Y-m-d H:i:s')."' 
        AND timecode < '".$this->limitEnd->format('Y-m-d H:i:s')."'
        AND sensorCode = '".$sensor."'";

        // Execute Query
//        echo 'Query String: ' . $query;
//        echo '<br><br>';

        $result = $connection->executeQuery($query);

        // Retreive result data.
        require_once __DIR__.'/SensorData.php';
        if(!is_null($result)) {
            $this->init = true;
            while($cr = $result->fetch_assoc()) {
                $this->add(
                    new SensorData(
                        new DateTime($cr['timecode']),
                        $cr['waterTemp'],
                        $cr['airTemp'],
                        $cr['humidity'],
                        $cr['co2'],
                        $cr['ph'],
                        $cr['ppm']
                    )
                );
            }
        }
        else {
            $this->init = false;
        }
    }

    public function populateFromTo(string $sensor, DateTime $from, DateTime $to): void {
        // Set timezone.
        date_default_timezone_set('Asia/Jakarta');

        // Set limit end time (limitEnd).
        $this->limitEnd = $to;

        // Set limit start time (limitStart).
        $this->limitStart = $from;

        // Open a database connection.
        require_once __DIR__.'/../../database/DatabaseConnection.php';
        require_once __DIR__.'/../../database/config.php';
        $connection = new DatabaseConnection(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_SCHEMA);

        // Query variables.
        $fds = $this->limitStart->format('Y-m-d H:i:s');
        $tds = $this->limitEnd->format('Y-m-d H:i:s');
        // Query
        $query = "
        SELECT * FROM master 
        WHERE timecode >= '".$fds."' 
        AND timecode < '".$tds."'
        AND sensorCode = '".$sensor."'";

        // Execute Query
//        echo 'Query String: ' . $query;
//        echo '<br><br>';

        $result = $connection->executeQuery($query);

        // Retreive result data.
        require_once __DIR__.'/SensorData.php';
        if(!is_null($result)) {
            $this->init = true;
            while($cr = $result->fetch_assoc()) {
                $this->add(
                    new SensorData(
                        new DateTime($cr['timecode']),
                        $cr['waterTemp'],
                        $cr['airTemp'],
                        $cr['humidity'],
                        $cr['co2'],
                        $cr['ph'],
                        $cr['ppm']
                    )
                );
            }
        }
        else {
            $this->init = false;
        }
    }


    //</editor-fold>

    //<editor-fold desc="Getters & Setters">
    public function getLimitStart(): DateTime {
        return $this->limitStart;
    }
    public function setLimitStart(DateTime $limitStart): void {
        $this->limitStart = $limitStart;
    }

    public function getLimitEnd(): DateTime {
        return $this->limitEnd;
    }
    public function setLimitEnd(DateTime $limitEnd): void {
        $this->limitEnd = $limitEnd;
    }

    public function getSensorDatas(): array {
        return $this->sensorDatas;
    }
    public function setSensorDatas(array $sensorDatas): void {
        $this->sensorDatas = $sensorDatas;
    }

    public function hasData(): bool {
        return $this->init;
    }
    //</editor-fold>
}