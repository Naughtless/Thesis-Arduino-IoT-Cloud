<?php

abstract class Controller {
    public abstract function __construct();

    public function invoke(): void
    {
        if(isset($_GET['action'])){
            $this->run($_GET['action']);
        }
        else if(isset($_POST['action'])) {
            $this->run($_POST['action']);
        }
        else {
            $this->run(null);
        }
    }

    protected abstract function run($action);
}
