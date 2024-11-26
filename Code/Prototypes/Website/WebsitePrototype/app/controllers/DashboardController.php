<?php

require_once __DIR__.'/Controller.php';

class DashboardController extends Controller {

    /*
    | >> Primary Functions
    | The basic functions from the abstract Controller class.
    */

    //<editor-fold desc="Primary Functions">
    // Constructor.
    public function __construct() { }

    // Runner.
    protected function run($action) : void {
        switch($action) {
            case 'filterRefresh':
                $sensor = $_GET['sensor'];
                $from = new DateTime($_GET['from-date'].' 00:00:00');
                $to = new DateTime($_GET['to-date'].' 23:59:59');
                $this->displayDashboard($sensor, $from, $to);
                break;
            case 'logout':
                header("location: index.php?controller=login");
                exit;
            default:
                $this->displayDashboard(null, null, null);
                break;
        }
    }
    //</editor-fold>



    /*
    | >> Secondary Functions
    | Operational functions that distinguish this Controller from other controllers.
    */

    //<editor-fold desc="Secondary Functions">
    // Primary display function.
    private function displayDashboard($sensor, $from, $to): void {
        require_once __DIR__.'/../models/SensorArray.php';
        $sensorsContainer = new SensorArray();

        $sensorsContainer->populateSensors();


        require_once __DIR__.'/../models/SensorDataArray.php';
        $dataContainer = new SensorDataArray();

        if (is_null($sensor)) {
            $duration = 168; // By default, display data from last 7 days.
//            echo 'Duration: '.$duration.' hours. '.($duration/24).' days.';
//            echo '<br><br>';

            $dataContainer->populateFrom('SE001', $duration);
        }
        else {
//            echo 'Duration: ~'.($from->diff($to)->days + 1).' days.';
//            echo '<br><br>';
            $dataContainer->populateFromTo($sensor, $from, $to);
        }

        $sensorsList = $sensorsContainer->getSensors();
        if($dataContainer->hasData()) {
            $dataList = $dataContainer->getSensorDatas();
        }
        else {
            $dataList = null;
        }

        include __DIR__ . '/../../resources/views/dashboard.php';
    }
    //</editor-fold>

}