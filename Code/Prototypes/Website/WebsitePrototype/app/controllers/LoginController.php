<?php

require_once __DIR__.'/Controller.php';

class LoginController extends Controller {

    public function __construct() { }

    protected function run($action) {
        switch($action) {
            case 'attemptLogin':
                $this->attemptLogin();
                exit;
            default:
                $this->displayLogin();
                break;
        }
    }

    private function displayLogin(): void {
        include __DIR__.'/../../resources/views/login.php';
    }

    private function attemptLogin(): void {
        header("location: index.php?controller=dashboard");
    }
}