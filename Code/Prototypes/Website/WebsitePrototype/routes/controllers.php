<?php

/*
|
| Check for an active controller.
|
*/
function check(): Controller {
    if(isset($_GET['controller'])) {
        $controller = $_GET['controller'];
    }
    else if(isset($_POST['controller'])) {
        $controller = $_POST['controller'];
    }
    else {
        $controller = 'default';
    }

    setcookie('session_controller', $controller, 0);
    return load($controller);
}

/*
|
| Load selected controller.
|
*/
function load($controller) {
    switch($controller) {
        case 'dashboard':
            require_once __DIR__.'/../app/controllers/DashboardController.php';
            return new DashboardController();
        case 'login':
            require_once __DIR__.'/../app/controllers/LoginController.php';
            return new LoginController();
        default:
            require_once __DIR__.'/../app/controllers/DashboardController.php';
            return new DashboardController();
    }
}

